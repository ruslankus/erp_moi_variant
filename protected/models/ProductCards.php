<?php

/**
 * This is the model class for table "product_cards".
 *
 * The followings are the available columns in table 'product_cards':
 * @property integer $id
 * @property integer $category_id
 * @property string $product_name
 * @property string $product_code
 * @property string $description
 * @property integer $default_price
 * @property integer $measure_units_id
 * @property string $additional_params
 * @property integer $status
 * @property integer $date_created
 * @property integer $date_changed
 * @property integer $user_modified_by
 * @property integer $weight
 * @property integer $weight_net
 * @property integer $height
 * @property integer $length
 * @property integer $width
 * @property integer $size_units_id
 *
 * The followings are the available model relations:
 * @property OperationsInItems[] $operationsInItems
 * @property OperationsOutItems[] $operationsOutItems
 * @property ProductCardCategories $category
 * @property MeasureUnits $measureUnits
 * @property SizeUnits $sizeUnits
 * @property ProductFiles[] $productFiles
 * @property ProductInStock[] $productInStocks
 * @property StockMovementItems[] $stockMovementItems
 */
class ProductCards extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_cards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, default_price, measure_units_id, status, date_created, date_changed, user_modified_by, weight, weight_net, height, length, width, size_units_id', 'numerical', 'integerOnly'=>true),
			array('product_name, product_code, description, additional_params', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, product_name, product_code, description, default_price, measure_units_id, additional_params, status, date_created, date_changed, user_modified_by, weight, weight_net, height, length, width, size_units_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'operationsInItems' => array(self::HAS_MANY, 'OperationsInItems', 'product_card_id'),
			'operationsOutItems' => array(self::HAS_MANY, 'OperationsOutItems', 'product_card_id'),
			'category' => array(self::BELONGS_TO, 'ProductCardCategories', 'category_id'),
			'measureUnits' => array(self::BELONGS_TO, 'MeasureUnits', 'measure_units_id'),
			'sizeUnits' => array(self::BELONGS_TO, 'SizeUnits', 'size_units_id'),
			'productFiles' => array(self::HAS_MANY, 'ProductFiles', 'product_card_id'),
			'productInStocks' => array(self::HAS_MANY, 'ProductInStock', 'product_card_id'),
			'stockMovementItems' => array(self::HAS_MANY, 'StockMovementItems', 'product_card_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'product_name' => 'Product Name',
			'product_code' => 'Product Code',
			'description' => 'Description',
			'default_price' => 'Default Price',
			'measure_units_id' => 'Measure Units',
			'additional_params' => 'Additional Params',
			'status' => 'Status',
			'date_created' => 'Date Created',
			'date_changed' => 'Date Changed',
			'user_modified_by' => 'User Modified By',
			'weight' => 'Weight',
			'weight_net' => 'Weight Net',
			'height' => 'Height',
			'length' => 'Length',
			'width' => 'Width',
			'size_units_id' => 'Size Units',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_code',$this->product_code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('default_price',$this->default_price);
		$criteria->compare('measure_units_id',$this->measure_units_id);
		$criteria->compare('additional_params',$this->additional_params,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_created',$this->date_created);
		$criteria->compare('date_changed',$this->date_changed);
		$criteria->compare('user_modified_by',$this->user_modified_by);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('weight_net',$this->weight_net);
		$criteria->compare('height',$this->height);
		$criteria->compare('length',$this->length);
		$criteria->compare('width',$this->width);
		$criteria->compare('size_units_id',$this->size_units_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductCards the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    /**
     * Returns array of data-items - products from database by code or name
     * @param string $name
     * @param string $code
     * @param bool $for_auto_complete
     * @return array
     */
    public function findAllByNameOrCode($name,$code,$for_auto_complete = false)
    {
        $data = array();
        $sql = "SELECT * FROM ".$this->tableName();
        if($name != '' && $code == '') $sql = "SELECT * FROM ".$this->tableName()." WHERE product_name LIKE '%".$name."%'";
        elseif($code != '' && $name == '') $sql = "SELECT * FROM ".$this->tableName()." WHERE product_code LIKE '%".$code."%'";
        elseif($code != '' && $name != '') $sql = "SELECT * FROM ".$this->tableName()." WHERE product_code LIKE '%".$code."%' AND product_name LIKE '%".$name."%'";

        if($name != '' || $code != '')
        {
            if(!$for_auto_complete)
            {
                $con = Yii::app()->db;
                $data = $con->createCommand($sql)->queryAll(true);
            }
            else
            {
                $con = Yii::app()->db;
                $rows = $con->createCommand($sql)->queryAll(true);
                foreach($rows as $row)
                {
                    $data[] = array('label' => $code != '' ? $row['product_code'] : $row['product_name'], 'id' => $row['id']);
                }
            }
        }

        return $data;
    }


    /**
     * Returns array of data-item by stock, name, code (quantity in stock must be more than zero)
     * @param string $name
     * @param string $code
     * @param int $stock_id
     * @param bool $for_auto_complete
     * @return array
     */
    public function findAllByNameOrCodeAndStock($name, $code, $stock_id, $for_auto_complete = false)
    {
        /* @var $stock Stocks */
        /* @var $items ProductInStock[] */

        $result = array();

        $stock = Stocks::model()->findByPk($stock_id);
        $items = $stock->productInStocks;

        if(empty($stock_id)) return $result;

        foreach($items as $item)
        {
            if(empty($code) && stristr($item->productCard->product_name,$name) != false)
            {
                if($item->qnt > 0)
                {
                    if($for_auto_complete)
                    {
                        $result[] = array('label' => $item->productCard->product_name, 'id' => $item->productCard->id);
                    }
                    else
                    {
                        $result[] = $item;
                    }
                }
            }
            elseif(!empty($code) && stristr($item->productCard->product_code,$code) != false)
            {
                if($item->qnt > 0)
                {
                    if($for_auto_complete)
                    {
                        $result[] = array('label' => $item->productCard->product_code, 'id' => $item->productCard->id);
                    }
                    else
                    {
                        $result[] = $item;
                    }
                }
            }
        }

        return $result;
    }
}
