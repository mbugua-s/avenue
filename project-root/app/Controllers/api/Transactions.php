<?php

namespace App\Controllers\api;

use App\Models\OrderModel;
use CodeIgniter\RESTful\ResourceController;

class Transactions extends ResourceController
{
    protected $modelName = 'App\Models\OrderModel';
    protected $format    = 'json';

    public function index() // All users
    {
        return $this->respond($this->model->findAll());
    }

    public function getTransactionByDateRange(string $date_start, string $date_end)
    {
        $data = $this->model->where('created_at > ', $date_start)
                            ->where('created_at < ', $date_end)
                            ->findAll();

        if($data)
        {
            return $this->respond($data);
        }
        
        else
        {
            return $this->failNotFound('Transactions in this time period not found');
        }
    }

    public function getTransactionByProduct(int $product_id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_order');
        $builder->join('tbl_orderdetails', 'tbl_order.order_id = tbl_orderdetails.order_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id', 'inner');
        $builder->select('tbl_order.order_id, orderdetails_id, customer_id, tbl_order.order_amount, order_status, payment_type, tbl_order.created_at, tbl_order.updated_at');
        $builder->where('tbl_orderdetails.product_id', $product_id);

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
            return $this->failNotFound('Transactions involving this product do not exist');
        }
    }

    public function getTransactionByCategory(int $category_id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_order');
        $builder->join('tbl_orderdetails', 'tbl_order.order_id = tbl_orderdetails.order_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id', 'inner');
        $builder->join('tbl_subcategories', 'tbl_subcategories.subcategory_id = tbl_product.subcategory_id', 'inner');
        $builder->join('tbl_categories', 'tbl_categories.category_id = tbl_subcategories.category_id', 'inner');
        $builder->select('tbl_order.order_id, tbl_product.product_id, orderdetails_id, customer_id, tbl_order.order_amount, order_status, payment_type, tbl_order.created_at, tbl_order.updated_at');
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
            return $this->failNotFound('Transactions involving this product category do not exist');
        }
    }
    
    public function getTransactionBySubcategory(int $subcategory_id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('tbl_order');
        $builder->join('tbl_orderdetails', 'tbl_order.order_id = tbl_orderdetails.order_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id', 'inner');
        $builder->join('tbl_subcategories', 'tbl_subcategories.subcategory_id = tbl_product.subcategory_id', 'inner');
        $builder->select('tbl_order.order_id, tbl_product.product_id, orderdetails_id, customer_id, tbl_order.order_amount, order_status, payment_type, tbl_order.created_at, tbl_order.updated_at');
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
            return $this->failNotFound('Transactions involving this product subcategory do not exist');
        }
    }
}