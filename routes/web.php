<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Frontend Route........................................
Route::get('/', 'HomeController@index');


//show product by id
Route::get('/view_product/{product_id}','HomeController@product_details_by_id');
Route::post('/add_to_cart','CartController@add_to_cart');
Route::get('/show_cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/update-cart','CartController@update_cart');

//Check out
Route::get('/login','CheckoutController@log_in');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/shipping','CheckoutController@shipping');
Route::post('/customer_login','CheckoutController@customer_login');
Route::get('/customer_logout','CheckoutController@customer_logout');

Route::get('/payment','CheckoutController@payment');
Route::post('/order_place','CheckoutController@order_place');
Route::get('/manage_order','CheckoutController@manage_order');
Route::get('/view_order/{order_id}','CheckoutController@view_order');
Route::get('/delete_order/{order_id}','CheckoutController@delete_order');


// Backend Route..........................................
Route::get('/dashboard','SuperAdminController@index');
Route::get('/admin','AdminController@index');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','SuperAdminController@logout');


Route::get('/categories','CategoriesController@index');
Route::get('/all-categories','CategoriesController@all_categories');
Route::post('/save-category','CategoriesController@save_categories');
Route::get('/edit_category/{id}','CategoriesController@edit_categories');
Route::post('/update_category/{id}','CategoriesController@update_categories');
Route::get('/delete_category/{id}','CategoriesController@delete_categories');
Route::get('/unactive_category/{id}','CategoriesController@unactive_categories');
Route::get('/active_category/{id}','CategoriesController@active_categories');

// brand Route
Route::get('/brand','BrandController@index');
Route::get('/all-brand','BrandController@all_brand');
Route::post('/save-brand','BrandController@save_brand');
Route::get('/edit_brand/{id}','BrandController@edit_brand');
Route::post('/update_brand/{id}','BrandController@update_brand');
Route::get('/delete_brand/{id}','BrandController@delete_brand');
Route::get('/unactive_brand/{id}','BrandController@unactive_brand');
Route::get('/active_brand/{id}','BrandController@active_brand');

//product route
Route::get('/product','ProductController@index');
Route::get('/all-product','ProductController@all_product');
Route::post('/save-product','ProductController@save_product');
Route::get('/unactive_product/{id}','ProductController@unactive_product');
Route::get('/active_product/{id}','ProductController@active_product');
Route::get('/delete_product/{id}','ProductController@delete_product');
Route::get('/edit_product/{id}','ProductController@edit_product');
Route::post('/update_product/{id}','ProductController@update_product');

//slide route
Route::get('/slide','SlideController@index');
Route::get('/all-slide','SlideController@all_slide');
Route::get('/save-slide','SlideController@save_slide');
Route::get('/unactive_slide','SlideController@unactive_slide');
Route::get('/active_slide','SlideController@active_slide');
Route::get('/delete','SlideController@delete_product');