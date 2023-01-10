<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'tbl_categories';
    protected $primaryKey = 'category_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['category_name'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'post_created_at';
    // protected $updatedField  = 'post_updated_at';
    // protected $deletedField  = 'post_deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getCategory($name)
    {
        return $this->asArray()
                    ->where(['category_name' => $name])
                    ->first();
    }

    public function addCategory($data)
    {
        return $this->insert($data);
    }

    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }
}