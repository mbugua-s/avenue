<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->add('product/(:any)/(:any)', 'Shop::product/$1/$2');

/* $routes->group('admin', function($routes)
{
    $routes->add('user', 'Admin\Users::index');
    $routes->add('users', 'Admin\Users::getAllUsers');
    $routes->add('product/(:any)/(:any)', 'Admin\Shop::product/$1/$2');
}); */

// $routes->resource('api/users', ['only' => 'index']);

$routes->group('api', ['namespace' => 'App\Controllers\api'], function ($routes)
{
    $routes->group('users', function($routes)
    {
        $routes->get('', 'Users::index');
        $routes->get('id/(:num)', 'Users::getUserById/$1');
        $routes->get('email/(:segment)', 'Users::getUserByEmail/$1');
        $routes->get('gender/(:alpha)', 'Users::getUserByGender/$1');
        $routes->get('purchase_date/(:segment)', 'Users::getUserByLastPurchaseDate/$1');
        $routes->get('purchase_product/(:any)', 'Users::getUserByPurchaseProduct/$1/$2');
        $routes->get('purchase_subcategory/(:any)', 'Users::getUserByPurchaseSubcategory/$1/$2');
        $routes->get('purchase_category/(:any)', 'Users::getUserByPurchaseCategory/$1/$2');
    });
    
    $routes->group('products', function($routes)
    {
        $routes->get('', 'Products::index');
        $routes->get('id/(:num)', 'Products::getProductById/$1');
        $routes->get('name/(:segment)', 'Products::getProductByName/$1');
        $routes->get('subcategory/(:num)', 'Products::getProductBySubcategory/$1');
        $routes->get('category/(:num)', 'Products::getProductByCategory/$1');
        $routes->get('user/(:num)', 'Products::getProductByUser/$1');
    });

    $routes->group('transactions', function($routes)
    {
        $routes->get('', 'Transactions::index');
        $routes->get('date_range/(:segment)/(:segment)', 'Transactions::getTransactionByDateRange/$1/$2');
        $routes->get('category/(:num)', 'Transactions::getTransactionByCategory/$1');
        $routes->get('subcategory/(:num)', 'Transactions::getTransactionBySubcategory/$1');
        $routes->get('product/(:num)', 'Transactions::getTransactionByProduct/$1');
    });
});

//Blog routes

// $routes->add('blog', 'Admin\Blog::index');
// $routes->get('blog/new', 'Admin\Blog::createNew');
// $routes->post('blog/new', 'Admin\Blog::saveBlog');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
