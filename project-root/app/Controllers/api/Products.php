<?php

namespace App\Controllers\api;

use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

class Products extends ResourceController
{
    protected $modelName = 'App\Models\ProductModel';
    protected $format    = 'json';

    public function index() // All products
    {
        return $this->respond($this->model->findAll());
    }

    public function getProductById(int $product_id) // Find product using its product id
    {
        $data = $this->model->find($product_id);

        if($data)
        {
            return $this->respond($data);
        }
        
        else
        {
            return $this->failNotFound('Product Not Found');
        }
    }

    public function getProductByName(string $product_name)
    {
        $data = $this->model->like('product_name', $product_name, 'both')
                            ->findAll();

        if($data)
        {
            return $this->respond($data);
        }
        
        else
        {
            return $this->failNotFound('Products with this name not found');
        }
    }

    public function getProductBySubcategory(int $subcategory_id) // Find products in a subcategory
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_product');
        $builder->join('tbl_subcategories', 'tbl_product.subcategory_id = tbl_subcategories.subcategory_id', 'inner');
        $builder->select('product_id, product_name, product_description, product_image, unit_price, available_quantity, tbl_subcategories.subcategory_name, added_by, created_at, updated_at');
        $builder->where('tbl_product.subcategory_id', $subcategory_id);

        $query = $builder->get();
        
        
        if($query->getResult('array'))
        {
            foreach ($query->getResult('array') as $row => $val)
            {
                $data[] = $val;
            }

            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Products in this subcategory do not exist');
        }
    }

    public function getProductByCategory(int $category_id) // Find products in a category
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_product');
        $builder->join('tbl_subcategories', 'tbl_product.subcategory_id = tbl_subcategories.subcategory_id', 'inner');
        $builder->join('tbl_categories', 'tbl_subcategories.category_id = tbl_categories.category_id', 'inner');
        $builder->select('product_id, product_name, product_description, product_image, unit_price, available_quantity, tbl_subcategories.subcategory_name, tbl_categories.category_name, added_by, created_at, updated_at');
        $builder->where('tbl_categories.category_id', $category_id);

        $query = $builder->get();
        
        
        if($query->getResult('array'))
        {
            foreach ($query->getResult('array') as $row => $val)
            {
                $data[] = $val;
            }

            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Products in this category do not exist');
        }
    }

    public function getProductByUser(int $user_id) // Find products added by a particular user
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_product');
        $builder->join('tbl_users', 'tbl_product.added_by = tbl_users.userID', 'inner');
        $builder->select('product_id, product_name, product_description, product_image, unit_price, available_quantity, tbl_users.firstname, tbl_users.lastname, added_by, created_at, updated_at');
        $builder->where('tbl_product.added_by', $user_id);

        $query = $builder->get();
        
        
        if($query->getResult('array'))
        {
            foreach ($query->getResult('array') as $row => $val)
            {
                $data[] = $val;
            }

            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Products added by this user do not exist');
        }
    }
}