<?php

class ProductsController extends Controller
{
    /**
     * R E T U R N S  S U B M E N U  F O R  T H I S  C O N T R O L L E R
     */
    public function GetSubMenu()
    {
        $arr = array(
            'categories' => array('action' => 'categories','visible' => $this->rights['categories_see'] ? 1 : 0 , 'class' => 'list-products'),
            'add category' => array('action' => 'addcat', 'visible' => $this->rights['categories_add'] ? 1 : 0, 'class' => 'create-product'),
            'product cards' => array('action' => 'cards', 'visible' => $this->rights['products_see'] ? 1 : 0, 'class' => 'list-products'),
            'add product card' => array('action' => 'addcard', 'visible' => $this->rights['products_add'] ? 1 : 0, 'class' => 'create-product'),
        );

        return $arr;
    }

    /**
     * I N D E X
     */
    public function actionIndex()
    {
        $this->actionCategories();
    }

    /****************************************************************************************************************
     ***************************************** C A T E G O R I E S **************************************************
     ***************************************************************************************************************/


    /**
     * L I S T  C A T E G O R I E S
     */
    public function actionCategories()
    {
        //get all categories from database
        $categories = ProductCardCategories::model()->findAll();

        //actions for every record
        $actions = array(
            'edit' => array('controller' => Yii::app()->controller->id, 'action' => 'editcat', 'class' => 'actions action-edit', 'visible' => $this->rights['categories_edit'] ? 1 : 0),
            'delete' => array('controller' => Yii::app()->controller->id, 'action' => 'deletecat', 'class' => 'actions action-delete' , 'visible' => $this->rights['categories_delete'] ? 1 : 0),
        );

        //render list
        $this->render('list_categories',array('categories' => $categories, 'table_actions' => $actions));
    }

    /**
     * E D I T  C A T E G O R Y
     */
    public function actionEditCat($id = null)
    {
        //find in base
        $category = ProductCardCategories::model()->findByPk($id);

        //if not found - 404 error
        if(empty($category)){throw new CHttpException(404,$this->labels['item not found in base']);}

        //render form
        $this->render('edit_category',array('category' => $category));
    }

    /**
     * A D D  C A T E G O R Y
     */
    public function actionAddCat()
    {
        //render form
        $this->render('edit_category', array('category' => new ProductCardCategories()));
    }

    //D E L E T E  C A T E G O R Y
    public function actionDeleteCat($id = null)
    {
        $id = (int)$id;

        /* @var $category ProductCardCategories */

        //array of restrict-reasons
        $restricts = array();

        //find in base
        $category = ProductCardCategories::model()->findByPk($id);

        //if not found - 404 error
        if(empty($category)){throw new CHttpException(404,$this->labels['item not found in base']);}

        //check if this category used in product cards
        if(count($category->productCards) > 0){$restricts[]=$this->labels['this item used in'].' '.$this->labels['product cards'];}

        //if have no restricts
        if(empty($restricts))
        {
            //delete category
            $category->delete();

            //redirect to list
            $this->redirect(Yii::app()->createUrl(Yii::app()->controller->id.'/categories'));
        }

        //restrict
        else
        {
            $this->render('restricts',array('restricts' => $restricts));
        }
    }


    //U P D A T E  C A T E G O R Y
    public function actionUpdateCat()
    {
        //get id from request
        $id = Yii::app()->request->getParam('id',null);
        $name = Yii::app()->request->getParam('category_name','');
        $remark = Yii::app()->request->getParam('remark','');

        //find category
        $category = ProductCardCategories::model()->findByPk($id);

        //if found nothing - create new
        if(empty($category)){$category = new ProductCardCategories();}

        //form-validation object
        $validation = new ProductCategoryForm();
        //set attributes
        $validation->attributes = $_POST;
        //validate
        $validation->validate();
        //get errors
        $errors = $validation->getErrors();

        //if have errors
        if(empty($errors))
        {
            //set main params
            $category->name = $name;
            $category->remark = $remark;
            $category->status = 1;
            $category->date_changed = time();

            //if created new object
            if($category->isNewRecord)
            {
                //creation time
                $category->date_created = time();

                //save
                $category->save();
            }
            //if update old object
            else
            {
                //update
                $category->update();
            }

            //redirect to list
            $this->redirect(Yii::app()->createUrl(Yii::app()->controller->id.'/categories'));
        }
        //if have som errors
        else
        {
            //render form with errors
            $this->render('edit_category',array('category' => $category, 'errors' => $errors));
        }

    }


