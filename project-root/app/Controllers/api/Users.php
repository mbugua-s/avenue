<?php

namespace App\Controllers\api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

    public function index() // All users
    {
        return $this->respond($this->model->findAll());
    }

    public function getUserByID(int $id) // Find specific user using their userID
    {
        $user_model = new UserModel();
        $data = $user_model->find($id);

        if($data)
        {
            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('User does not exist');
        }
    }

    public function getUserByEmail(string $email) // Find specific user using their email address
    {
        $user_model = new UserModel();
        $data = $user_model->where('email_address', $email)->find();

        if($data)
        {
            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('User does not exist');
        }
    }

    public function getUserByGender(string $gender) // Find all users of a specific gender
    {
        $user_model = new UserModel();
        $data = $user_model->where('gender', $gender)->find();

        if($data)
        {
            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Users of that gender do not exist');
        }
    }

    public function getUserByLastPurchaseDate(string $date) // Find all users by last purchase date
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_order');
        $builder->join('tbl_users', 'tbl_order.customer_id = tbl_users.userID', 'inner');
        $builder->select('userID, email_address, firstname, lastname, pass_word, gender, role');
        $builder->like('tbl_order.created_at', $date, 'after');

        $query = $builder->get();
        
        foreach ($query->getResult('array') as $row => $val)
        {
            $data[] = $val;
        }

        if($data)
        {
            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Users that made a purchase on that date do not exist');
        }
    }

    public function getUserByPurchaseProduct(int $product_id, string $gender = null) // Find users that bought a particular product (optional gender filter)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_users');
        $builder->join('tbl_order', 'tbl_order.customer_id = tbl_users.userID', 'inner');
        $builder->join('tbl_orderdetails', 'tbl_order.order_id = tbl_orderdetails.order_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id', 'inner');
        $builder->select('userID, email_address, firstname, lastname, pass_word, gender, role');
        $builder->where('tbl_orderdetails.product_id', $product_id);

        if($gender)
        {
            $builder->where('tbl_users.gender', $gender);
        }

        $query = $builder->get();
        
        foreach ($query->getResult('array') as $row => $val)
        {
            $data[] = $val;
        }

        if($data)
        {
            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Users that bought this item do not exist');
        }
    }

    public function getUserByPurchaseCategory(int $category_id,string $gender = null) // Find users that bought a product in a particular category (optional gender filter)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_users');
        $builder->join('tbl_order', 'tbl_order.customer_id = tbl_users.userID', 'inner');
        $builder->join('tbl_orderdetails', 'tbl_order.order_id = tbl_orderdetails.order_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id', 'inner');
        $builder->join('tbl_subcategories', 'tbl_product.subcategory_id = tbl_subcategories.subcategory_id', 'inner');
        $builder->join('tbl_categories', 'tbl_subcategories.category_id = tbl_categories.category_id', 'inner');
        $builder->select('userID, email_address, firstname, lastname, pass_word, gender, role');
        $builder->where('tbl_categories.category_id', $category_id);
        
        if($gender)
        {
            $builder->where('tbl_users.gender', $gender);
        }

        $query = $builder->get();
        
        foreach ($query->getResult('array') as $row => $val)
        {
            $data[] = $val;
        }

        if($data)
        {
            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Users that bought an item in this subcategory do not exist');
        }
    }

    public function getUserByPurchaseSubcategory(int $subcategory_id, string $gender = null) // Find users that bought a product in a particular subcategory (optional gender filter)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_users');
        $builder->join('tbl_order', 'tbl_order.customer_id = tbl_users.userID', 'inner');
        $builder->join('tbl_orderdetails', 'tbl_order.order_id = tbl_orderdetails.order_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id', 'inner');
        $builder->join('tbl_subcategories', 'tbl_product.subcategory_id = tbl_subcategories.subcategory_id', 'inner');
        $builder->select('userID, email_address, firstname, lastname, pass_word, gender, role');
        $builder->where('tbl_product.subcategory_id', $subcategory_id);
        
        if($gender)
        {
            $builder->where('tbl_users.gender', $gender);
        }

        $query = $builder->get();
        
        foreach ($query->getResult('array') as $row => $val)
        {
            $data[] = $val;
        }

        if($data)
        {
            return $this->respond($data);
        }

        else
        {
            return $this->failNotFound('Users that bought an item in this subcategory do not exist');
        }
    }

    // ...
}