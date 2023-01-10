<?php

namespace App\Controllers;

use App\Models\OrderDetailsModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Models\WalletModel;

class User extends BaseController
{
    public function login()
    {
        if($this -> request -> getMethod() == 'post')
        {
            // Get the user details using the submitted email
            $user_model = new UserModel();
            $wallet_model = new WalletModel();

            $details = ($user_model->where('email_address', $_POST['login_email'])->find())[0];

            $hashed_password = $details['pass_word'];

            if(isset($details) && password_verify($_POST['login_password'], $hashed_password)) // Authenticate user, then log them in
            {
                $session = session();
                $session_data = [
                    'firstname' => $details['firstname'],
                    'userID' => $details['userID'],
                ];
                
                $session->set($session_data);
                $wallet_details = $this->findWallet($details['userID']);
                $session->set('walletID', $wallet_details['wallet_id']);

                if($details['role'] == 1) // Regular user
                {
                    $dashboard = new Dashboard();
                    return $dashboard->viewProducts();
                }

                else // Admin
                {
                    $admin = new Admin();
                    return $admin->index();
                }
            }

            else
            {
                echo '<script>alert("Incorrect Password")</script>';
                return view('user/login');
            }
        }

        else // Showing the login page for the first time
        {
            return view('user/login');
        }
    }

    public function register()
    {
        if($this -> request -> getMethod() == 'post') // After submitting the register form, add their details to the db
        {
            $model = new UserModel();
            $hashed_password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
            $data = [
                'email_address' => $_POST['reg_email'],
                'firstname' => $_POST['reg_firstname'],
                'lastname' => $_POST['reg_lastname'],
                'pass_word' => $hashed_password,
                'gender' => $_POST['reg_gender'],
                'role' => 1
            ];

            $user_id = $model->insert($data, true);

            if($user_id)
            {
                $session = session();
                $session_data = 
                [
                    'firstname' => $_POST['reg_firstname'],
                    'userID' => $user_id,
                    'walletID' => ($this->findWallet($user_id))['wallet_id']
                ];

                $session->set($session_data);
                $dashboard = new Dashboard();
                return $dashboard->viewProducts();
            }
        }

        else // Showing the register page
        {   
            return view('user/register');
        }
    }

    public function editUser() // Retrieve their details using the user ID stored in the session, then update their DB data
    {
        $session = session();
        $user_model = new UserModel();

        $details = $user_model->find($session->get('userID')); //Get their details using their userID saved in the session

        if($this -> request -> getMethod() == 'post') // After submitting their details, save them to the db
        {
            $data = [
                'email_address' => $_POST['reg_email'],
                'firstname' => $_POST['reg_firstname'],
                'lastname' => $_POST['reg_lastname'],
                'gender' => $_POST['reg_gender']
            ];

            if($user_model->updateUser($session->get('userID'), $data))
            {
                $session->set('firstname', $_POST['reg_firstname']);
                echo '<script>alert("Profile Edited")</script>';

                if($details['role'] == 1) // Regular user
                {                   
                    $dashboard = new Dashboard();
                    return $dashboard->index();
                }

                else // Admin
                {
                    $admin = new Admin();
                    return $admin->index();
                }               
            }

            else
            {
                echo '<script>alert("Profile Edit Failed")</script>';
                return $this->editUser();
            }
        }

        else // Showing the edit_user page
        {
            $dynamic_details = [
                'details' => $details
            ];
    
            return view('user/edit_user', $dynamic_details);
        }
    }
    
    public function logout() // Destroy the session, then return them to the login page
    {
        $session = session();
        unset($_SESSION['firstname']);
        $session->destroy();

        $home = new Home();
        return $home->index();
    }

    public function viewCart() // Show the shopping cart page
    {
        $session = session();
        $wallet_model = new WalletModel();
        $dynamic_details = 
        [
            'wallet_details' => $wallet_model->getWallet($_SESSION['userID']),
            'total' => $this->findTotalCartCost()
        ];

        return view('user/view_cart', $dynamic_details);
    }
    
