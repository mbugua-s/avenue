<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Dashboard extends BaseController
{
    public function index() //Load the main dashboard page
    {
        $session = session();
        
        return view('user/dashboard');
    }
    
    public function getAllProducts() //Retrieve the necessary products for the initial viewProducts page load (w/ PHP) and subsequent loads (using JS and AJAX)
    {      
        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_categories');
        $builder->join('tbl_subcategories', 'tbl_categories.category_id = tbl_subcategories.category_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.subcategory_id = tbl_subcategories.subcategory_id', 'inner');
        $builder->join('tbl_productimages', 'tbl_productimages.product_id = tbl_product.product_id', 'inner');
        $builder->select('category_name, subcategory_name, product_name, tbl_product.product_image, unit_price, product_description, tbl_product.product_id');

        if(isset($_GET['filter_category']) && $_GET['filter_category'] != 'empty')
        {
            $builder->like('category_name', $_GET['filter_category'], 'after');
        }

        if(isset($_GET['filter_subcategory']) && $_GET['filter_subcategory'] != 'empty')
        {
            $builder->like('subcategory_name', $_GET['filter_subcategory'], 'after');
        }

        if(isset($_GET['filter_price']) && $_GET['filter_price'] != 'empty')
        {
            if($_GET['filter_price'] == "H2L")
            {
                $builder->orderBy('unit_price', 'DESC');
            }

            else
            {
                $builder->orderBy('unit_price', 'ASC');
            }
        }

        $query = $builder->get();
        
        foreach ($query->getResult('array') as $row => $val)
        {
            $rows[] = $val;
        }

        if(isset($rows))
        {
            $all_products = 
            [
                'all_details' => $rows // Instead of $all_products = $rows, because the first time the page is loaded, "all_details" is used in the PHP for loop
            ];
        }

        else // Returns null when no products match the criteria
        {
            return;
        }
       
        return $all_products;
    } 

    public function viewProducts() //Loads the all_products.php view with products, and the subcategories and categories data for the dropdowns
    {
        $session = session();
        $cat_model = new CategoryModel();

        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_subcategories');
        $builder->select('subcategory_name');
        $builder->distinct();

        $query = $builder->get();
        
        foreach ($query->getResult('array') as $row => $val)
        {
            $rows[] = $val;
        }
        
        $all_products = $this->getAllProducts();
        $all_products['all_subcategories'] = $rows;
        $all_products['all_categories'] = $cat_model->findColumn('category_name');

        return view('user/all_products', $all_products);
    }

    public function filterProducts() //JSON encode the filtered products. (Filters sent through AJAX and accessed by getAllProducts() using $_GET)
    {
        return json_encode($this->getAllProducts());
    }
}
