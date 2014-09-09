<?php

class SellController extends Controller
{
    /**
     * @return array
     */
    public function GetSubMenu()
    {
        $arr = array(
            'invoices' => array('action' => 'invoices','visible' => $this->rights['sales_see'] ? 1 : 0 , 'class' => 'list-products'),
            'add invoice' => array('action' => 'firststepcreate', 'visible' => $this->rights['sales_add'] ? 1 : 0, 'class' => 'create-product'),
        );

        return $arr;
    }

    /**
     * Entry point
     */
    public function actionIndex()
    {
        //do listing
        $this->actionInvoices();
    }


    /**
     * Render invoice table
     */
    public function actionInvoices($generate = null,$page = 1)
    {
        //if should generate pdf
        if(!empty($generate))
        {
            /* @var $operation OperationsOut */
            $operation = OperationsOut::model()->findByPk($generate); //get operation for code-generation

            //get all operations with generated code (belonging to stock of current operation)
            $c = new CDbCriteria();
            $c -> addInCondition('stock_id',array($operation->stock_id));
            $c -> addNotInCondition('invoice_code',array(''));
            //count all ops
            $operations_with_code_count = (int)OperationsOut::model()->count($c);
            //current number - quantity + 1
            $current_invoice_nr = (string)($operations_with_code_count + 1);
            //create code
            $invoice_code = $operation->stock->location->prefix.'_'.str_pad($current_invoice_nr,4,'0',STR_PAD_LEFT);

            //update operation
            $operation->invoice_code = $invoice_code;
            $operation->invoice_date = time();
            $operation->update();
        }

        $countAll = $invoices = OperationsOut::model()->with('client')->count();
        $pages = $this->calculatePageCount($countAll);

        $ci = new CDbCriteria();
        $ci -> limit = $this->on_one_page;
        $ci -> offset = ($this->on_one_page) * ($page - 1);

        //get all sale-invoices
        $invoices = OperationsOut::model()->with('client')->findAll($ci);

        //arrays for select-boxes
        $types = ClientTypes::model()->findAllAsArray();
        $statuses = OperationOutStatuses::model()->findAllAsArray();
        $cities = UserCities::model()->findAllAsArray();


        if(!empty($generate))
        {
            //create link PDF generation (if need to generate)
            $gen_pdf_link = Yii::app()->createUrl('/pdf/invoice', array('id' => $generate));

            //render table
            $this->render('sales_list', array('invoices' => $invoices, 'types' => $types, 'cities' => $cities, 'statuses' => $statuses, 'gen_link' => $gen_pdf_link, 'pages' => $pages, 'current_page' => $page));
        }
        else
        {
            //render table
            $this->render('sales_list', array('invoices' => $invoices, 'types' => $types, 'cities' => $cities, 'statuses' => $statuses, 'gen_link' => '', 'pages' => $pages, 'current_page' => $page));
        }
    }

    /**
     * Render first step table
     */
    public function actionFirstStepCreate($id = null)
    {
        $form_clients = new ClientForm();
        $form_srv = new ServiceForm();

        if(isset($_POST['ClientForm']))
        {
            //if company
            if($_POST['ClientForm']['company'])
            {
                //validate as company (company code required)
                $form_clients->company = 1;
            }

            //set attributes and validate
            $form_clients->attributes = $_POST['ClientForm'];

            //if no errors
            if($form_clients->validate())
            {
                //empty client
                $client = new Clients();

                //set attributes
                $client->attributes = $_POST['ClientForm'];

                //set company or not
                $form_clients->company == 1 ? $client->type = 1 : $client->type = 2;

                //set creation parameters
                $client->date_created = time();
                $client->date_changed = time();
                $client->user_modified_by = Yii::app()->user->id;

                //save to db
                $client->save();

                //redirect to next step
                $this->redirect(Yii::app()->createUrl('/sell/nextstepcreate/',array('cid' => $client->id)));
            }
        }

        //array for types-select-box
        $types = ClientTypes::model()->findAllAsArray();
        $emptyLabel = array('' => $this->labels['select type']);
        $types =  $emptyLabel + $types;

        $this->render('first_step', array('form_mdl' => $form_clients, 'form_srv' => $form_srv, 'client_types' => $types));
    }

