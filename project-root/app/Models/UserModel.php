<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tbl_users';
    protected $primaryKey = 'userID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['email_address','firstname','lastname','pass_word','gender', 'role'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'post_created_at';
    // protected $updatedField  = 'post_updated_at';
    // protected $deletedField  = 'post_deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getUser($email)
    {
        return $this->asArray()
                    ->where(['email_address' => $email])
                    ->first();
    }

    public function addUser($user_data)
    {
        return $this->insert($user_data);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }
}