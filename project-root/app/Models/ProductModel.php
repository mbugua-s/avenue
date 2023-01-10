<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'tbl_product';
    protected $primaryKey = 'product_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['product_name', 'product_description', 'product_image', 'unit_price', 'available_quantity', 'subcategory_id', 'added_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getProduct($name, $subcat_id)
    {
        return $this->asArray()
                    ->where(['product_name' => $name, 'subcategory_id' => $subcat_id])
                    ->first();
    }

    public function getProductWithName($name)
    {
        return $this->asArray()
                    ->where(['product_name' => $name])
                    ->first();
    }

    public function addProduct($data)
    {
        return $this->insert($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }
}