    public function addToCart() //Add the product sent through AJAX and its details from the db to $_SESSION['shopping_cart']
    {
        $session = session();

        $db = \Config\Database::connect();
        
        $builder = $db->table('tbl_categories');
        $builder->join('tbl_subcategories', 'tbl_categories.category_id = tbl_subcategories.category_id', 'inner');
        $builder->join('tbl_product', 'tbl_product.subcategory_id = tbl_subcategories.subcategory_id', 'inner');
        $builder->select('category_name, subcategory_name, product_name, unit_price, tbl_product.product_id');
        $builder->where('tbl_product.product_id', $_GET['cart_item_product_id']);

        $query = $builder->get();
        $result = $query->getResult('array');
        $result[0]['quantity'] = $_GET['cart_item_quantity'];
        $product_details = $result;

        if($session->has('shopping_cart'))
        {
            $session->push('shopping_cart', $product_details);
        }

        else
        {
            $session->set('shopping_cart', $product_details);
        }

        return json_encode(true);
    }

    public function deleteCartItem() // Delete the posted cart item from $_SESSION['shopping_cart']
    {
        $session = session();

        if(isset($_POST['cart_delete']))
        {
            unset($_SESSION['shopping_cart'][$_POST['cart_item_id']]);
        }

        else
        {
            unset($_SESSION['shopping_cart']);
        }

        return $this->viewCart();
    }

    public function viewWallet() // Provide wallet details to the user
    {
        $session = session();
        $user_id = $session->get('userID');

        $dynamic_details = 
        [
            'wallet_details' => $this->findWallet($user_id)
        ];

        return view('user/view_wallet', $dynamic_details);
    }

    public function findWallet($userID) // Find user's wallet details. If they don't have a wallet, it creates a new one for them
    {
        $wallet_model = new WalletModel();
        
        if($wallet_model->getWallet($userID)) // User already has a wallet, so retrieve it and return it to the view
        {
            $wallet_details = $wallet_model->getWallet($userID);
        }

        else // Create a new wallet for the user, then return it to the view
        {
            $new_wallet_details = 
            [
                'customer_id' => $userID,
                'amount_available' => 0
            ];

            $wallet_details = $wallet_model->find($wallet_model->insert($new_wallet_details, true)); // Get the added wallet to get its wallet id
        }

        return $wallet_details;
    }

    public function addMoneyToWallet() // Add money to the user's wallet in the db
    {
        $session = session();
        
        $wallet_model = new WalletModel();
        $wallet_details = $wallet_model->find($_SESSION['walletID']); // Use to get balance before adding.
        
        if($this -> request -> getMethod() == 'post')
        {
            $data = 
            [
                'amount_available' => ($_POST['wallet_add_amount'] + $wallet_details['amount_available']) // Add posted amount to the balance
            ];

            $wallet_model->update($_SESSION['walletID'], $data);

            $dynamic_details = 
            [
                'wallet_details' => $wallet_model->find($_SESSION['walletID'])
            ];

            return view('user/view_wallet', $dynamic_details);
        }
    }
    
    public function purchaseItems() // Perform db transactions when user purchases items, then load user/recent_purchase
    {
        $this->deductMoneyFromWallet();
        $this->createNewOrderDetails($this->createNewOrder());
        return $this->viewRecentPurchase();
    }

    public function deductMoneyFromWallet() // Deduct total cost of items from user's wallet
    {
        $session = session();
        
        // Deduct money from wallet
        $wallet_model = new WalletModel();
        $wallet_details = $wallet_model->find($_SESSION['walletID']);
        $new_wallet_details = 
        [
            'amount_available' => $wallet_details['amount_available'] - $this->findTotalCartCost()
        ]; 
        
        if($wallet_model->update($_SESSION['walletID'], $new_wallet_details))
        {
            return;
        }

        else
        {
            echo '<script>alert("Wallet Update Failed")</script>';
        }
    }

    public function createNewOrder() // Create a new order for the entire shopping cart
    {
        $session = session();
        
        $order_model = new OrderModel();
        $data = 
        [
            'customer_id' => $_SESSION['userID'],
            'order_amount' => $this->findTotalCartCost(),
            'order_status' => 'paid',
            'payment_type' => 1 // Default payment type is using the user's wallet
        ];

        $new_order_id = $order_model->insert($data, true);
        
        if($new_order_id)
        {
            return $new_order_id;
        }

        else
        {
            echo '<script>alert("Order Addition Failed")</script>';
        }
    }

