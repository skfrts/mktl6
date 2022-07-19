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

Route::get('/', function () {
    $helloWorld = 'Hello World';

    return view('welcome', compact('helloWorld'));
});

Route::get('/products', function () {
    $products = \App\Product::All(); //select * from products

    return $products;
});

Route::get('/users', function () {
    
    $user = new \App\User();
    $user->name = 'Usuário Teste';
    $user->email = 'email@teste.com';
    $user->password = bcrypt('12345678');
    //$user = \App\User::find(4);
    //dd($user->store()->count());
    //return \App\User::paginate(10);
    return \App\User::all(); //all() = collection in json    

    $loja = \App\Store::find(1);
    return $loja->products->count();
});

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function()
{
    Route::prefix('stores')->group(function() 
    {
        Route::get('/', 'StoreController@index')->name('index');
        Route::get('/create', 'StoreController@create')->name('create');
        Route::post('/store', 'StoreController@store')->name('store');
        Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        Route::post('/update/{store}', 'StoreController@update')->name('update');
        Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
    });    
});
