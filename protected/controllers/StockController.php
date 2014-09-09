<?php

class StockController extends Controller
{
    /**
     * @return array
     */
    public function GetSubMenu()
    {
        $arr = array(
            'products' => array('action' => 'list','visible' => $this->rights['stock_see'] ? 1 : 0 , 'class' => 'list-products'),
            'movements' => array('action' => 'movements', 'visible' => $this->rights['stock_see'] ? 1 : 0, 'class' => 'list-products'),
            'move products' => array('action' => 'move', 'visible' => $this->rights['stock_see'] ? 1 : 0, 'class' => 'create-product')
        );

        return $arr;
    }

    /**
     * Entry point
     */
    public function actionIndex()
    {
        //do listing
        $this->actionList();
    }


    /**
     * List all products in stock
     * @param int $page
     */
    public function actionList($page = 1)
    {
        $cities = UserCities::model()->findAllAsArray();
        $units = MeasureUnits::model()->findAllAsArray();

        $c = new CDbCriteria();
        $c -> limit = $this->on_one_page;
        $c -> offset = ($this->on_one_page * ($page - 1));

        $count = ProductInStock::model()->count();
        $pages = $this->calculatePageCount($count);

        $productsObj = ProductInStock::model()->with('stock','stock.location','productCard')->findAll($c);
        $this->render('list',array('products' => $productsObj, 'cities' => $cities, 'pages' => $pages, 'current_page' => $page, 'units' => $units));
    }//actionList


    /**
     * List all movements
     * @param int $page
     */
    public function actionMovements($page = 1)
    {
        $c = new CDbCriteria();
        $c -> limit = 3;
        $c -> offset = Pagination::calcOffset(3,$page);

        $count = StockMovements::model()->count();
        $pages = $this->calculatePageCount($count);
        $stock = Stocks::model()->getAsArrayPairs();

        $movements = StockMovements::model()->with('stockMovementItems','stockMovementStages','status','srcStock','trgStock')->findAll($c);
        $this->render('list_movements',array('movements' => $movements, 'pages' => $pages, 'current_page' => $page, 'stocks' => $stock));
    }//actionMovements


    /**
     * Renders movement form
     */
    public function actionMove()
    {
        $stocks = Stocks::model()->findAll();
        $this->render('add_movement',array('stocks' => $stocks));
    }//actionMove


