<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return 'Welcome';
});
Route::group(array('middleware'=>'api'), function() {
    
    Route::group(array('prefix'=>'v1'), function() {
        Route::get('news', function(){
                return 'Welcome to news';
        });
        Route::group(array('prefix'=>'page'), function() {

            Route::get('/image-gallery', 'PageController@gallery');
            Route::get('/news', 'PageController@news');
            Route::get('/show-news/{id}', 'PageController@showNews');
            Route::get('/about', 'PageController@about');
            Route::get('/contact', 'PageController@contact');
            Route::post('/email', 'PageController@email');

        });

        Route::group(['prefix'=>'admin'], function() {
            Route::get('news', function () {
                return 'Welcome';
            });
            Route::get('login', 'Api\AdminController@login');
            Route::post('user','AdminController@user');
            Route::post('login', 'AdminController@login');
            Route::get('register', 'AdminController@getRegister');
            Route::get('logout', 'AdminController@getLogout');
        
            //Dashboard
            Route::post('user', 'AdminController@user')->middleware('auth:api');
            Route::get('dashboard', 'AdminController@getDashboard');

        });

        Route::group(array('prefix'=>'teacher'), function() {

            Route::resource("/", 'TeacherController');
            Route::get('login', 'TeacherController@index');
            Route::post('login', 'TeacherController@postLogin');
            Route::get('register', 'TeacherController@getRegister');
            Route::post('register', 'TeacherController@postRegister');	
            Route::get('logout', 'TeacherController@getLogout');
            //Student main route
            Route::get('profile', 'TeacherController@getProfile');
            Route::get('payment', 'TeacherController@getPayment');
            Route::get('edit-profile/{teacher}', 'TeacherController@getEditProfile');
            Route::post('edit-profile', 'TeacherController@postEditProfile');
            //Students and result manager

            Route::get('result', 'TeacherController@resultIndex');
            Route::post('result', 'TeacherController@postResult');
            Route::get('result/{group}/{term}', 'TeacherController@getClassResult');
            Route::post('view-result-rdr', 'TeacherController@resultRdr');

            Route::post('result/{StudentClass}/{term}', 'TeacherController@postClassResult');

            Route::post('view-result', 'TeacherController@postViewResult');
            Route::post('create-result', 'TeacherController@postCreateResult');
            Route::post('save-results', 'TeacherController@postSaveTeacherResult');

        });

        Route::group(array('prefix'=>'student'), function() {

            Route::get('login', 'StudentController@getIndex');	
            Route::post('login', 'StudentController@postLogin');
            Route::get('register', 'StudentController@getRegister');
            Route::get('logout', 'StudentController@getLogout');
            //Student main route
            Route::get('profile', 'StudentController@getProfile');
            Route::get('payment', 'StudentController@getPayment');
            Route::get('view-result', 'StudentController@getViewResult');
            Route::get('edit-profile/{student}', 'StudentController@getEditProfile');
            Route::post('edit-profile', 'StudentController@postEditProfile');


            Route::post('register', 'StudentController@postRegister');
            Route::resource("/", 'StudentController', [
                'getProfile' => 'profile'
            ]);
        });
        Route::group(array('prefix'=>'guardian'), function() {

            Route::get("/", 'GuardianController@getProfile');
            Route::get('login', 'GuardianController@getIndex');
            Route::post('login', 'GuardianController@postLogin');
            Route::get('register', 'GuardianController@getRegister');	
            Route::post('register', 'GuardianController@postRegister');
            Route::get('logout', 'GuardianController@getLogout');
            //Activity route
            Route::get('profile', 'GuardianController@getProfile');
            Route::get('payment', 'GuardianController@getPayment');
            Route::get('edit-profile/{guardian}', 'GuardianController@getEditProfile');
            Route::get('view-result/{student}', 'GuardianController@getViewResult');
            Route::resource('childs', 'ChildsAccountController');
        });
    });
});