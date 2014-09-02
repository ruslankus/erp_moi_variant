<?php

/**
 * This is the model class for table "option_cards".
 *
 * The followings are the available columns in table 'option_cards':
 * @property integer $id
 * @property string $name
 * @property integer $date_created
 * @property integer $date_changed
 * @property integer $user_modified_by
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property OperationsOutOptItems[] $operationsOutOptItems
 */
class OptionCards extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'option_cards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_created, date_changed, user_modified_by, status', 'numerical', 'integerOnly'=>true),
			array('name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, date_created, date_changed, user_modified_by, status', 'safe', 'on'=>'search'),
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
			'operationsOutOptItems' => array(self::HAS_MANY, 'OperationsOutOptItems', 'option_card_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'date_created' => 'Date Created',
			'date_changed' => 'Date Changed',
			'user_modified_by' => 'User Modified By',
			'status' => 'Status',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_created',$this->date_created);
		$criteria->compare('date_changed',$this->date_changed);
		$criteria->compare('user_modified_by',$this->user_modified_by);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OptionCards the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
