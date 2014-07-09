<?php

/**
 * This is the model class for table "invoices_out".
 *
 * The followings are the available columns in table 'invoices_out':
 * @property integer $id
 * @property string $invoice_code
 * @property integer $invoice_date
 * @property integer $warranty_days
 * @property integer $warranty_start_date
 * @property integer $payment_method_id
 * @property integer $type
 * @property string $signer_name
 * @property integer $client_id
 * @property integer $date_created
 * @property integer $date_changed
 * @property integer $user_modified_by
 *
 * The followings are the available model relations:
 * @property Clients $client
 * @property PaymentMethods $paymentMethod
 * @property OperationsOut[] $operationsOuts
 * @property OperationsSrv[] $operationsSrvs
 */
class InvoicesOut extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'invoices_out';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_date, warranty_days, warranty_start_date, payment_method_id, type, client_id, date_created, date_changed, user_modified_by', 'numerical', 'integerOnly'=>true),
			array('invoice_code, signer_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoice_code, invoice_date, warranty_days, warranty_start_date, payment_method_id, type, signer_name, client_id, date_created, date_changed, user_modified_by', 'safe', 'on'=>'search'),
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
			'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethods', 'payment_method_id'),
			'operationsOuts' => array(self::HAS_MANY, 'OperationsOut', 'invoice_id'),
			'operationsSrvs' => array(self::HAS_MANY, 'OperationsSrv', 'invoice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoice_code' => 'Invoice Code',
			'invoice_date' => 'Invoice Date',
			'warranty_days' => 'Warranty Days',
			'warranty_start_date' => 'Warranty Start Date',
			'payment_method_id' => 'Payment Method',
			'type' => 'Type',
			'signer_name' => 'Signer Name',
			'client_id' => 'Client',
			'date_created' => 'Date Created',
			'date_changed' => 'Date Changed',
			'user_modified_by' => 'User Modified By',
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
		$criteria->compare('invoice_code',$this->invoice_code,true);
		$criteria->compare('invoice_date',$this->invoice_date);
		$criteria->compare('warranty_days',$this->warranty_days);
		$criteria->compare('warranty_start_date',$this->warranty_start_date);
		$criteria->compare('payment_method_id',$this->payment_method_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('signer_name',$this->signer_name,true);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('date_created',$this->date_created);
		$criteria->compare('date_changed',$this->date_changed);
		$criteria->compare('user_modified_by',$this->user_modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvoicesOut the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