    /****************************************************************************************************************
     ****************************************** P R O D U C T  C A R D S ********************************************
     ***************************************************************************************************************/

    // L I S T  C A R D S
    public function actionCards()
    {

        //get filter params
        $category_id = Yii::app()->request->getParam('cat','');
        $product_code = Yii::app()->request->getParam('cod','');
        $name = Yii::app()->request->getParam('nam','');

        //get page
        $page = Yii::app()->request->getParam('page',1);

        //criteria
        $c = new CDbCriteria();

        //if have filter params - add conditions to criteria
        if($category_id != ''){$c -> addInCondition('category_id',array($category_id));}
        if($product_code != ''){$c -> addInCondition('product_code',array($product_code));}
        if($name != ''){$c -> addInCondition('product_name',array($name));}

        //get all cards
        $cards = ProductCards::model()->with('category')->findAll($c);
        $categories = ProductCardCategories::model()->findAll();

        //actions for every record
        $actions = array(
            'edit' => array('controller' => Yii::app()->controller->id, 'action' => 'editcard', 'class' => 'actions action-edit', 'visible' => $this->rights['categories_edit'] ? 1 : 0),
            'delete' => array('controller' => Yii::app()->controller->id, 'action' => 'deletecard', 'class' => 'actions action-delete' , 'visible' => $this->rights['categories_delete'] ? 1 : 0),
        );

        //render list
        $this->render('list_cards',array('cards' => $cards, 'table_actions' => $actions, 'categories' => $categories));
    }


  /**
   * E D I T
   */ 
    public function actionEditCard($id = null)
    {
        $id = (int)$id;
        $card = ProductCards::model()->findByPk($id);
        if(!empty($card)){
              
            $model = new ProductCardForm();
    
            //get all categories
            $categories = ProductCardCategories::model()->getDropList();
            if(isset($_POST['ProductCardForm'])){
                $model->attributes = $_POST['ProductCardForm'];
                if($model->validate()){
                    $card->attributes = $_POST['ProductCardForm'];
                    $card->update();
                    $this->redirect('/products/cards');
                }
            }
            //render form
            $this->render('edit_card',array('categories' => $categories, 'card' => $card,'model'=>$model));
            
        }else{        
            throw new CHttpException(404,$this->labels['item not found in base']);
        }      
    }// edit

    
    /**
     *  ADD CARD
     */
    public function actionAddCard()
    {
        $model = new ProductCardForm();
        //get all categories
        $categories = ProductCardCategories::model()->getDropList();
        if(isset($_POST['ProductCardForm'])){
            $model->attributes = $_POST['ProductCardForm'];
            if($model->validate()){
                $saveModel = new ProductCards();
                $saveModel->attributes = $_POST['ProductCardForm'];
                $saveModel->save();
                $this->redirect('cards');
            }
        }        
        //render form
        $this->render('edit_card',array('categories' => $categories,'model'=>$model ,'card' => new ProductCards()));
    }
    
    

    
    
    /**
     * DELETE
     */
    public function actionDeleteCard($id = null){
        $id = (int)$id;
        $card = ProductCards::model()->with('operationsIns','operationsOuts','productInStocks')->findByPk($id);
        
        if(!empty($card)){
            if(count($card->operationsIns)== 0 && count($card->operationsOuts) == 0 && count($card->productInStocks)== 0 ){
                $card->delete();
                $this->redirect('/products/cards');
            }else{
                $restricts=$this->labels['this item used in'];
                $this->render('restricts',array('restricts' => $restricts));
            }
            
        }else{
            throw new CHttpException(404,$this->labels['item not found in base']);    
        }
    }// delete
}