    /**
     * Renders next step
     */
    public function actionNextStepCreate($id = null)
    {
        /* @var $stocks Stocks[] */
        /* @var $available_stocks Stocks[] */

        $client = Clients::model()->findByPk($id);
        if(!empty($client))
        {
            $available_stocks_id = array();
            $stocks = Stocks::model()->findAll();
            $options = OptionCards::model()->findAllByAttributes(array('status' => 1));
            $vats = Vat::model()->findAll();
            $available_stocks = Stocks::model()->findAllByAttributes(array('location_id' => Yii::app()->user->getState('city_id')));
            $invoices_count = OperationsOut::model()->count();


            foreach($available_stocks as $stock){$available_stocks_id[] = $stock->id;}

            $this->render('next_step',array('stocks' => $stocks, 'available_stocks_id' => $available_stocks_id, 'client' => $client, 'options' => $options, 'vats' => $vats, 'count' => $invoices_count));
        }
        else
        {
            throw new CHttpException(404);
        }
    }


    public function actionFinalStep()
    {
        /* @var $stock Stocks */
        /* @var $client Clients */

        $form = $_POST['SaleFrom'];
        $stock_id = $form['stock_id'];
        $client_id = $form['client_id'];
        $vat_id = $form['vat_id'];
        $products = $form['products'];
        $options = $form['options'];

        $stock = Stocks::model()->findByPk($stock_id);
        $client = Clients::model()->findByPk($client_id);
        if(!empty($stock) && !empty($client))
        {
            $operation = new OperationsOut();
            $operation->client_id = $client_id;
            $operation->signer_name = "";
//            $operation->payment_method_id = 0;
            $operation->date_created_ops = time();
            $operation->date_changed = time();
            $operation->warranty_start_date = time();
            $operation->user_modified_by = Yii::app()->user->id;
            $operation->vat_id = $vat_id;
            $operation->invoice_code = '';
            $operation->stock_id = $stock_id;
            $operation->status_id = 2; /* 2 - on the way, 1 - delivered */
            $operation->save();

            if(!empty($products))
            {
                foreach($products as $pr_card_id => $product_item)
                {
                    if($product_item['qnt'] > 0 && $product_item['price'] > 0 && is_numeric($product_item['price']))
                    {
                        $item_prod = new OperationsOutItems();
                        $item_prod -> price = $this->priceStrToCents($product_item['price']);
                        $item_prod -> discount_percent = $product_item['discount'];
                        $item_prod -> qnt = $product_item['qnt'];
                        $item_prod -> product_card_id = $pr_card_id;
                        $item_prod -> operation_id = $operation->id;
                        $item_prod -> stock_id = $stock_id;
                        $item_prod -> stock_qnt_after_op = Stocks::model()->removeFromStockAndGetCount($pr_card_id,$product_item['qnt'],$stock_id);
                        $item_prod -> client_id = $client_id;
                        $item_prod -> save();
                    }
                }
            }

            if(!empty($options))
            {
                foreach($options as $op_card_id => $option_item)
                {
                    if($option_item['price'] > 0 && is_numeric($option_item['price']))
                    {
                        $item_option = new OperationsOutOptItems();
                        $item_option -> operation_id = $operation->id;
                        $item_option ->option_card_id = $op_card_id;
                        $item_option -> price = $this->priceStrToCents($option_item['price']);
                        $item_option -> qnt = 1;
                        $item_option -> client_id = $client_id;
                        $item_option -> save();
                    }
                }
            }


            if(!isset($_POST['generate']))
            {
                $this->redirect(Yii::app()->createUrl('/sell/invoices'));
            }
            else
            {
                $this->redirect(Yii::app()->createUrl('/sell/invoices',array('generate' => $operation->id)));
            }
        }
        else
        {
            throw new CHttpException(404);
        }

    }

    /****************************************** A J A X  S E C T I O N ************************************************/