    /**
     * Finish movement - write to base
     * @throws CHttpException
     */
    public function actionMoveFinish()
    {
        if(isset($_POST['MovementForm']) && !empty($_POST['MovementForm']))
        {
            //get form
            $form = $_POST['MovementForm'];

            //get values
            $products = isset($form['products']) ? $form['products'] : array();
            $src_stock_id = isset($form['src_stock']) ? $form['src_stock'] : 0;
            $trg_stock_id = isset($form['trg_stock']) ? $form['trg_stock'] : 0;
            $car_number = isset($form['car_number']) ? $form['car_number'] : '';
            $car_brand =  isset($form['car_brand']) ? $form['car_brand'] : '';
            $generate_pdf = isset($form['generate_pdf']) ? true : false;

            //new movement
            $movement = new StockMovements();
            $movement -> date = time(); //current time
            $movement -> status_id = 1; // 1 - On the way, 2 - Delivered, 3 - Canceled, 4 - Stopped, 5 - Returned
            $movement -> src_stock_id = $src_stock_id; //from stock
            $movement -> trg_stock_id = $trg_stock_id; //to stock
            $movement -> car_number = $car_number; //car number
            $movement -> car_brand = $car_brand; //car brand
            $movement -> save(); //save

            //for-each products
            foreach($products as $id => $qnt)
            {

                /* @var $this_product_in_src_stock ProductInStock */
                /* @var $this_product_in_trg_stock ProductInStock */

                $qnt_src_left = 0;
                $this_product_in_src_stock = ProductInStock::model()->findByAttributes(array('stock_id' => $movement->src_stock_id, 'product_card_id' => $id));
                $qnt_trg_left = 0;
                $this_product_in_trg_stock = ProductInStock::model()->findByAttributes(array('stock_id' => $movement->trg_stock_id, 'product_card_id' => $id));


                /* @var $card ProductCards */
                $card = ProductCards::model()->findByPk($id);

                //new movement item
                $item = new StockMovementItems();
                $item -> movement_id = $movement->id; //movement ID
                $item -> product_card_id = $id; //product card
                $item -> qnt = $qnt; //quantity
                $item -> item_weight = $card->weight; //weight of one item (gross)
                $item -> src_stock_id = $movement->src_stock_id; //source stock (additional field, not related, just for report-simplifying)
                $item -> trg_stock_id = $movement->trg_stock_id; //target stock (additional field, not related, just for report-simplifying)

                //if enough product in stock
                if(!empty($this_product_in_src_stock) && ($this_product_in_src_stock->qnt > $qnt))
                {
                    $this_product_in_src_stock->qnt -= $qnt;
                    $this_product_in_src_stock->date_changed = time();
                    $this_product_in_src_stock -> update();
                    $qnt_src_left = $this_product_in_src_stock->qnt;
                }
                $item -> in_src_stock_after_movement = $qnt_src_left; //left in stock after operation

                //if found this kind of item in target stock
                if(!empty($this_product_in_trg_stock))
                {
                    $qnt_trg_left = $this_product_in_trg_stock->qnt;
                }
                $item -> in_trg_stock_after_movement = $qnt_trg_left; //in target stock quantity not changed, because not moved yet
                $item -> save(); //save
            }

            //new movement stage (as resolution in help-desk)
            $stage = new StockMovementStages();
            $stage -> movement_id = $movement->id; //movement ID
            $stage -> movement_status_id = $movement->status->id; // current status of movement
            $stage -> user_operator_id = Yii::app()->user->id; //operator(current user) ID
            $stage -> operator_name = Yii::app()->user->getState('name').' '.Yii::app()->user->getState('surname'); //operator name (not necessary)
            $stage -> time = time(); //current time
            $stage -> remark = '-'; //empty remark by default
            $stage -> save();

            //redirect to movement list
            $this->redirect(Yii::app()->createUrl('/stock/movements'));
        }
        else
        {
            throw new CHttpException(404);
        }

        exit();
    }//actionMoveFinish



