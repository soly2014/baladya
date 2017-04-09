<?php

// Home
 Route::post('/add_image_violation','SolyController@addImageViolation');
 Route::post('/add_voice_violation','SolyController@addVoiceViolation');
 Route::post('/add_video_violation','SolyController@addVideoViolation');


Route::get('user/login/{type}', 'HomeController@login')->name('login');
Route::get('/', 'HomeController@index')->name('home');

Route::post('login', 'Auth\LoginController@login');
//Route::get('dashboard', 'DashboardController@index');
Route::get('register', 'Auth\RegisterController@register');
Route::get('role', 'Auth\RegisterController@role');

Route::get('test',function (){
    dd(Route::getCurrentRoute()->getPath() );
});

Route::group(['prefix' => 'report'],function (){

    Route::get('viol-vs-days', 'reportController@violVsDays');
    Route::get('viol-vs-months', 'reportController@violVsMonths');
    Route::get('viol-vs-resquars', 'reportController@violVsResQuars');
    Route::get('viol-vs-services', 'reportController@violVsServices');
    Route::get('visit-vs-resquars', 'reportController@visitVsResQuar');
    Route::get('visit-vs-days', 'reportController@visitlVsDays');

});

Route::group(['middleware' => 'web'], function () {
	Route::group(['prefix' => 'admin'], function () {
            Route::group(['middleware' => 'webAuth'], function () {
                Route::get('/', 'DashboardController@index');
                //Route::get('/', 'AdminController@index');
                Route::resource('activity', 'ActivitiesController');
                Route::resource('healthenvtype', 'HealthEnvTypesController');
                Route::resource('contractor', 'ContractorsController');
                Route::resource('violationtype', 'ViolationTypesController');
                Route::resource('violation', 'ViolationsController');
                Route::resource('health_violation', 'HealthViolationsController');
                Route::get('/health_violation/create/{visit}','HealthViolationsController@create');
                Route::post('/health_violation/save','HealthViolationsController@saveHealthViolations');
                Route::post('/health_violation/save/notice','HealthViolationsController@saveNotice');

                Route::resource('street', 'StreetsController');
                Route::resource('facility', 'FacilitiesController');
                Route::resource('uservisit', 'UserVisitsController');
                Route::post('/uservisit/finish','UserVisitsController@finishVisit');

                Route::resource('service', 'ServicesController');
                Route::resource('res_quar', 'ResQuarsController');
                Route::resource('facility_status', 'FacilityStatusesController');
                Route::resource('users', 'UsersController');
                Route::resource('gardens', 'GardensController');
                Route::resource('companies', 'CompaniesController');

                Route::get('contractorres/{id}', 'ContractorsController@getContractorRes');


                //solution 
                Route::get('violation/{violation}/solution', 'ViolationsController@addSolution');
                Route::post('violation/{violation}/solution', 'ViolationsController@saveSolution');

                //change violation status
                Route::post('violation/change_status', 'ViolationsController@change_status');

                Route::post('violation/penalty', 'ViolationsController@addPenalty');
                
                Route::post('violation/custompenalty', 'ViolationsController@addCustomPenalty');

                Route::post('dayvisits', 'UserVisitsController@dayVisits');

                Route::get('violationtypes/{facility_id}', 'UserVisitsController@getViolationsTypes');


        });
    });

 Route::post('users/pass', 'UsersController@updatePassword');

    Route::get('auth/logout',function (){

        Sentinel::logout();
        return redirect()->to('/');
    });
});







/* START API */
Route::group(['prefix' => 'apis'], function () 
{


    Route::group(['prefix' => 'user'], function () 
    {
        Route::post('login', 'ApisController@login');
    });
    

    Route::group(['prefix' => 'violations'], function () 
    {
        Route::post('get_violations', 'ApisController@get_violations');
        Route::post('add_violation', 'ApisController@add_violation');
        Route::post('add_violation_images', 'ApisController@add_violation_images');
        Route::post('add_violation_solution', 'ApisController@add_violation_solution');
        Route::post('get_single_violation', 'ApisController@get_single_violation');
        
    });
    

    
    Route::group(['prefix' => 'streets'], function () 
    {
        Route::get('get_streets', 'ApisController@get_all_streets');
    });
    


    Route::group(['prefix' => 'squares'], function () 
    {
        Route::get('get_squares', 'ApisController@get_all_squares');
    });

    
    
    Route::group(['prefix' => 'violation_types'], function () 
    {
        Route::get('get_violation_types', 'ApisController@get_all_violation_types');
    });

    

    

});                  

/*  END API */






    /* START ADDING BY SOLY */
    Route::get('district/streets','SolyController@getStreets');
    /* END ADDING BY SOLY */