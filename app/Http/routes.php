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

Route::get('/', function () {
    return view('users.list');
});

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

Route::get('users-list', 'UserController@index');

Route::get('add-user', function () {
    return view('registration');
});
