<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\SubcategoryModel;

class Admin extends BaseController
{
    public function index() // Return main settings page
    {        
        $session = session();
        
        $cat_model = new CategoryModel();
        $subcat_model = new SubcategoryModel();
        $prod_model = new ProductModel();
        
        $dynamic_details = [
            'all_categories' => $cat_model -> findAll(),
            'all_subcategories' => $subcat_model->findAll(),
            'all_products' => $prod_model->findAll()           
        ];

        return view('admin/main_settings', $dynamic_details);
    }

    public function addUsers() 
    {       
        $session = session();

        if($this -> request -> getMethod() == 'post')
        {
            $model = new UserModel();
            $hashed_password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
            $data = [
                'email_address' => $_POST['reg_email'],
                'firstname' => $_POST['reg_firstname'],
                'lastname' => $_POST['reg_lastname'],
                'pass_word' => $hashed_password,
                'gender' => $_POST['reg_gender'],
                'role' => $_POST['reg_usertype']
            ];
            
            if($model -> addUser($data))
            {
                return $this->index();
            }
        }
        
        else
        {   
            return view('admin/add_users');
        }
    }
    
    public function editUsers()
    {      
        $session = session();
        
        if(isset($_POST['search_email']))
        {
            $model = new UserModel();
            $details = $model -> getUser($_POST['search_email']);
            
            if($details)
            {
                $dynamic_details['details'] = $details;
                return view('admin/edit_users', $dynamic_details);          
            }
            
            else
            {
                echo '<script>alert("Invalid Email")</script>';
                return $this->index();
            }
        }

        if(isset($_POST['save_edit']))
        {            
            $data = [
                'email_address' => $_POST['reg_email'],
                'firstname' => $_POST['reg_firstname'],
                'lastname' => $_POST['reg_lastname'],
                'gender' => $_POST['reg_gender'],
                'role' => $_POST['reg_usertype']
            ];
            
            $model = new UserModel();
            
            if($model->updateUser($_POST['reg_ID'], $data))
            {
                echo '<script>alert("User Updated")</script>';
                return $this->index();
            }
            
            else
            {
                echo '<script>alert("Update Failed")</script>';
                return $this->editUsers();
            }
        }
        
        else
        {
            return view('admin/edit_users');
        }
    }

    public function addCategory()
    {
        $session = session();
        
        if($this -> request -> getMethod() == 'post')
        {
            $model = new CategoryModel();
            $data = [
                'category_name' => $_POST['cat_name']
            ];
            
            if($model -> addCategory($data))
            {
                echo '<script>alert("Category Added")</script>';
                return $this->index();
            }

            else
            {
                echo '<script>alert("Category Addition Failed")</script>';
                return view('admin/add_category');
            }
        }
        
        else
        {   
            return view('admin/add_category');
        }

    }

    public function editCategory()
    {
        $session = session();
        
        if(isset($_POST['submit_cat_search']))
        {
            $cat_model = new CategoryModel();
            $details = $cat_model -> getCategory($_POST['cat_name']);
            
            if($details)
            {
                $dynamic_details['details'] = $details;
                return view('admin/edit_category', $dynamic_details);          
            }
            
            else
            {
                echo '<script>alert("Category Not Found)</script>';
                return $this->index();
            }
        }

        if(isset($_POST['cat_edit']))
        {            
            $data = [
                'category_name' => $_POST['cat_name']
            ];
            
            $cat_model = new CategoryModel();
            
            if($cat_model->update($_POST['cat_id'], $data))
            {
                echo '<script>alert("Category Updated")</script>';
                return $this->index();
            }
            
            else
            {
                echo '<script>alert("Update Failed")</script>';
                return $this->index();
            }
        }
        
        else
        {
            return view('admin/edit_category');
        }

        return view('admin/edit_category');
    }

