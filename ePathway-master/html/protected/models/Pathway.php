<?php

/**
 * This is the model class for table "tbl_rutametabolica".
 *
 * The followings are the available columns in table 'tbl_rutametabolica':
 * @property string $idtbl_rutametabolica
 * @property string $nombreruta
 * @property string $urlruta
 *
 * The followings are the available model relations:
 * @property TblGenporrutametabolica[] $tblGenporrutametabolicas
 */
class Pathway extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pathway the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_rutametabolica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreruta', 'required'),
			array('nombreruta, urlruta', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nombreruta, urlruta', 'safe', 'on'=>'search'),
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
			'tblGenporrutametabolicas' => array(self::HAS_MANY, 'TblGenporrutametabolica', 'idtbl_rutametabolica'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtbl_rutametabolica' => 'ID Rutametabolica',
			'nombreruta' => 'Pathway Name',
			'urlruta' => 'Pathway URL',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nombreruta',$this->nombreruta,true);
		$criteria->compare('urlruta',$this->urlruta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}