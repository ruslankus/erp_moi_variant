<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main_layout';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    protected $labels;
    protected $rights = array();
    protected $messages = array();
    //default titles of site pages
    public $site_title = "ERP";
    public $page_title = "default";
    
    public function init(){
       $this->labels = Labels::model()->getLabels();
       $this->rights = Yii::app()->user->getState('rights');
       $this->messages = FormMessages::model()->getLabels();
    }

    
    //do before every action
    protected function beforeAction($action) {

        //if current action - not login
        if (Yii::app()->controller->action->id!=='login')
        {
            //if user not logged in
            if (Yii::app()->user->isGuest)
            {
                //redirect to login
                $this->redirect($this->createUrl('//main/login'));
            }
        }

        return parent::beforeAction($action);
    }//before action
    
    
       /**
     * Converts entered by user price to cents-format for storing in database
     * @param string $str_price
     * @return int|mixed|string
     */
    public function priceStrToCents($str_price)
    {
        //replace comma with dot
        $value = str_replace(',','.',$str_price);

        //delete empty spaces
        $value = str_replace(' ','',$value);

        //if this is number
        if(is_numeric($value))
        {
            //multiply by 100
            $value = $value * 100;
        }

        return $value;
    }//priceStrToCents

    /**
     * Converts cent-format price to user readable price-value
     * @param int $value
     * @param string $currency_prefix
     * @param string $currency_postfix
     * @return float|string
     */
    public function centsToPriceStr($value, $currency_prefix = '', $currency_postfix = '')
    {
        //if this is number
        if(is_numeric($value))
        {
            //divide by 100
            $price = $value / 100;

            //price
            $price = number_format($price,2,',','');

            //add prefix and postfix
            $price = $currency_prefix.$price.$currency_postfix;
        }
        //if not number
        else
        {
            $price = $currency_prefix.$value.$currency_postfix;
        }

        return $price;
    }//centsToPriceStr 
    
}