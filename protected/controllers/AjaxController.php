<?php
class AjaxController extends Controller
{
 
    
    public function actionProduct(){
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            
            $category_id = $request->getPost('category');
            if(!empty($category_id)){
                $objProds = ProductCards::model()->with('category')->findAllByAttributes(array('category_id'=>$category_id));
                
                $table = $this->renderPartial('_table',array('objProds'=>$objProds),true);
            } 
            
            
            echo $table;
        }else{
            throw new CHttpException(404);
        }
        
    }
    
    
    
    /**
     * Ajax action go change status of different objects
     * @param $id  int id of object
     */

    public function actionChangeProductStatus($id = null)
    {
        //if this is ajax
        if(Yii::app()->request->isAjaxRequest)
        {
            //try find
            $object =  ProductCards::model()->findByPk($id);
            //if found
            if($object)
            {
                if($object->status == 1){
                    $object->status = 0;
                }else{
                    $object->status = 1;
                }
                //update
                $object->update();
                //out success message
                exit('SUCCESS');
            }
            //if not found
            else
            {
                //out fail message
                exit('FAILED');
            }
        }

    }//actionChangrProductStatus
    
    
    /**
     * autocoplite fir purchase step1
     */
    public function actionSellers($term = null)
    {
        if(Yii::app()->request->isAjaxRequest)
        {   
            $result = Suppliers::model()->getAllClientsJson($term);
            echo $result;
        
        }else{
            throw new CHttpException(404);
        }
    }//actionSellers
    
    
    public function actionSellfilter()
    {
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            $name = $request->getPost('name');
           
            
            $data = Suppliers::model()->getSeller($name);
            if(!empty($data)){
                echo $this->renderPartial('_filterSuppTable',array('data'=>$data),true);
            }else{
                echo $this->renderPartial('_emptyTable',array(),true); 
            }
                        
        }else{
            throw new CHttpException(404);
        }
    }// sellFilter
    
    
    
    
    
    /**
     * Prints json-converted array of client-ids and client-names (used in srv_create.php)
     * @param string $start
     * @throws CHttpException
     */
    public function actionClients($term=null,$type=null)
    {
       
        if(Yii::app()->request->isAjaxRequest)
        {
            $result = Clients::model()->getAllClientsJson($term,$type);
            echo $result;
        }
        else
        {
            throw new CHttpException(404);
        }

    }//Clients
    
      

    
    /**
     * controller for service parts partrts
     */
    public function actionCustfilter()
    {
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            $name = $request->getPost('name');
            $type = $request->getPost('type');
            
            $data = Clients::model()->getClients($name,$type);
            if(!empty($data)){
                echo $this->renderPartial('_filterTable',array('data'=>$data,'type' => $type),true);
            }else{
                echo $this->renderPartial('_emptyTable',array(),true); 
            }
                        
        }else{
            throw new CHttpException(404);
        }
    }// custFilter
    
    
    
/*---------------------------- BUY PART ------------------------------------*/
    
 /**
     * Renders table of products
     * @param string $name
     * @param string $code
     */
    public function actionFindProductsModal()
    {
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            
            $name = $request->getPost('name');
            $code = $request->getPost('code'); 
            
            $rows = ProductCards::model()->findAllByNameOrCode($name,$code);
            $this->renderPartial('_find_prod_partial',array('rows' => $rows));
            
        }else{
            throw new CHttpException(404);
        }
        
    }// actionFindProductsModal  
    
    
    public function actionAutoCompleteProductsName($term = null)
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $result = json_encode(ProductCards::model()->findAllByNameOrCode($term,'',true));
            echo $result;
        }else{
            throw new CHttpException(404);
        }
    }//actionAutoCompleteProductsName
    
    
    public function actionAutoCompleteProductsCode($term = null)
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $result = json_encode(ProductCards::model()->findAllByNameOrCode('',$term,true));
            echo $result;
        }else{
            throw new CHttpException(404);
        }
    }//actionAutoCompleteProductsCode
    
    
    public function actionSellinfo($id = null)
    {
        $id = (int)$id;
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            $data = Suppliers::model()->findByPk($id);
            $modal = $this->renderPartial('supp_info_modal',array('data' => $data,),true);
            echo $modal;
        }else{
            throw new CHttpException(404);
        }
    }//custInfo
    
    
    
 
/*-------------------------------- SELLER PART ----------------------------*/    
    
    public function actionFselector($id = null)
    {
        
        if(Yii::app()->request->isAjaxrequest){
            
            if($id == 1){                
                echo $this->renderPartial('_filter_jur',array(),true);                
            }else if($id == 2){
                echo $this->renderPartial('_filter_fiz',array(),true);
            }
            
        }else{
            throw new CHttpException(404);
        }
        
    }//Fselector
    
    
    
    public function actionCusFilterSales()
    {
        $request = Yii::app()->request;
    
        if($request->isAjaxRequest){
        
            $name = $request->getPost('name');
            $type = $request->getPost('type');        
        
            $data = Clients::model()->getClients($name,$type);
        
            if(!empty($data)){
                echo $this->renderPartial('_filterTableSales',array('data'=>$data,'type' => $type),true);
            }else{
                echo $this->renderPartial('_emptyTable',array(),true);
            }
        
        }else{
            throw new CHttpException(404);
        }
    }//cusFilterSales
    
    
    public function actionCusInfoSales($id = null)
    {
        $id = (int)$id;
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            $data = Clients::model()->findByPk($id);
            $modal = $this->renderPartial('_customer_info_modal_sales',array('client' => $data),true);
            echo $modal;
        }else{
            throw new CHttpException(404);
        }
    }//cusInfoSales
    
    
    public function actionAutoCompleteFromStockByName($term = null, $stock = null)
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $result = json_encode(ProductCards::model()->findAllByNameOrCodeAndStock($term,'',$stock,true));
            echo $result;
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionAutoCompleteFromStockByName
    
    
    public function actionFilterByStockCodeAndName()
    {
        $request = Yii::app()->request; 
        if($request->isAjaxRequest)
        {
            $name = $request->getPost('name');
            $code = $request->getPost('code');
            $stock = $request->getPost('stock');
            
            $result = ProductCards::model()->findAllByNameOrCodeAndStock($name,$code,$stock);
            echo $this->renderPartial('_filtered_for_sales',array('items' => $result),true);
            
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionFilterByStockCodeAndName
    
    
    public function actionOperationOutInfo($id = null)
    {
        if($operation = OperationsOut::model()->findByPk($id))
        {
            $this->renderPartial('_operation_out',array('operation' => $operation));
        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionOperationOutInfo
    
 
 
 
 /*--- old ---*/   

    
    /**
     *  for service part
     */
    public function actionCustinfo($id = null)
    {
        $id = (int)$id;
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            $data = Clients::model()->findByPk($id);
            $modal = $this->renderPartial('_customer_info_modal_service',array('data' => $data,),true);
            echo $modal;
        }else{
            throw new CHttpException(404);
        }
    }//custInfo
    
    
    /**
     *  for sell part
     */
    public function actionCustinfoInv($id = null)
    {
        $id = (int)$id;
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            $data = Clients::model()->findByPk($id);
            $modal = $this->renderPartial('_customer_info_modal_invoice',array('data' => $data,),true);
            echo $modal;
        }else{
            throw new CHttpException(404);
        }
    }//custInfo
     
    
    
    
}
?>