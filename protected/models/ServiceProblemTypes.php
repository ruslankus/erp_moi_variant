<?php

/**
 * This is the model class for table "service_problem_types".
 *
 * The followings are the available columns in table 'service_problem_types':
 * @property integer $id
 * @property string $label
 * @property string $description
 * @property string $problem_code
 *
 * The followings are the available model relations:
 * @property ServiceProcesses[] $serviceProcesses
 */
class ServiceProblemTypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'service_problem_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label, description, problem_code', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, label, description, problem_code', 'safe', 'on'=>'search'),
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
			'serviceProcesses' => array(self::HAS_MANY, 'ServiceProcesses', 'problem_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'label' => 'Label',
			'description' => 'Description',
			'problem_code' => 'Problem Code',
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
		$criteria->compare('label',$this->label,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('problem_code',$this->problem_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceProblemTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    /**
     * Returns all clients as pairs 'id'=>'name'
     * @return array
     */
    public function findAllAsArray()
    {
        /* @var $type ServiceProblemTypes */

        //declare empty array
        $arr = array();

        //get all
        $all = ServiceProblemTypes::model()->findAll();

        //make array
        foreach($all as $type)
        {
            $arr[$type->id] = $type->label.' ('.$type->problem_code.')' ;
        }

        return $arr;
    }
}
