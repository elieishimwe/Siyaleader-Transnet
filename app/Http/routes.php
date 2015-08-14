<?php

use App\Province;
use App\District;
use App\Municipality;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('list-users', function () {
    return view('users.list');
});


/*
|--------------------------------------------------------------------------
| DEPARTMENTS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-departments', function () {
    return view('departments.list');
});

Route::get('departments-list', 'DepartmentController@index');
Route::get('departments/{id}', 'DepartmentController@edit');
Route::post('updateDepartment', 'DepartmentController@update');

/*
|--------------------------------------------------------------------------
| CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-categories/{department}', function ($department) {
    return view('categories.list',compact('department'));;
});


Route::get('categories-list/{id}', 'CategoriesController@index');


/*
|--------------------------------------------------------------------------
| SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-sub-categories/{category}', function ($category) {
    return view('subcategories.list',compact('category'));
});

Route::get('sub-categories-list/{id}', 'SubCategoriesController@index');




$router->resource('users','UserController');

Route::get('/api/dropdown/{to}/{from}', function($to,$from){
$name      = Input::get('option');

if ($from == 'province')
{
  $object = Province::where('slug','=',$name)->first();
}
if ($from == 'district')
{
  $object = District::where('slug','=',$name)->first();
}

if ($from == 'province')
{
  $listing = DB::table($to)->where($from,$object->id)->lists('name', 'slug');
}
else {
  $listing = DB::table($to)->where($from,$object->id)->lists('name', 'slug');
}

return $listing;
});

Route::get('add-user', function () {
    return view('users.registration');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('home', 'HomeController@index');
Route::get('users-list', 'UserController@index');



