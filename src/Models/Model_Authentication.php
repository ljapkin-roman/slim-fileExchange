<?php

namespace Summit\Models;
use Summit\Core\Model;
use Summit\classes\User;
use Summit\Validators\Validation_User as Valid_User;

class Model_Authentication extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function do_record(array $post_data)
    {
        User::Create(['name' => $post_data['first_name'],
                      'last_name' => $post_data['last_name'],
                      'email' => $post_data['email'],
                      'password' => password_hash($post_data['password'],PASSWORD_BCRYPT), ]);
    }

    public function validation(array $post_data)
    {
        $valid_user = new Valid_User();
        return $valid_user->action_validate($post_data);


    }
}