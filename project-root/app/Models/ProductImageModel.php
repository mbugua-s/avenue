<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $table      = 'tbl_productimages';
    protected $primaryKey = 'productimages_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['product_image', 'product_id', 'added_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getProductImage($name)
    {
        return $this->asArray()
                    ->where(['product_image' => $name])
                    ->first();
    }

    public function addProductImage($data)
    {
        return $this->insert($data);
    }

    public function updateProductImage($id, $data)
    {
        return $this->update($id, $data);
    }
}