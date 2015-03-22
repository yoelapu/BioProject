<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property string $idtbl_user
 * @property string $username
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{
    public $PasswordCheck;
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password, PasswordCheck', 'required'),
			array('username, email', 'length', 'max'=>255),
			array('password', 'length', 'max'=>64),
                        array('username', 'unique', 'className'=>'User', 'message'=>'The {attribute} is already in use, please pick another one.'),
                        array('PasswordCheck', 'validatePasswordMatch', 'message' => 'The passwords provided don\'t match'),
                        array('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idtbl_user, username, password, email', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtbl_user' => 'Idtbl User',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
                        'PasswordCheck' => 'Confirm Password',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Obtains the user from the database, if the username provided exists
         * @param type $pUserName
         * @return null|User object
         */
        public function getUserFromUserName($pUserName){
            $call = 'SELECT * FROM getUser(:pusername)';
            $connection = Yii::app()->db;
            $command = $connection->createCommand($call);
	   // $pUserName = 'abc';
            $command->bindParam(':pusername', $pUserName, PDO::PARAM_STR);
            $result = $command->queryRow();
             if ($result == false)
                 return null;
              else {
                  $user = new User;
                  $user->idtbl_user = $result['idtbl_user'];
                  $user->password = $result['password'];
                  $user->username = $result['username'];
                  $user->email = $result['email'];
                 return $result;
              }             
        }
        
        public function validatePasswordMatch($attribute){
            if(!($this->PasswordCheck == $this->password))
                $this->addError($attribute, 'The passwords provided don\'t match');
        }
}
