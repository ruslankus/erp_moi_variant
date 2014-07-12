<?php

/**
 * This is the model class for table "product_card_categories".
 *
 * The followings are the available columns in table 'product_card_categories':
 * @property integer $id
 * @property string $name
 * @property string $remark
 * @property integer $status
 * @property integer $date_created
 * @property integer $date_changed
 * @property integer $user_modified_by
 *
 * The followings are the available model relations:
 * @property ProductCards[] $productCards
 */
class ProductCardCategories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_card_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, date_created, date_changed, user_modified_by', 'numerical', 'integerOnly'=>true),
			array('name, remark', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, remark, status, date_created, date_changed, user_modified_by', 'safe', 'on'=>'search'),
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
			'productCards' => array(self::HAS_MANY, 'ProductCards', 'category_id'),
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
			'remark' => 'Remark',
			'status' => 'Status',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('status',$this->status);
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
	 * @return ProductCardCategories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    
    /**
     * Getting array for droplist
     */
    public function getDropList(){
        
        $labels = array();
        
        $connection = $this->getDbConnection();
        $sql="SELECT id, name FROM ".$this->tableName();
        $dataReader=$connection->createCommand($sql)->query();
        // привязываем первое поле (label) к переменной $label
        $dataReader->bindColumn(1,$label_id);
        // привязываем второе поле (value) к переменной $value
        $dataReader->bindColumn(2,$value);
        
        while($dataReader->read()!==false)
        {
            $labels[$label_id] = $value;   
        }
        
        return $labels;
    }
}
