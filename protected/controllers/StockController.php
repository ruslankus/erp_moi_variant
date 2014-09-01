<?php

class StockController extends Controller
{
    /**
     * @return array
     */
    public function GetSubMenu()
    {
        $arr = array(
            'services' => array('action' => 'list','visible' => $this->rights['services_see'] ? 1 : 0 , 'class' => 'list-products'),
            'add service' => array('action' => 'create', 'visible' => $this->rights['services_add'] ? 1 : 0, 'class' => 'create-product'),
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
    
    
    public function actionList()
    {
        $productsObj = ProductInStock::model()->with('stock.location','productCard')->findAll();
        
        $this->render('list',array('products' => $productsObj));
    }
};