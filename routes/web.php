<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
//
//Route::get('/roles', function () {
////    $permission = Permission::create(['name' => 'view']);
////    $user = \App\User::find(2);
////      $user->assignRole('student');
////    dd($users);
////    $role = Role::find(2);
////    $permission = Permission::find(2);
////    $role->givePermissionTo($permission);
//});

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
Auth::routes();
Route::get('/logout','AuthController@logout')
    ->name('logout');
Route::get('lang/{lang}','LangController@changeLang')->name('language');



Route::middleware('auth')->group(function(){

    // Chỉ có role là admin mới có thể truy cập vào các route của group này
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/','DashboardController@dashboard')
            ->name('home');
        Route::get('/dashboard','DashboardController@dashboard')
            ->name('dash');
        Route::match(['get','post'],'/register','AuthController@register')
            ->name('register');
        //student
        Route::resource('students', 'StudentController');
        //Course
        Route::resource('courses', 'CourseController');
        //Subject
        Route::resource('subjects', 'SubjectController');
        //Result
        Route::resource('results','ResultController');
        //SendMail
        Route::resource('email','SendMailController');
        Route::get( '/students/{id}/subject', 'StudentController@subject')->where(['[0-9]+'])
            ->name('students.subject');
        Route::put( '/students', 'StudentController@index')
            ->name('students.filter');
        Route::get( '/account/faker', 'StudentController@dataFaker');
    });



        Route::get('/students/{student}','StudentController@show')->name('students.show');


});


