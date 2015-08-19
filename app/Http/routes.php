<?php

use App\Province;
use App\District;
use App\Municipality;
use App\Department;
use App\Category;
use App\SubCategory;

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

/*
|--------------------------------------------------------------------------
| HOME ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('home', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| END HOME ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| USERS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-users', function () {
    return view('users.list');
});

Route::get('users-list', 'UserController@index');


/*
|--------------------------------------------------------------------------
| END USERS ROUTING
|--------------------------------------------------------------------------
|
*/



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
Route::post('addDepartment', 'DepartmentController@store');


/*
|--------------------------------------------------------------------------
| END DEPARTMENTS ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-categories/{department}', function ($department) {

    $deptObj = Department::find($department);
    return view('categories.list',compact('deptObj'));
});

Route::get('categories/{id}', 'CategoriesController@edit');
Route::get('categories-list/{id}', 'CategoriesController@index');

Route::post('updateCategory', 'CategoriesController@update');
Route::post('addCategory', 'CategoriesController@store');

/*
|--------------------------------------------------------------------------
| END CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/
Route::get('list-sub-categories/{category}', function ($category) {
    $catObj   = Category::find($category);
    $deptName = Department::find($catObj->department);
    return view('subcategories.list',compact('catObj','deptName'));
});

Route::get('subcategories/{id}', 'SubCategoriesController@edit');
Route::get('sub-categories-list/{id}', 'SubCategoriesController@index');
Route::post('updateSubCategory', 'SubCategoriesController@update');
Route::post('addSubCategory', 'SubCategoriesController@store');

/*
|--------------------------------------------------------------------------
| END SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| SUB-SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-sub-sub-categories/{sub_category}', function ($sub_category) {
    $subCatObj = SubCategory::find($sub_category);
    $catObj    = Category::find($subCatObj->category);
    $deptObj   = Department::find($catObj->department);
    return view('subsubcategories.list',compact('subCatObj','deptObj','catObj'));
});

Route::get('sub-sub-categories-list/{id}', 'SubSubCategoriesController@index');
Route::get('subsubcategories/{id}', 'SubSubCategoriesController@edit');
Route::post('addSubSubCategory', 'SubSubCategoriesController@store');
Route::post('updateSubSubCategory', 'SubSubCategoriesController@update');



/*
|--------------------------------------------------------------------------
| END SUB-SUB-CATEGORIES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASES ROUTING
|--------------------------------------------------------------------------
|
*/


Route::get('cases-list/{id}', 'CasesController@index');
Route::get('case/{id}', 'CasesController@edit');



/*
|--------------------------------------------------------------------------
| END CASES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| ADDRESSBOOK ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('addressbook-list/{id}', 'AddressBookController@index');
Route::post('addContact', 'AddressBookController@store');

/*
|--------------------------------------------------------------------------
| END ADDRESSBOOK ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| RELATIONSHIP ROUTING
|--------------------------------------------------------------------------
|
*/






/*
|--------------------------------------------------------------------------
| END RELATIONSHIP ROUTING
|--------------------------------------------------------------------------
|
*/

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