    public function addSubcategory()
    {
        $session = session();
        
        $cat_model = new CategoryModel();
        $categories = $cat_model->findAll();
        $dynamic_details['categories'] = $categories;

        if($this -> request -> getMethod() == 'post')
        {
            $subcat_model = new SubcategoryModel();
            $data = [
                'subcategory_name' => $_POST['subcat_name'],
                'category_id' => $_POST['subcat_cat']
            ];
            
            if($subcat_model -> addSubcategory($data))
            {
                echo '<script>alert("Sub Category Added")</script>';
                return $this->index();
            }

            else
            {
                echo '<script>alert("Sub Category Addition Failed")</script>';
                return view('admin/add_subcategory', $dynamic_details);
            }
        }
        
        else
        {   
            return view('admin/add_subcategory', $dynamic_details);
        }
    }

    public function editSubcategory()
    {       
        $session = session();
        
        if(isset($_POST['submit_subcat_search']))
        {
            $subcat_model = new SubcategoryModel();
            $subcat_details = $subcat_model -> find($_POST['subcat_id']);

            $cat_model = new CategoryModel();
            $subcat_catname = $cat_model -> find($subcat_details['category_id']);
            $cat_details = $cat_model ->findAll();

            
            if($subcat_details && $cat_details)
            {
                $dynamic_details['subcat_details'] = $subcat_details;
                $dynamic_details['subcat_catname'] = $subcat_catname;
                $dynamic_details['cat_details'] = $cat_details;
                return view('admin/edit_subcategory', $dynamic_details);          
            }
            
            else
            {
                echo '<script>alert("Sub-category Not Found)</script>';
                return $this->index();
            }
        }

        if(isset($_POST['subcat_edit']))
        {            
            $data = [
                'subcategory_name' => $_POST['subcat_name'],
                'category_id' => $_POST['subcat_cat']
            ];
            
            $subcat_model = new SubcategoryModel();
            
            if($subcat_model->update($_POST['subcat_id'], $data))
            {
                echo '<script>alert("Sub-category Updated")</script>';
                return $this->index();
            }
            
            else
            {
                echo '<script>alert("Update Failed")</script>';
                return $this->index();
            }
        }
        
        else
        {
            return view('admin/edit_subcategory');
        }

        // return view('admin/edit_subcategory');
    }

    public function addProduct()
    {
        $session = session();
        
        $cat_model = new CategoryModel();
        $subcat_model = new SubcategoryModel();
        
        $dynamic_details = [
            'category_details' => $cat_model->findAll(),
            'subcategory_details' => $subcat_model->findAll()
        ];

        if($this -> request -> getMethod() == 'post')
        {
            $prod_model = new ProductModel();
            $prodimg_model = new ProductImageModel();

            $file = $this->request->getFile('prod_image');

            if($file->isValid() && !$file->hasMoved())
            {
                $file->move('./assets/uploaded_images', $_POST['prod_name'].'.'.$file->getExtension());
            }

            else
            {
                echo '<script>alert("Invalid File")</script>';
                return view('admin/add_product');
            }

            $prod_data = [
                'product_name' => $_POST['prod_name'],
                'product_description' => $_POST['prod_description'],
                'product_image' => $file->getName(),
                'unit_price' => $_POST['prod_price'],
                'available_quantity' => $_POST['prod_quantity'],
                'subcategory_id' => $_POST['prod_subcat'],
                'added_by' => $_POST['prod_added_by']
            ];
            
            if($prod_model->addProduct($prod_data))
            {
                $uploaded_product_details = $prod_model->getProduct($_POST['prod_name'], $_POST['prod_subcat']);
                $prodimg_data = [
                    'product_image' => $file->getName(),
                    'product_id' => $uploaded_product_details['product_id'],
                    'added_by' => $_POST['prod_added_by']
                ];
    
                if($prodimg_model->addProductImage($prodimg_data))
                {
                    echo '<script>alert("Product Added")</script>';
                    return $this->index();
                }
    
                else
                {
                    echo '<script>alert("Product Image Upload Failed")</script>';
                    return view('admin/add_subcategory');
                }              
            }

            else
            {
                echo '<script>alert("Product Addition Failed")</script>';
                return view('admin/add_subcategory');
            }

        }

        return view('admin/add_product', $dynamic_details);
    }

