<?php

Route::get('/{path?}', function ($path = null) {
    return view('welcome');
})->where('path', '.*');

Route::get('/{path?}', function($path = null){ 

 return view('welcome');
});
Route::get('/{path}/{any?}', function () {
    return view('welcome');
});
Route::get('/{path?}/{any?}/{s?}/{a?}/', function () {
    return view('welcome');
});

//Route::get('/{path?}', function($path = null){ return View::make('app'); })->where('path', '.*');
/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*
Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

/*

/**
 * 

class Lion
{
    
    function cry()
    {
        return 'Groaning';
    }
    function run()
    {
        return 'Running';
    }
}

app()->bind('lion', function(){
    return new Lion;
});

/**
 * 
 
class LionFacade
{
    
    public static function __callStatic($name, $argument)
    {
        return app()->make('lion')->$name();
    }
}


dd(LionFacade::run());
 *

*




Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(array('prefix'=>'page'), function() {

    Route::get('/image-gallery', 'PageController@gallery');
    Route::get('/news', 'PageController@news');
    Route::get('/guardian/register', 'AdminController@getRegister');
    Route::get('/show-news/{id}', 'PageController@showNews');
    Route::get('/about', 'PageController@about');
    Route::get('/contact', 'PageController@contact');
    Route::post('/email', 'PageController@email');

});

Route::group(['prefix'=>'admin'], function() {
    Route::get('login', 'AdminController@getIndex');
    Route::post('login', 'AdminController@postLogin');
    Route::get('register', 'AdminController@getRegister');
    Route::get('logout', 'AdminController@getLogout');

    //Dashboard
    Route::get('dashboard', 'AdminController@getDashboard');
    Route::get('/', 'AdminController@getDashboard');

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

    Route::post('new-record', 'TeacherController@postNewRecord');
    Route::post('create-result', 'TeacherController@postCreateResult');
    Route::post('save-results', 'TeacherController@saveResult');

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
    Route::get('payment/{student}', 'GuardianController@getPayment');
    Route::get('edit-profile/{guardian}', 'GuardianController@getEditProfile');
    Route::post('edit-profile', 'GuardianController@postEditProfile');
    Route::get('view-result/{student}', 'GuardianController@getViewResult');
    Route::resource('childs', 'ChildsAccountController');

    Route::get('childs/{student}/{status?}', 'ChildsAccountController@show');
});
// Api copy halted here
Route::group(array('middleware'=>'admin_auth'), function() {

    Route::get('news/all', 'NewsController@all');
    Route::post('news/filtered', 'NewsController@filtered');
    Route::post('news/publish', 'NewsController@publish');

    Route::get('students/all', 'StudentAccountController@all');
    Route::post('students/filtered', 'StudentAccountController@filtered');

    Route::get('teachers/all', 'TeacherAccountController@all');
    Route::post('teachers/filtered', 'TeacherAccountController@filtered');

    Route::get('photo/all', 'GalleryController@all');
    Route::post('photo/filtered', 'GalleryController@filtered');

    Route::get('subjects/all', 'SubjectController@all');
    Route::post('subjects/filtered', 'SubjectController@filtered');

    Route::resource('news', 'NewsController');
    Route::resource('students', 'StudentAccountController');
    Route::resource('teachers', 'TeacherAccountController');
    Route::resource('subjects', 'SubjectController');
    Route::resource('photo', 'GalleryController');

    Route::resource('session', 'SessionController');
    Route::get('session', 'SessionController@getIndex');
    Route::post('session/create', 'SessionController@store'); 
    Route::post('session/update', 'SessionController@update'); 


});

Route::get('/forum/login', ['as' => 'forum_login', 'uses' => 'ForumController@getLogin']);
Route::get('/forum/logout', ['as' => 'forum_logout', 'uses' => 'ForumController@getLogout']);
Route::post('/forum/post_login', ['as' => 'post_forum_login', 'uses' => 'ForumController@postLogin']);
*/