<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

   /**
    *  authenticates user
    */
    public function authenticate()
    {
               
           
            $user_record = Users::model()->with('userRights')->findByAttributes(array('username' => $this->username));
            
            if($user_record===null){              
                $this->errorCode=self::ERROR_USERNAME_INVALID;            
            }elseif($user_record->password !== md5($this->password)){               
                $this->errorCode=self::ERROR_PASSWORD_INVALID;           
            }else{
            
                //set new user id (primary key from db)
                $this->_id=$user_record->id;

                //set all data from db to user-session/cookie
                $this->setState('id',$user_record->id);
                $this->setState('username',$user_record->username);
                $this->setState('email', $user_record->email);
                $this->setState('name',$user_record->name);
                $this->setState('surname', $user_record->surname);
                $this->setState('phone', $user_record->phone);
                $this->setState('address', $user_record->address);
                $this->setState('remark', $user_record->remark);
                $this->setState('role', $user_record->role);
                $this->setState('status',$user_record->status);
                $this->setState('avatar',$user_record->avatar);
                
                //get all rights
                $rights = array();

                /* @var $user_right UserRights */
                /* @var $right Rights */

                foreach($user_record->userRights as $user_right)
                {
                    $right = Rights::model()->findByPk($user_right->rights_id);
                    $rights[$right->label] = 1;
                }
                
                $this->setState('rights',$rights);
                
                //no errors
                $this->errorCode=self::ERROR_NONE;
            }
        
        return !$this->errorCode;
    }

    //returns id
    public function getId()
    {
        return $this->_id;
    }

}