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



//USE THIS CHUNK for the multi-page Blade layout.
//Remember to switch the correct resources/views directory
/*
Route::get('/', function()
{
    return View::make('pages.home');
});
Route::get('about', function()
{
    return View::make('pages.about');
});
Route::get('projects', function()
{
    return View::make('pages.projects');
});
Route::get('contact', function()
{
    return View::make('pages.contact');
});
*/
//USE THIS CHUNK for the multi-page Blade layout ENDS
//Remember to switch the correct resources/views directory


//USE THIS CHUNK for the auth layout.
Route::get('/', 'HomeController@index');
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//USE THIS CHUNK for the auth layout.



Auth::routes();

//Route::get('/test', 'TestController@index');
Route::get('/test', array('middleware' => 'cors', 'uses' => 'TestController@index'));

//Route::view('/summernote','summernote');
Route::prefix('/documents')->group(function() {
  Route::get('/','DocumentController@read_many')->name('documentViewall');
  Route::post('/create','DocumentController@create_one')->name('documentPersist');
  Route::get('/new'  ,'DocumentController@new_one');
  Route::get('/show/{id}','DocumentController@show_one');
  Route::get('/view/{id}','DocumentController@view_one');
  Route::get('/edit/{id}','DocumentController@edit_one')->name('documentEdit');
  Route::post('/update','DocumentController@update_one')->name('documentUpdate');
  Route::get('/del/{id}','DocumentController@del_one');
});

Route::prefix('/notes/general')->group(function() {
  Route::get('/doc', 'Note_Base_Controller@get_read_many');
  Route::get('/note/{id}', 'Note_Base_Controller@read_one');
  Route::get('/{id}', 'Note_Base_Controller@read_many');
  Route::get('/new', 'Note_Base_Controller@new_one');
  Route::get('/del', 'Note_Base_Controller@delete_one');
  Route::post('/create', 'Note_Base_Controller@create_one');
  Route::post('/update', 'Note_Base_Controller@update_one');
});

Route::prefix('/candidates')->group(function() {
  Route::get('/', 'CandidatesController@read_many')->name('candidates');
  Route::get('/candidate/{id}', 'CandidatesController@read_one');
  Route::get('/new', 'CandidatesController@new_one');
  Route::get('/del', 'CandidatesController@delete_one');
  Route::post('/create', 'CandidatesController@create_one');
  Route::post('/update', 'CandidatesController@update_one');
});

Route::prefix('/jobs')->group(function() {
  Route::get('/', 'JobsController@read_many')->name('jobs');
  Route::get('/job/{id}', 'JobsController@read_one');
  Route::get('/new', 'JobsController@new_one');
  Route::get('/del', 'JobsController@delete_one');
  Route::post('/create', 'JobsController@create_one');
  Route::post('/update', 'JobsController@update_one');
});

Route::prefix('/recruiters')->group(function() {
  Route::get('/', 'RecruitersController@read_many')->name('recruiters');
  Route::get('/recruiter/{id}', 'RecruitersController@read_one');
  Route::get('/new', 'RecruitersController@new_one');
  Route::get('/del', 'RecruitersController@delete_one');
  Route::post('/create', 'RecruitersController@create_one');
  Route::post('/update', 'RecruitersController@update_one');
});

Route::prefix('console/fb')->group(function() {
  Route::get('/leads/read', 'FBConsoleController@read_leads');
  //Route::get('/dbtest', 'FBWebhookController@testdb');
});

Route::get('/console/fb', 'ConsoleFBController@index');
Route::get('/console/marketing-api', 'ConsoleFBController@marketingapi');
Route::get('/console/fb/logout', 'ConsoleFBController@log_out_of_fb');

Route::prefix('/resp_contact')->group(function() {
  Route::get('/', 'Resp_contactController@read');
  Route::get('/create', 'Resp_contactController@create');
  Route::get('/read', 'Resp_contactController@read');
  Route::get('/update', 'Resp_contactController@update');
  Route::get('/delete', 'Resp_contactController@delete');
});



Route::prefix('/resp_alliance')->group(function() {
  Route::get('/', 'Resp_allianceController@read');
  Route::get('/create', 'Resp_allianceController@create');
  Route::get('/read', 'Resp_allianceController@read');
  Route::get('/update', 'Resp_allianceController@update');
  Route::get('/delete', 'Resp_allianceController@delete');
});


Route::prefix('/resp_recruitment')->group(function() {
  Route::get('/', 'Resp_recruitmentController@read');
  Route::get('/create', 'Resp_recruitmentController@create');
  Route::get('/read', 'Resp_recruitmentController@read');
  Route::get('/update', 'Resp_recruitmentController@update');
  Route::get('/delete', 'Resp_recruitmentController@delete');
});


Route::prefix('/resp_sesrecruitment')->group(function() {
  Route::get('/', 'Resp_ses_recruitmentController@read');
  Route::get('/create', 'Resp_ses_recruitmentController@create');
  Route::get('/read', 'Resp_ses_recruitmentController@read');
  Route::get('/update', 'Resp_ses_recruitmentController@update');
  Route::get('/delete', 'Resp_ses_recruitmentController@delete');
});


Route::prefix('/resp_jobseeker')->group(function() {
  Route::get('/', 'Resp_jobseekerController@read');
  Route::get('/create', 'Resp_jobseekerController@create');
  Route::get('/read', 'Resp_jobseekerController@read');
  Route::get('/update', 'Resp_jobseekerController@update');
  Route::get('/delete', 'Resp_jobseekerController@delete');
});


Route::prefix('/resp_sesjobseeker')->group(function() {
  Route::get('/', 'Resp_ses_jobseekerController@read');
  Route::get('/create', 'Resp_ses_jobseekerController@create');
  Route::get('/read', 'Resp_ses_jobseekerController@read');
  Route::get('/update', 'Resp_ses_jobseekerController@update');
  Route::get('/delete', 'Resp_ses_jobseekerController@delete');
});


Route::prefix('/resp_catchall')->group(function() {
  Route::get('/', 'Resp_catchallController@read');
  Route::get('/create', 'Resp_catchallController@create');
  Route::get('/read', 'Resp_catchallController@read');
  Route::get('/update', 'Resp_catchallController@update');
  Route::get('/delete', 'Resp_catchallController@delete');
});

Route::get('/home', 'HomeController@index');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

  // Password reset routes
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});
