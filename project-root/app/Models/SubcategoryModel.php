<?php

namespace App\Models;

use CodeIgniter\Model;

class SubcategoryModel extends Model
{
    protected $table      = 'tbl_subcategories';
    protected $primaryKey = 'subcategory_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['category_id','subcategory_name'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'post_created_at';
    // protected $updatedField  = 'post_updated_at';
    // protected $deletedField  = 'post_deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getSubcategory($name)
    {
        return $this->asArray()
                    ->where(['subcategory_name' => $name])
                    ->first();
    }

    public function addSubcategory($data)
    {
        return $this->insert($data);
    }

    public function updateSubcategory($id, $data)
    {
        return $this->update($id, $data);
    }
}