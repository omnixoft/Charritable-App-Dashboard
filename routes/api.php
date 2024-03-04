<?php

Route::get('command', function () {
    /* php artisan migrate */
    \Artisan::call('l5-swagger:generate');
    dd("Done");
});

// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'],  function () {



    // Users
    Route::apiResource('users', 'UsersApiController');

    // Notification
    Route::get('notification/{id}', 'NotificationApiController@index')->name("notification");

    // Team
    Route::post('teams/media', 'TeamApiController@storeMedia')->name('teams.storeMedia');
    Route::get('charities', 'TeamApiController@index')->name("charities");
    Route::get('charityById/{id}', 'TeamApiController@charityById')->name("charityById");

    // Donationtypes
    Route::get('donationTypes', 'DonationtypesApiController@index')->name("donationTypes");

    // Donation
    Route::post('donation', 'DonationApiController@create')->name("donation");
    Route::get('donationHistory/{id}', 'DonationApiController@index')->name("donationHistory");

    // Governorates
    Route::get('governorates', 'GovernoratesApiController@index')->name("governorates");

    // Wilayats
    Route::get('wilayats', 'WilayatsApiController@index')->name("wilayats");

    // Ayahts
    Route::get('randomAyahts', 'AyahtsApiController@index')->name("randomAyahts");

    // Social Solidarity
    Route::post('social-solidarities/media', 'SocialSolidarityApiController@storeMedia')->name('social-solidarities.storeMedia');
    Route::get('socialSolidarity', 'SocialSolidarityApiController@index')->name("socialSolidarity");
    Route::get('socialSolidarityById/{id}', 'SocialSolidarityApiController@socialSolidarityById')->name("socialSolidarityById");

    // Banners
    Route::post('banners/media', 'BannersApiController@storeMedia')->name('banners.storeMedia');
    Route::get('banners', 'BannersApiController@index')->name("banners");

    Route::get('appVersions', 'GovernoratesApiController@appVersions')->name("appVersions");

    // Feedback
    Route::post('feedback', 'FeedbackApiController@feedback')->name("feedback");

    // Thawnai setting toggle button 
    Route::get('thawaniPay/{id}', 'ThawaniSettingApiController@thawaniPay')->name('thawaniPay');

    Route::post('paymentUrl', 'ThawaniSettingApiController@paymentUrl')->name('paymentUrl');


    Route::apiResource('thawani-settings', 'ThawaniSettingApiController', ['except' => ['store', 'show', 'destroy']]);
    // Contact Us
    Route::apiResource('contactuses', 'ContactUsApiController');
    Route::get('faq', 'ContactUsApiController@faq')->name("faq");
    Route::get('contactDetail', 'ContactUsApiController@contactDetail')->name("contactDetail");
    // Customers
    Route::post('customers/media', 'CustomersApiController@storeMedia')->name('customers.storeMedia');
    Route::apiResource('customers', 'CustomersApiController');
    Route::post('signUp', 'CustomersApiController@signUp')->name("signUp");
    Route::post('login', 'CustomersApiController@login')->name("login");
    Route::post('updateToken', 'CustomersApiController@updateToken')->name("updateToken");
    Route::post('notificationToggle', 'CustomersApiController@notificationToggle')->name("notificationToggle");
    Route::post('updateProfile', 'CustomersApiController@updateProfile')->name("updateProfile");
});