    public function editProduct()
    {
        $session = session();
        
        $cat_model = new CategoryModel();
        $subcat_model = new SubcategoryModel();
        $prod_model = new ProductModel();
        $prodimages_model = new ProductImageModel();
        
        $dynamic_details = [
            'all_categories' => $cat_model -> findAll(),
            'all_subcategories' => $subcat_model->findAll(),
            'all_products' => $prod_model->findAll()      
        ];

        if(isset($_POST['submit_prod_search']))
        {

            $product_details = $prod_model -> find($_POST['prod_id']);
            
            if($product_details)
            {
                $dynamic_details['product_details'] = $product_details;
                $dynamic_details['productimage_details'] = $prodimages_model -> getProductImage($product_details['product_image']);
                return view('admin/edit_product', $dynamic_details);          
            }
            
            else
            {
                echo '<script>alert("Product Not Found)</script>';
                return $this->index();
            }
        }

        if(isset($_POST['prod_edit']))
        {
            $file = $this->request->getFile('prod_image');

            if($file->isValid() && !$file->hasMoved())
            {
                $file->move('./assets/uploaded_images', $_POST['prod_name'].'.'.$file->getExtension());

                $prod_data = [
                    'product_name' => $_POST['prod_name'],
                    'product_description' => $_POST['prod_description'],
                    'product_image' => $file->getName(),
                    'unit_price' => $_POST['prod_price'],
                    'available_quantity' => $_POST['prod_quantity'],
                    'subcategory_id' => $_POST['prod_subcat'],
                    'added_by' => $_POST['prod_added_by']
                ];
                
                if($prod_model->updateProduct($_POST['prod_id'], $prod_data))
                {
                    $uploaded_product_details = $prod_model->find($_POST['prod_id']);
                    $prodimg_data = [
                        'product_image' => $file->getName(),
                        'product_id' => $uploaded_product_details['product_id'],
                        'added_by' => $_POST['prod_added_by']
                    ];
        
                    if($prodimages_model->updateProductImage($_POST['prodimage_id'], $prodimg_data))
                    {
                        echo '<script>alert("Product Edited")</script>';
                        return $this->index();
                    }
        
                    else
                    {
                        echo '<script>alert("Product Image Upload Failed")</script>';
                        return view('admin/edit_product');
                    }              
                }
    
                else
                {
                    echo '<script>alert("Product Edit Failed")</script>';
                    return view('admin/edit_product');
                }
            }

            else
            {
                $prod_data = [
                    'product_name' => $_POST['prod_name'],
                    'product_description' => $_POST['prod_description'],
                    'unit_price' => $_POST['prod_price'],
                    'available_quantity' => $_POST['prod_quantity'],
                    'subcategory_id' => $_POST['prod_subcat'],
                    'added_by' => $_POST['prod_added_by']
                ];
                
                if($prod_model->updateProduct($_POST['prod_id'], $prod_data))
                {
                    echo '<script>alert("Product Edited")</script>';
                    return $this->index();           
                }
        
                else
                {
                    echo '<script>alert("Product Edit Failed")</script>';
                    return view('admin/edit_product');
                }
            }

        }

        if($_POST['prod_delete'])
        {
            if($prod_model->delete($_POST['prod_id']))
            {
                if($prodimages_model->delete($_POST['prodimage_id']))
                {
                    echo '<script>alert("Product Deleted")</script>';
                    return $this->index(); 
                }

                else
                {
                    echo '<script>alert("Product Image Delete Failed")</script>';
                    return $this->index();
                }
            }

            else
            {
                echo '<script>alert("Product Delete Failed")</script>';
                return $this->index();
            }
        }

        return view('admin/edit_product', $dynamic_details);
    }
}
