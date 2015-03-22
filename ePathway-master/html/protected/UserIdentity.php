<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    
    private $_id;
    
    public function same($a, $b) {
        /**
         * @see http://codereview.stackexchange.com/questions/13512 
         */
        if (!is_string($a) || !is_string($b)) {
            return false;
        }
        $mb = function_exists('mb_strlen');
        $length = $mb ? mb_strlen($a, '8bit') : strlen($a);
        if ($length !== ($mb ? mb_strlen($b, '8bit') : strlen($b))) {
            return false;
        }
        $check = 0;
        for ($i = 0; $i < $length; $i += 1) {
            $check |= (ord($a[$i]) ^ ord($b[$i]));
        }
        return $check === 0;
    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = new User;
        /*
        $record = User::model()->getUserFromUserName($this->username); //User::model()->findByAttributes(array('username' => $this->username));
        $user->setAttributes($record);
        //Yii::log(print_r($record,true),"info", "system.user");
        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } //else if ($record['password'] !== crypt($this->password, $record['password'])) {
        else if (!$this->same($record['password'], crypt($this->password, $record['password']))) {
        //else if(false){
            Yii::log(print_r(crypt($this->password, $record['password']), true), "info", "system.user");
            Yii::log(print_r($record['password'].'asdf', true), "info", "system.user");
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $record['idtbl_user'];
            $this->setState('username', $record['username']);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;*/
        
        $users=array(
          // username => password
          'epa_master'=>'admin',
          );
          if(!isset($users[$this->username]))
          $this->errorCode=self::ERROR_USERNAME_INVALID;
          elseif($users[$this->username]!==$this->password)
          $this->errorCode=self::ERROR_PASSWORD_INVALID;
          else
          $this->errorCode=self::ERROR_NONE;
          return !$this->errorCode;
    }


}