    public function createNewOrderDetails($new_order_id) // Create new order details for every item in the shopping cart
    {
        $orderdetails_model = new OrderDetailsModel();
        $counter = 0;
        
        foreach($_SESSION['shopping_cart'] as $cart_key => $cart_val)
        {
            $data = 
            [
                'order_id' => $new_order_id,
                'product_id' => $cart_val['product_id'],
                'product_price' => $cart_val['unit_price'],
                'order_quantity' => $cart_val['quantity'],
                'orderdetails_total' => $cart_val['unit_price'] * $cart_val['quantity']
            ];

            $orderdetails_model->insert($data);
            $counter++;
        }

        if($counter == count($_SESSION['shopping_cart']))
        {
            echo '<script>alert("Purchase Successful")</script>';
        }

        else
        {
            echo '<script>alert("Order Details Addition Failed")</script>';
        }
    }
    
    public function findTotalCartCost() // Find total cost of all $_SESSION['shopping_cart'] items
    {
        $total = 0;
    
        if(isset($_SESSION['shopping_cart']))
        {
            foreach($_SESSION['shopping_cart'] as $cart_key => $cart_val)
            {
                $total += ($cart_val['unit_price'] * $cart_val['quantity']);
            }
        }
    
        return $total;
    }

    public function viewRecentPurchase() // Show the user details about the purchase they've just completed
    {
        $session = session();
        
        $dynamic_details = 
        [
            'total' => $this->findTotalCartCost()
        ];
        
        return view('user/purchase_receipt', $dynamic_details);
    }

    public function viewPurchaseHistory() // Show all purchases made by the user
    {
        $session = session();
        
        $db = \Config\Database::connect();

        // Get order ID's for all orders made, then store in an array
        $orders_builder = $db->table('tbl_order');
        $orders_builder->select('order_id');
        $orders_builder->where('customer_id', $_SESSION['userID']);
        $orders_query = $orders_builder->get();
        $orders = [];

        foreach ($orders_query->getResult('array') as $row => $val)
        {
            array_push($orders, $val['order_id']);
        }

        $rows = [];
        
        foreach($orders as $order_row => $order_val)
        {
            // Get all order details that correspond to one order ID
            $builder = $db->table('tbl_paymenttypes');
            $builder->join('tbl_order', 'tbl_paymenttypes.paymenttype_id = tbl_order.payment_type', 'inner');
            $builder->join('tbl_orderdetails', 'tbl_order.order_id = tbl_orderdetails.order_id', 'inner');
            $builder->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id', 'inner');
            $builder->join('tbl_subcategories', 'tbl_subcategories.subcategory_id = tbl_product.subcategory_id', 'inner');
            $builder->join('tbl_categories', 'tbl_categories.category_id = tbl_subcategories.category_id', 'inner');
            $builder->select('tbl_order.updated_at, tbl_order.order_id, category_name, subcategory_name, product_name, tbl_orderdetails.product_price, tbl_order.order_amount, order_quantity, orderdetails_total');
            $builder->where('tbl_orderdetails.order_id', $order_val);
            $query = $builder->get();
            
            $grouped_orders = [];

            foreach ($query->getResult('array') as $row => $val) // Store all orderdetails in one array
            {
                array_push($grouped_orders, $val);
            }

            $rows[$order_val] = $grouped_orders; // Final array -> key = order_id, value = an array containing individual order details as arrays
            unset($grouped_orders);
        }       

        $dynamic_details = 
        [
            'all_purchases' => array_reverse($rows) // Descending order
        ];

        return view('user/purchase_history', $dynamic_details);

        /* Sample array : 
        Array
        (
            [2] => Array
                (
                    [0] => Array
                        (
                            [updated_at] => 2022-01-26 05:35:53
                            [order_id] => 2
                            [category_name] => Men
                            [subcategory_name] => Casual
                            [product_name] => Shirt
                            [order_amount] => 2600
                            [product_price] => 450
                            [order_quantity] => 2
                            [paymenttype_name] => Wallet
                        )

                    [1] => Array
                        (
                            [updated_at] => 2022-01-26 05:35:53
                            [order_id] => 2
                            [category_name] => Men
                            [subcategory_name] => Casual
                            [product_name] => Sweater
                            [order_amount] => 2600
                            [product_price] => 500
                            [order_quantity] => 1
                            [paymenttype_name] => Wallet
                        )

                    [2] => Array
                        (
                            [updated_at] => 2022-01-26 05:35:53
                            [order_id] => 2
                            [category_name] => Women
                            [subcategory_name] => Casual
                            [product_name] => Dress
                            [order_amount] => 2600
                            [product_price] => 600
                            [order_quantity] => 2
                            [paymenttype_name] => Wallet
                        )

                )
        ) */
    }
}
