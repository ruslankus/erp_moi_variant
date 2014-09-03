<?php

/**
 * This is the model class for table "operations_in_items".
 *
 * The followings are the available columns in table 'operations_in_items':
 * @property integer $id
 * @property integer $product_card_id
 * @property integer $operation_id
 * @property integer $qnt
 * @property integer $date
 * @property integer $price
 * @property integer $stock_id
 * @property integer $stock_qnt_after_op
 * @property integer $client_id
 *
 * The followings are the available model relations:
 * @property OperationsIn $operation
 * @property ProductCards $productCard
 * @property Stocks $stock
 */
class OperationsInItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'operations_in_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_card_id, operation_id, qnt, date, price, stock_id, stock_qnt_after_op, client_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_card_id, operation_id, qnt, date, price, stock_id, stock_qnt_after_op, client_id', 'safe', 'on'=>'search'),
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
			'operation' => array(self::BELONGS_TO, 'OperationsIn', 'operation_id'),
			'productCard' => array(self::BELONGS_TO, 'ProductCards', 'product_card_id'),
			'stock' => array(self::BELONGS_TO, 'Stocks', 'stock_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_card_id' => 'Product Card',
			'operation_id' => 'Operation',
			'qnt' => 'Qnt',
			'date' => 'Date',
			'price' => 'Price',
			'stock_id' => 'Stock',
			'stock_qnt_after_op' => 'Stock Qnt After Op',
			'client_id' => 'Client',
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
		$criteria->compare('product_card_id',$this->product_card_id);
		$criteria->compare('operation_id',$this->operation_id);
		$criteria->compare('qnt',$this->qnt);
		$criteria->compare('date',$this->date);
		$criteria->compare('price',$this->price);
		$criteria->compare('stock_id',$this->stock_id);
		$criteria->compare('stock_qnt_after_op',$this->stock_qnt_after_op);
		$criteria->compare('client_id',$this->client_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OperationsInItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
