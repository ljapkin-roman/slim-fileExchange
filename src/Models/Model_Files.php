<?php

namespace Summit\Models;
use Summit\Core\Model;
use Summit\classes\File;


class Model_Files extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function do_record(array $post_data)
    {
          File::Create(['name' => $post_data['name'],
              'mime_type' => $post_data['mime_type'],
              'user_id' => $post_data['user_id'3] ]);
    }
}