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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store']]);
Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store']]);

Route::get('/images/user-avatar/{user_id}/{img_size}/{img_quality}', 'ImagesController@User_Avatar');

Route::get('/show-all', 'TestyController@Show_All_Users');

Route::get('/huntingbook', 'HuntingBookController@create');
Route::get('/new_hunting_event', 'HuntingBookController@create_event');
Route::get('/Show_Users', 'HuntingBookController@Show_Users');
Route::get('/Check_Date', 'HuntingBookController@Check_Date');
Route::get('/show_huntings_list', 'HuntingBookController@show_huntings_list');
Route::get('/Confirm_Ending_Hunt/{hunt_id}/', 'HuntingBookController@Confirm_Ending_Hunt');
//Route::get('/add_hunted_animals/{hunt_id}/', 'HuntingBookController@add_hunted_animals');
Route::get('/add_hunted_animals/{hunt_id}/', 'HuntedAnimalsController@ReturnDB');

Route::get('/HuntedAnimalsAdd', 'HuntedAnimalsController@Add');
Route::get('/HuntedAnimalsDelete/{id}', 'HuntedAnimalsController@Delete');
Route::get('/HuntedAnimalsReturn', 'HuntedAnimalsController@Return');
Route::get('/HuntedAnimalsAddToDB', 'HuntedAnimalsController@AddToDB');
Route::get('/HuntedAnimalsShow/{hunt_id}/', 'HuntedAnimalsController@Show');
Route::get('/Shot_Alert', 'HuntedAnimalsController@Shot_Alert');
Route::get('/Tab_Alert', 'HuntedAnimalsController@Tab_Alert');


//Route::get('/animal_list', 'TestyController@Show_All_Animals');
Route::get('/animal_list', 'TestyController@Show_All_Animals');
Route::get('/animal_list_ajax', 'TestyController@Show_All_AnimalsAjax');
//Route::patch('/new_hunting_event', 'HuntingBookController', ['except' => ['index', 'create', 'store']]);
