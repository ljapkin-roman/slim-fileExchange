<?php

namespace Summit\Models;

use Summit\Core\Model;
use Summit\classes\User;
use Summit\Validators\Validation_User as Valid_User;

class Model_Login extends Model
{
    public array $dataUser = ['errors' => [], 'session' => []];
    private object $user;
    public function isUserValid($email, $password)
    {

        if($this->isEmailExist($email))
        {
            $hashPassword = $this->user->password;
            if (password_verify($password, $hashPassword))
            {
                $this->dataUser['session'] = $this->getDataToSession($this->user);
                return $this->dataUser;
            }
            else {
                $this->dataUser['errors']['password'] = 'The password is not valid';
                return $this->dataUser;
            }
        }

    }
    public function isEmailExist($email) :bool
    {
         if( $this->database::table('users')->where('email', $email)->first()) {
             $this->user = $this->database::table('users')->where('email', $email)->first();
             return true;
         }
         else {
             $this->dataUser['errors']['email'] = 'This email is not exist';
             return false;
         }
    }

    private function getDataToSession(object $user) {
        $session = [];
        $session['id'] = $user->id;
        $session['name'] = $user->name;
        $session['last_name'] = $user->last_name;
        $session['email'] = $user->email;
        return $session;
    }
}