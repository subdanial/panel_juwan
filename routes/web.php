<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/ok', function () {
return view('arman');
});


Route::get('/print', 'ProductController@print')->name('print');


Route::group(['prefix' => 'boxes' , 'middleware' => 'auth'], function () {
    Route::get('/box_value_count/{box_id}', 'BoxController@box_value_count')->name('boxes.box_value_count');
});

Route::group(['prefix' => 'marketers' , 'middleware' => 'auth'], function () {
    Route::get('/', 'MarketerController@index')->name('marketers.index');
    Route::get('/edit/{marketer}', 'MarketerController@edit')->name('marketers.edit');
    Route::post('/update', 'MarketerController@update')->name('marketers.update');
    Route::post('/store', 'MarketerController@store')->name('marketers.store');
    Route::get('/destroy', 'MarketerController@destroy')->name('marketers.destroy');
    Route::get('/table', 'MarketerController@table')->name('marketers.table');
});
Route::group(['prefix' => 'clients' , 'middleware' => 'auth'], function () {
    Route::get('/', 'ClientController@index')->name('clients.index');
    Route::get('/edit/{client}', 'ClientController@edit')->name('clients.edit');
    Route::post('/update', 'ClientController@update')->name('clients.update');
    Route::post('/store', 'ClientController@store')->name('clients.store');
    Route::get('/destroy', 'ClientController@destroy')->name('clients.destroy');
    Route::get('/table', 'ClientController@table')->name('clients.table');
    //api
    Route::get('/table_marketer', 'ClientController@table_marketer')->name('clients.table_marketer');
});
Route::group(['prefix' => 'categories' , 'middleware' => 'auth'], function () {
    Route::get('/table', 'CategoryController@table')->name('categories.table');
    Route::get('/', 'CategoryController@index')->name('categories.index');
    Route::get('/edit/{category}', 'CategoryController@edit')->name('categories.edit');
    Route::post('/update', 'CategoryController@update')->name('categories.update');
    Route::post('/store', 'CategoryController@store')->name('categories.store');
    Route::get('/destroy/{category}', 'CategoryController@destroy')->name('categories.destroy');
});
Route::group(['prefix' => 'products' , 'middleware' => 'auth'], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/table', 'ProductController@table')->name('products.table');
    Route::get('/create', 'ProductController@create')->name('products.create');
    Route::get('/edit/{product}', 'ProductController@edit')->name('products.edit');
    Route::get('/destroy/{product}', 'ProductController@destroy')->name('products.destroy');
    Route::post('/update/{product}', 'ProductController@update')->name('products.update');
    Route::post('/upload', 'ProductController@upload')->name('products.upload');
    Route::post('/store', 'ProductController@store')->name('products.store');

    // api routes
    Route::get('/select', 'ProductController@select')->name('products.select');
    Route::get('/table_order', 'ProductController@table_order')->name('products.table_order');
    Route::get('/code_exists_check', 'ProductController@code_exists_check')->name('products.code_exists_check');
    Route::get('/get_box_value', 'ProductController@get_box_value')->name('products.get_box_value');
});


Route::group(['prefix' => 'orders' , 'middleware' => 'auth'], function () {
    Route::get('/', 'OrderController@index')->name('orders.index');
    Route::get('/table', 'OrderController@table')->name('orders.table');
    Route::get('/show/{order}', 'OrderController@show')->name('orders.show');
    Route::get('/create', 'OrderController@create')->name('orders.create');
    Route::get('/edit/{order}', 'OrderController@edit')->name('orders.edit');
    Route::get('/destroy/{order}', 'OrderController@destroy')->name('orders.destroy');
    Route::post('/update', 'OrderController@update')->name('orders.update');
    Route::post('/upload', 'OrderController@upload')->name('orders.upload');
    Route::get('/store', 'OrderController@store')->name('orders.store');
    // api routes
    
    Route::get('/show_invoice/{order}', 'OrderController@show_invoice')->name('orders.show_invoice');
    Route::get('/show_pre_invoice/{order}', 'OrderController@show_pre_invoice')->name('orders.show_pre_invoice');
    Route::post('/fetch', 'OrderController@fetch')->name('orders.fetch');
    Route::post('/upload', 'OrderController@upload')->name('orders.upload');
    Route::get('/table_foroosh', 'OrderController@table_foroosh')->name('orders.table_foroosh');
    Route::get('/index_foroosh', 'OrderController@index_foroosh')->name('orders.index_foroosh');
    Route::get('/table_temporary', 'OrderController@table_temporary')->name('orders.table_temporary');
    Route::get('/index_temporary', 'OrderController@index_temporary')->name('orders.index_temporary');
    Route::get('/table_pre_invoice', 'OrderController@table_pre_invoice')->name('orders.table_pre_invoice');
    Route::get('/index_pre_invoice', 'OrderController@index_pre_invoice')->name('orders.index_pre_invoice');
    Route::get('/cart', 'OrderController@cart')->name('orders.cart');
    Route::get('/status_set_temporary', 'OrderController@status_set_temporary')->name('orders.status_set_temporary');
    Route::get('/status_set_cart/{order}', 'OrderController@status_set_cart')->name('orders.status_set_cart');
    Route::get('/item_delete/{item}', 'OrderController@item_delete')->name('orders.item_delete');
    Route::get('/convert_cart_to_buy_order', 'OrderController@convert_cart_to_buy_order')->name('orders.convert_cart_to_buy_order');
    Route::get('/convert_cart_to_pre_invoice', 'OrderController@convert_cart_to_pre_invoice')->name('orders.convert_cart_to_pre_invoice');
    Route::get('/convert_cart_to_returned_order', 'OrderController@convert_cart_to_returned_order')->name('orders.convert_cart_to_returned_order');
    Route::get('/convert_pre_invoice_to_cart/{order}', 'OrderController@convert_pre_invoice_to_cart')->name('orders.convert_pre_invoice_to_cart');
    Route::get('/destroy_pre_invoice/{order}', 'OrderController@destroy_pre_invoice')->name('orders.destroy_pre_invoice');


    //activation_statuses
    Route::get('/foroosh_accept_status/{order}', 'OrderController@foroosh_accept_status')->name('orders.foroosh_accept_status');
    Route::get('/maali_accept_status/{order}', 'OrderController@maali_accept_status')->name('orders.maali_accept_status');
    Route::get('/anbaar_accept_status/{order}', 'OrderController@anbaar_accept_status')->name('orders.anbaar_accept_status');
    
    //maali 
    Route::get('/destroy_order/{order}', 'OrderController@destroy_order')->name('orders.destroy_order');
    Route::get('/convert_order_to_pre_invoice/{order}', 'OrderController@convert_order_to_pre_invoice')->name('orders.convert_order_to_pre_invoice');
});

Route::group(['prefix' => 'items' , 'middleware' => 'auth'], function () {
    Route::get('/get_item_values', 'ItemController@get_item_values')->name('items.get_item_values');
    Route::get('/get_box', 'ItemController@get_box')->name('items.get_box');
    Route::get('/update_item', 'ItemController@update_item')->name('items.update_item');
});
