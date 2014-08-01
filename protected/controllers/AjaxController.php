<?php
class AjaxController extends Controller {
 
    
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
     * Prints json-converted array of client-ids and client-names (used in srv_create.php)
     * @param string $start
     * @throws CHttpException
     */
    public function actionClients($term=null)
    {
       
        if(Yii::app()->request->isAjaxRequest)
        {
            $result = Clients::model()->getAllClientsJson($term);
            echo $result;
        }
        else
        {
            throw new CHttpException(404);
        }

    }//Clients
    
    
    public function actionCheck_customer(){
        $request = Yii::app()->request;
        if($request->isAjaxRequest){
            $name = $request->getPost('name');
            
            if(!empty($name)){
                //clear 
                $name = trim($name);
                $arrName = explode(" ",$name);
                
                $data = Clients::model()->checkClient($arrName);
                Debug::d($data);
            }
        }else{
            throw new CHttpException(404);
        }
    }//Check_customer
    
    
    
    
    /**
     * Finds client by name or company name, and prints his ID if found (used in srv_create.php)
     * @param string $name
     * @throws CHttpException
     */
    public function actionCliFi($name = '')
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            //remove all connecting symbols, replace them with spaces
            $name = str_replace("%20"," ",$name);
            $name = str_replace("+"," ",$name);
            
            //get array of separated-by-spaces words
            $words = explode(" ",$name);

            //if complex name (name and surname expecting)
            if(count($words) > 1)
            {
                //sql statement
                $sql = "SELECT * FROM clients WHERE company_name = '".$name."' OR ((name LIKE '".$words[0]."') AND (surname LIKE '".$words[1]."'))";
            }
            //if simple name (one word)
            else
            {
                $sql = "SELECT * FROM clients WHERE company_name = '".$name."' OR name LIKE '".$name."%'";
            }

            //connection
            $con = Yii::app()->db;

            //get row by query
            $data=$con->createCommand($sql)->queryRow();

            //if find something
            if(!empty($data))
            {
                //client
                $client = new Clients();
                //set attributes from base to client
                $client -> attributes = $data;
                //render form partial
                $this->renderPartial('_client_form_old_client',array('client' => $client, 'id' => $data['id']));
            }
            //if not find
            else
            {
                //get full name or company name
                count($words) > 1 ? $client_name = $words[0].' '.$words[1] : $client_name = $words[0];

                //render partial
                $this->renderPartial('_client_form_new_client',array('client_name' => $client_name));
            }

        }
        else
        {
            throw new CHttpException(404);
        }
    }//actionCliFi 
    
    
    public function actionFselector($id = null){
        
        if(Yii::app()->request->isAjaxrequest){
            
            if($id == 1){                
                echo $this->renderPartial('_filter',array(),true);                
            }else if($id == 2){
                echo $this->renderPartial('_filter_jur',array(),true);
            }
            
        }else{
            throw new CHttpException(404);
        }
        
    }//Fselector
    
    
}
?>