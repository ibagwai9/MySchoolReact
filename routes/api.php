<?php

use Illuminate\Http\Request;
// use App\Http\Controllers\Api\V1\ApiAuthController
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
        
        Route::post('upload-pic','StudentController@postPicture');//->middleware('api');
        Route::post('login', 'AdminController@login');
        Route::post('register', 'AdminController@register');//->middleware('auth:api');
          //Dashboard
        Route::post('user', 'AdminController@user')->middleware('auth:api');

        Route::group(['prefix'=>'admin'], function() {
            Route::get('news', function () {
                return 'Welcome';
            });
            // Route::get('login', function()
            // {
            //     return response()->json(['error'=>'Unauthorised','message'=>'login first'], 401);
            // })->name('login');
            Route::post('users','AdminController@users')->middleware('auth:api');
            Route::post('logout', 'AdminController@logout');
        
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
            Route::post('{student}', 'StudentController@getStudent');
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

        Route::group(['prefix'=>'guardian'], function() {
           
            // Route::post('login', 'GuardianController@login');
            // Route::get('login', function()
            // {
            //     return response()->json(['error'=>'Unauthorised','message'=>'login first'], 401);
            // })->name('login');

            Route::post('students','GuardianController@students')->middleware('auth:api');

            Route::get('school/{school}','GuardianController@getSchool');

            Route::post('logout', 'GuardianController@logout');
        
            //Dashboard
            Route::post('parent', 'GuardianController@parent')->middleware('auth:api');
            Route::get('child/{student}', 'GuardianController@getChild')->middleware('auth:api');
            Route::get('sessions-from/{session}', 'GuardianController@getSessions')
            ->middleware('auth:api');

        
        });
    });
});