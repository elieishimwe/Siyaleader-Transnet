<?php

use App\Province;
use App\District;
use App\Municipality;
use App\Department;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\CaseReport;

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
Route::get('getResponder', 'UserController@responder');

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
Route::post('escalateCase', 'CasesController@escalate');
Route::get('acceptCase/{id}', 'CasesController@acceptCase');
Route::post('addCaseForm', 'CasesController@captureCase');
Route::get('closeCase/{id}', 'CasesController@closeCase');
Route::post('requestCaseClosure', 'CasesController@requestCaseClosure');
Route::get('request-cases-closure-list', 'CasesController@requestCaseClosureList');
Route::get('resolved-cases-list', 'CasesController@resolvedCasesList');
Route::get('pending-referral-cases-list', 'CasesController@pendingReferralCasesList');




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
Route::get('getContacts', 'AddressBookController@show');

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


/*
|--------------------------------------------------------------------------
| RESPONDERS ROUTING
|--------------------------------------------------------------------------
|
*/
  Route::get('getsubSubResponders/{id}', 'RespondersController@subSubResponder');
  Route::post('addSubSubCategoryResponder', 'RespondersController@storeSubSubResponder');
  Route::get('getSubResponders/{id}', 'RespondersController@subResponder');
  Route::post('addSubCategoryResponder', 'RespondersController@storeSubResponder');
  Route::get('caseResponders-list/{id}', 'RespondersController@index');





/*
|--------------------------------------------------------------------------
| END RESPONDERS ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASE NOTES ROUTING
|--------------------------------------------------------------------------
|
*/
  Route::get('caseNotes-list/{id}', 'CaseNotesController@index');
  Route::post('addCaseNote', 'CaseNotesController@store');

/*
|--------------------------------------------------------------------------
| END CASE NOTES ROUTING
|--------------------------------------------------------------------------
|
*/


/*
|--------------------------------------------------------------------------
| CASE FILES ROUTING
|--------------------------------------------------------------------------
|
*/
  Route::get('caseNotes-list/{id}', 'CaseNotesController@index');
  Route::post('addCaseFile', 'CaseFilesController@store');
  Route::get('fileDescription/{id}/{name}', 'CaseFilesController@index');

/*
|--------------------------------------------------------------------------
| END CASE FILES ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| CASE ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/
  Route::get('caseActivities-list/{id}', 'CaseActivitiesController@index');

/*
|--------------------------------------------------------------------------
| END CASE ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/






/*
|--------------------------------------------------------------------------
| POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('list-positions', function () {
    return view('positions.list');
});

Route::get('positions-list', 'PositionsController@index');
Route::get('positions/{id}', 'PositionsController@edit');

Route::post('updatePosition', 'PositionsController@update');
Route::post('addPosition', 'PositionsController@store');


/*
|--------------------------------------------------------------------------
| END POSITIONS ROUTING
|--------------------------------------------------------------------------
|
*/





/*
|--------------------------------------------------------------------------
| MAP ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/
  Route::get('map', 'MapController@index');

/*
|--------------------------------------------------------------------------
| END MAP ACTIVITIES ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| CASE OWNERS ROUTING
|--------------------------------------------------------------------------
|
*/
  Route::get('caseOwner/{user}/{id}', 'CaseOwnerController@index');

/*
|--------------------------------------------------------------------------
| CASE OWNERS ROUTING
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
|  PASSWORD  ROUTING
|--------------------------------------------------------------------------
|
*/

  Route::get('resend_password/{id}', 'UserController@resendPassword');
  // Password reset link request routes...
  Route::get('password/email', 'Auth\PasswordController@getEmail');
  Route::post('password/email', 'Auth\PasswordController@postEmail');


  // Password reset routes...
  Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
  Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
|--------------------------------------------------------------------------
|  END PASSWORD  ROUTING
|--------------------------------------------------------------------------
|
*/



/*
|--------------------------------------------------------------------------
| REPORTS ROUTING
|--------------------------------------------------------------------------
|
*/

Route::get('reports', function () {
    return view('reports.list');
});

Route::get('reports-list', 'ReportsController@index');
Route::post('filterReports', 'ReportsController@show');



/*
|--------------------------------------------------------------------------
| END REPORTS ROUTING
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

Route::get('/api/dropdownCategory/{to}/{from}', function($to,$from){

$name      = Input::get('option');

if ($from == 'category')
{
  $object = Category::where('slug','=',$name)->first();
}
else{

 $object = SubCategory::where('slug','=',$name)->first();

}

if ($from == 'category')
{
  $listing = DB::table('sub-categories')
              ->where('category','=',$object->id)
              ->lists('name', 'slug');

}
else {

 $listing = DB::table('sub-sub-categories')
              ->where('sub_category','=',$object->id)
              ->lists('name', 'slug');
}

return $listing;
});




