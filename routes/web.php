<?php

// Home Route

Route::get('/', function () {
    return view('welcome');
})->name('root');


// Admin Routes

Route::group(['namespace'=>'Admin'],function (){

    Route::get('admin/home','AdminHomeController@index')->name('admin.home');
    Route::resource('admin/admin','AdminController');
    Route::resource('admin/partner','PartnerController');
    Route::resource('admin/pms','UserController');
    Route::resource('admin/admin-project-assign','ProjectsAssignController');


    //admin Profile
    Route::get('admin/profile', 'AdminHomeController@profileEdit')->name('admin.profile');
    Route::post('admin/profile', 'AdminHomeController@profileUpdate');

    //admin Login
    Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin-login', 'Auth\LoginController@login');
    Route::get('admin-logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::post('admin-logout', 'Auth\LoginController@logout');
});

// partner Routes

Route::group(['namespace'=>'Partner'],function (){

    Route::get('partner/home','PartnerHomeController@index')->name('partner.home');
    Route::resource('partner/pm','UserController');

    Route::resource('partner/partner-project-assign','ProjectsAssignController');
    Route::post('partner/pm-project-assign','ProjectsAssignController@assign')->name('pm-project-assign.assign');

    //partner Profile
    Route::get('partner/profile', 'PartnerHomeController@profileEdit')->name('partner.profile');
    Route::post('partner/profile', 'PartnerHomeController@profileUpdate');

    Route::get('partner-login', 'Auth\LoginController@showLoginForm')->name('partner.login');
    Route::post('partner-login', 'Auth\LoginController@login');
    Route::get('partner-logout', 'Auth\LoginController@logout')->name('partner.logout');
    Route::post('partner-logout', 'Auth\LoginController@logout');
});


// PM Routes

Auth::routes();

Route::group(['namespace'=>'User'],function (){


    //user Profile
    Route::get('pm/profile', 'HomeController@profileEdit')->name('pm.profile');
    Route::post('pm/profile', 'HomeController@profileUpdate');

    //projects
    Route::resource('pm/projects', 'ProjectController');
    Route::post('pm/projects/star', 'ProjectController@star')->name('star');

    // project sub tasks
    Route::resource('pm/projects.pd', 'ProjectPdController');
    Route::resource('pm/projects.network-assessment', 'NetworkAssessmentController');
    Route::resource('pm/projects.admin-training', 'AdminTrainingController');
    Route::resource('pm/projects.back-end-build-out', 'BackEndBuildOutController');
    Route::resource('pm/projects.number-porting', 'NumberPortingController');
    Route::resource('pm/projects.onsite-delivery-go-live', 'OnsiteDeliveryGoLiveController');
    Route::resource('pm/projects.attachment', 'AttachmentController');
    Route::get('pm/projects/{project}/attachment/{attachment}', 'AttachmentController@download');
    Route::resource('pm/projects.note', 'NoteController');

    Route::get('cron-jobs/complete-project','CronJobsController@completeProject');

    Route::get('/home', 'HomeController@index')->name('home');

});