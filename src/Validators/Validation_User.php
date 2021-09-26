<?php

namespace Summit\Validators;

use Summit\Core\Model as Model;
use Summit\Config\Bootstrap as Bootstrap;

class Validation_User extends \Summit\Core\Validation
{
   public array $errorData = [];
   public object $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    private function validFirstName($first_name)
    {
        if (strlen($first_name) > 200) {
            $this->errorData['first_name'] = "Имя не может быть больше 200знаков!";
        }
    }

    private function validLastName($last_name)
    {
        if (strlen('last_name') > 200) {
            $this->errorData['first_name'] = "Фамилия не может быть больше 200знаков!";
        }
    }

    private function validEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorData['email'] = "Адресс почты не валиден!";
        }

        if (strlen($email) > 200) {
            $this->errorData['email'] = "Название почты имеет больше 200 знаков!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->errorData['email'] = "Почта не валидна";
        }

        $DB = Bootstrap::connect();
        $result = $DB::table('users')->where('email', $email)->first();

        if (!empty($result)) {
            $this->errorData['email'] = "Такой емайл уже существует.Выберите другой емайл";
        }
    }

    private function isPasswordCorrect($password, $repeatPassword)
    {
        $isEqual = strcmp($password, $repeatPassword);
        if ($isEqual !== 0) {
            $this->errorData['password'] = "Пароли должны совпадать";
        }
        if (strlen($password) < 4 )
        {
            $this->errorData['password'] = 'пароль не может быть меньше четырех символов';
        }
    }




    public function action_validate($user_data): array
    {
        $this->validFirstName($user_data['first_name']);
        $this->validLastName($user_data['last_name']);
        $this->validEmail($user_data['email']);
        $this->isPasswordCorrect($user_data['password'], $user_data['repeat_password']);
        $output['data'] = $user_data;
        $output['errors'] = $this->errorData;
        return $output;
    }
}