<?php
class BaseForm extends CFormModel {

    protected $_labels = array();
    protected $_messages = array();
    
    public function init(){
        //$currLanguage = Yii::app()->getLanguage();
       
        $this->_labels = Labels::model()->getLabels();
        $this->_messages = FormMessages::model()->getLabels();       
    }
}
?>