    /**
     * Generates invoice-pdf and sets code
     * @param $id
     * @throws CHttpException
     */
    public function actionGenerate($id)
    {
        /* @var $operation OperationsOut */

        $operation = OperationsOut::model()->findByPk($id);
        if(!empty($operation))
        {
            $invoice_code = $operation->invoice_code;

            if($operation->invoice_code == '')
            {
                $current_stock_id = $operation->stock->id;

                $c = new CDbCriteria();
                $c -> addInCondition('stock_id',array($current_stock_id));
                $c -> addNotInCondition('invoice_code',array(''));

                $operations_with_code_count = (int)OperationsOut::model()->count($c);
                $current_invoice_nr = (string)($operations_with_code_count + 1);
                $invoice_code = $operation->stock->location->prefix.'_'.str_pad($current_invoice_nr,4,'0',STR_PAD_LEFT);

                $operation->invoice_code = $invoice_code;
                $operation->invoice_date = time();
                $operation->update();
            }

            $ret = array('key' => $invoice_code, 'link' => Yii::app()->createUrl('/pdf/invoice', array('id' => $id)));
            echo json_encode($ret);
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionGenerate

    /**
     * Filter table ajax
     */
    public function actionFilterTable()
    {
        //get all params from post(or get)
        $client_name = Yii::app()->request->getParam('cli_name', '');
        $client_type_id = Yii::app()->request->getParam('cli_type_id',null);
        $invoice_code = Yii::app()->request->getParam('in_code','');
        $operation_status_id = Yii::app()->request->getParam('in_status_id','');
        $stock_city_id = Yii::app()->request->getParam('stock_city_id','');
        $date_from_str = Yii::app()->request->getParam('date_from_str','');
        $date_to_str = Yii::app()->request->getParam('date_to_str','');
        $page = Yii::app()->request->getParam('page',1);


        //conditions - null by default
        $client_con_arr = null;
        $stock_con_arr = null;
        $date_condition = null;

        //date range by default
        $time_from = 0;
        $time_to = time() + (60 * 60 * 24);

        //attr condition
        $attr_conditions = array();

        //if client name not empty
        if(!empty($client_name))
        {
            if(!empty($client_type_id))
            {
                //if not company (physical person)
                if($client_type_id != 1)
                {
                    $names = explode(" ",$client_name,2);
                    if(count($names) > 1)
                    {
                        $client_con_arr = array('condition' => 'client.name LIKE "%'.$names[0].'%" AND client.surname LIKE "%'.$names[1].'%"');
                    }
                    else
                    {
                        $client_con_arr = array('condition' => 'client.name LIKE "%'.$client_name.'%"');
                    }
                }

                //if company
                else
                {
                    $client_con_arr = array('condition' => 'client.company_name LIKE "%'.$client_name.'%"');
                }
            }
            else
            {

                $names = explode(" ",$client_name,2);
                if(count($names) > 1)
                {
                    $client_con_arr = array('condition' => 'client.name LIKE "%'.$names[0].'%" AND client.surname LIKE "%'.$names[1].'%" OR client.company_name LIKE "%'.$client_name.'%"');
                }
                else
                {
                    $client_con_arr = array('condition' => 'client.name LIKE "%'.$client_name.'%" OR client.company_name LIKE "%'.$client_name.'%"');
                }
            }
        }
        elseif(!empty($client_type_id))
        {
            $client_con_arr = array('condition' => 'client.type = '.$client_type_id.'');
        }

        if(!empty($stock_city_id))
        {
            $stock_con_arr = array('condition' => 'stock.location_id = '.$stock_city_id.'');
        }

        //if given dates
        if(!empty($date_from_str))
        {
            $dt = DateTime::createFromFormat('m/d/Y',$date_from_str);
            $time_from = $dt->getTimestamp();
        }
        if(!empty($date_to_str))
        {
            $dt = DateTime::createFromFormat('m/d/Y',$date_to_str);
            $time_to = $dt->getTimestamp();
            $time_to += (60*60*24); //add one day
        }

        //if invoice code set
        if(!empty($invoice_code))
        {
            $attr_conditions['invoice_code'] = $invoice_code;
        }

        //if operation status set
        if(!empty($operation_status_id))
        {
            $attr_conditions['status_id'] = $operation_status_id;
        }


        //set time-range criteria
        $c_time = new CDbCriteria();
        $c_time -> addBetweenCondition('date_created_ops',$time_from,$time_to);

        //create new criteria by time-range, for limit count of record
        $c_lim = Pagination::getFilterCriteria(3,$page,$c_time);

        //count all filtered items
        $count = OperationsOut::model()->with(array(
            'client' => $client_con_arr,
            'stock.location' => $stock_con_arr))->countByAttributes($attr_conditions,$c_time);

        //calculate count of pages
        $pages = Pagination::calcPagesCount($count,3);

        //get all items by conditions and limit them by criteria
        $operations = OperationsOut::model()->with(array(
            'client' => $client_con_arr,
            'stock.location' => $stock_con_arr))->findAllByAttributes($attr_conditions,$c_lim);

        //render partial
        $this->renderPartial('_ajax_table_filtering',array('operations' => $operations, 'current_page' => $page, 'pages' => $pages));

    }//actionFilterTable
}