    /**
     * Renders movement info
     * @param int $id
     * @throws CHttpException
     */
    public function actionMovementInfo($id = null)
    {
        $movement = StockMovements::model()->with('stockMovementItems','stockMovementStages','status','srcStock','trgStock')->findByPk($id);
        $statuses = StockMovementStatuses::model()->findAll();

        if(!empty($movement))
        {
            $this->render('info_movement',array('movement' => $movement, 'statuses' => $statuses));
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionMovementInfo


    /**
     * Applying status
     * @throws CHttpException
     */
    public function actionApplyStatus()
    {
        /* @var $movement StockMovements */
        /* @var $in_target_stock ProductInStock */
        /* @var $in_source_stock ProductInStock */

        //if got POST form
        if($_POST['MovementInfoForm'])
        {
            //get parameters
            $form = $_POST['MovementInfoForm'];
            $remark = $form['remark'];
            $status_id = $form['status_id'];
            $movement_id = $form['movement_id'];

            //try find movement by pk
            $movement = StockMovements::model()->findByPk($movement_id);

            //if found
            if(!empty($movement))
            {
                // 1 - On the way, 2 - Delivered, 3 - Canceled, 4 - Stopped, 5 - Returned
                switch($status_id)
                {
                    //DELIVERED
                    case 2:
                        foreach($movement->stockMovementItems as $item)
                        {
                            //try find in target stock this kind of item
                            $in_target_stock = ProductInStock::model()->findByAttributes(array('stock_id' => $movement->trg_stock_id, 'product_card_id' => $item->product_card_id));

                            //if found in target stock
                            if(!empty($in_target_stock))
                            {
                                //increase quantity
                                $in_target_stock ->qnt += $item->qnt;
                                $in_target_stock -> date_changed = time();
                                $in_target_stock -> update();

                                //save qnt to item (after stock updating) for reports
                                $item -> in_trg_stock_after_movement = $in_target_stock->qnt;
                                $item -> save();
                            }
                            //if not found this kind of product in target stock
                            else
                            {
                                //create new item in stock and set quantity
                                $in_target_stock = new ProductInStock();
                                $in_target_stock -> stock_id = $movement->trg_stock_id;
                                $in_target_stock -> product_card_id = $item->product_card_id;
                                $in_target_stock -> date_changed = time();
                                $in_target_stock -> date_created = time();
                                $in_target_stock -> save();
                            }
                        }
                        break;

                    //RETURNED BACK
                    case 5:
                        foreach($movement->stockMovementItems as $item)
                        {
                            //try find in source stock this kind of item
                            $in_source_stock = ProductInStock::model()->findByAttributes(array('stock_id' => $movement->src_stock_id, 'product_card_id' => $item->product_card_id));

                            //if found in source stock
                            if(!empty($in_source_stock))
                            {
                                //increase quantity
                                $in_source_stock ->qnt += $item->qnt;
                                $in_source_stock -> date_changed = time();
                                $in_source_stock -> update();

                                //save qnt to item (after stock updating) for reports
                                $item -> in_src_stock_after_movement = $in_source_stock->qnt;
                                $item -> save();
                            }
                            //if not found this kind of product in source stock
                            else
                            {
                                //create new item in stock and set quantity
                                $in_source_stock = new ProductInStock();
                                $in_source_stock -> stock_id = $movement->src_stock_id;
                                $in_source_stock -> product_card_id = $item->product_card_id;
                                $in_source_stock -> date_changed = time();
                                $in_source_stock -> date_created = time();
                                $in_source_stock -> save();
                            }
                        }
                        break;
                }

                //update movement status
                $movement -> status_id = $status_id;
                $movement -> update();

                //create movement stage
                $stage = new StockMovementStages();
                $stage -> movement_id = $movement->id; //relation with movement
                $stage -> movement_status_id = $status_id; //current movement status
                $stage -> remark = $remark; //operator's comment
                $stage -> user_operator_id = Yii::app()->user->id; //relation with operator
                $stage -> operator_name = Yii::app()->user->getState('name').' '.Yii::app()->user->getState('surname'); //operator's name
                $stage -> time = time(); // time
                $stage -> save(); //save

                //redirect to movement list
                $this->redirect(Yii::app()->createUrl('/stock/movements'));
            }
            //if not found
            else
            {
                //404 error
                throw new CHttpException(404);
            }

        }
        //if not got POST
        else
        {
            //404 error
            throw new CHttpException(404);
        }
    }//actionApplyStatus


    /******************************************************* A J A X  S E C T I O N *****************************************************************/

    /**
     * Auto-complete for products name and code
     * @param string $name
     * @param string $code
     * @throws CHttpException
     */
    public function actionAutoCompleteProductCards($name = '',$code = '')
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $result = json_encode(ProductCards::model()->findAllByNameOrCode($name,$code,true));
            echo $result;
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionAutoCompleteProductCards


    /**
     * Auto-complete for products name and code by stock
     * @param string $name
     * @param string $code
     * @param int $stock
     * @throws CHttpException
     */
    public function actionAutoCompleteProductCardsByStock($name = '',$code = '',$stock = null)
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $result = json_encode(ProductCards::model()->findAllByNameOrCodeAndStock($name,$code,$stock,true));
            echo $result;
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionAutoCompleteProductCardsByStock

    /**
     * Filter products by stock, code, name - for movement form and render table
     * @throws CHttpException
     */
    public function actionProdFilter()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $name = Yii::app()->request->getParam('name','');
            $code = Yii::app()->request->getParam('code','');
            $stock = Yii::app()->request->getParam('stock','');

            $result = ProductCards::model()->findAllByNameOrCodeAndStock($name,$code,$stock);

            $this->renderPartial('_ajax_products_filtering',array('products' => $result));
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionProdFilter


    /**
     * Ajax filtration for stock-products
     * @throws CHttpException
     */
    public function actionFilter()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $prod_name = Yii::app()->request->getParam('name','');
            $prod_code = Yii::app()->request->getParam('code','');
            $stock_loc_id = Yii::app()->request->getParam('location','');
            $units = Yii::app()->request->getParam('units','');
            $page = Yii::app()->request->getParam('page',1);

            //criteria for pagination
            $c = Pagination::getFilterCriteria(3,$page);

            //conditions - null by default
            $product_con_arr = null;
            $measure_con_arr = null;
            $location_con_arr = null;

            //if have product name and product code
            if(!empty($prod_name) && !empty($prod_code))
            {
                $product_con_arr = array('condition'=>'productCard.product_name LIKE "%'.$prod_name.'%" AND productCard.product_code LIKE "%'.$prod_code.'%"');
            }
            //if have just product name
            elseif(!empty($prod_name))
            {
                $product_con_arr = array('condition'=>'productCard.product_name LIKE "%'.$prod_name.'%"');
            }
            //if have just product code
            elseif(!empty($prod_code))
            {
                $product_con_arr = array('condition'=>'productCard.product_code LIKE "%'.$prod_code.'%"');
            }

            //if have units
            if(!empty($units))
            {
                $measure_con_arr = array('condition'=>'measureUnits.id= '.$units);
            }

            //if have location
            if(!empty($stock_loc_id))
            {
                $location_con_arr = array('condition'=>'location.id= '.$stock_loc_id);
            }


            //get all items by conditions and limit them by criteria
            $items = ProductInStock::model()->with(array(
                'productCard' => $product_con_arr,
                'productCard.measureUnits' => $measure_con_arr,
                'stock',
                'stock.location' => $location_con_arr))->findAll($c);

            //count all filtered items
            $count = ProductInStock::model()->with(array(
                'productCard' => $product_con_arr,
                'productCard.measureUnits' => $measure_con_arr,
                'stock',
                'stock.location' => $location_con_arr))->count();

            //calculate count of pages
            $pages = Pagination::calcPagesCount($count,3);

            //render table and pages
            $this->renderPartial('_ajax_table_filtering',array('items' => $items, 'pages' => $pages, 'current_page' => $page));
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionFilter


    public function actionMovementFilter()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            //get filter-params
            $movement_id = Yii::app()->request->getParam('movement_id',null);
            $src_stock_id = Yii::app()->request->getParam('src_stock_id',null);
            $trg_stock_id = Yii::app()->request->getParam('trg_stock_id',null);
            $date_from_str = Yii::app()->request->getParam('date_from_str','');
            $date_to_str = Yii::app()->request->getParam('date_to_str','');
            $page = Yii::app()->request->getParam('page',1);

            //pagination criteria
            $c = new CDbCriteria();

            //default time range
            $time_from = 0; //beginning of the times
            $time_to = time()+(60*60*24); //current time + one day

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

            //filtration by date
            $c -> addBetweenCondition('date',$time_from,$time_to);

            $conditions = array();
            if(!empty($movement_id))
            {
                $conditions['id'] = $movement_id;
            }
            if(!empty($src_stock_id))
            {
                $conditions['src_stock_id'] = $src_stock_id;
            }
            if(!empty($trg_stock_id))
            {
                $conditions['trg_stock_id'] = $trg_stock_id;
            }

            //get all items
            $c_pages = Pagination::getFilterCriteria(3,$page,$c);
            $items = StockMovements::model()->findAllByAttributes($conditions,$c_pages);

            //get count of all items
            $count = StockMovements::model()->countByAttributes($conditions,$c);
            $pages = Pagination::calcPagesCount($count,3);

            //render partial
            $this->renderPartial('_ajax_movement_filtering',array('items' => $items, 'pages' => $pages, 'current_page' => $page));
        }
        else
        {
            throw new CHttpException(404);
        }
    }
};