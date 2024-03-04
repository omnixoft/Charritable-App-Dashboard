<?php

Route::redirect('/', './login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
Route::get('contact_us', function () {
    return view('admin.contact_us');
});
Route::get('privacy', function () {
    return view('admin.privacy');
});
Route::get('success', function () {
    return '<img src="' . asset("success.png") . '" style="width:75%;display:block;margin:auto">';
});
Route::get('cancel', function () {
    return '<img src="' . asset("error.png") . '" style="width:75%;display:block;margin:auto">';
});
Route::get('/migrate', function () {
    \Artisan::call('migrate --seed');

    dd("migrated database");
});
Route::get('/storageLink', function () {
    \Artisan::call('storage:link');

    dd("storage linked");
});
Route::get('/clear', function () {
    \Artisan::call('optimize:clear');

    dd("Cleared");
});
Route::get('/noti', function () {
    $title = 'test';
    $body = 'Test by YDxMAK';
    $token = '';
    sendNotifiction($title, $body, $token);
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('latestDonation', 'HomeController@latestDonation')->name('latestDonation');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::post('teams/media', 'TeamController@storeMedia')->name('teams.storeMedia');
    Route::post('teams/ckmedia', 'TeamController@storeCKEditorImages')->name('teams.storeCKEditorImages');
    Route::post('teams/parse-csv-import', 'TeamController@parseCsvImport')->name('teams.parseCsvImport');
    Route::post('teams/process-csv-import', 'TeamController@processCsvImport')->name('teams.processCsvImport');
    Route::resource('teams', 'TeamController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::get('tasks/edit_record/{id}', 'TaskController@edit_record');
    Route::post('tasks/delete_record', 'TaskController@delete_record')->name('tasks.delete_record');
    Route::post('tasks/update_record', 'TaskController@update_record')->name('tasks.update_record');
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Ayahts
    Route::delete('ayahts/destroy', 'AyahtsController@massDestroy')->name('ayahts.massDestroy');
    Route::resource('ayahts', 'AyahtsController');
    // Donationtypes
    Route::delete('donationtypes/destroy', 'DonationtypesController@massDestroy')->name('donationtypes.massDestroy');
    Route::post('donationtypes/parse-csv-import', 'DonationtypesController@parseCsvImport')->name('donationtypes.parseCsvImport');
    Route::post('donationtypes/process-csv-import', 'DonationtypesController@processCsvImport')->name('donationtypes.processCsvImport');
    Route::resource('donationtypes', 'DonationtypesController');

    // Donation
    Route::delete('donations/destroy', 'DonationController@massDestroy')->name('donations.massDestroy');
    Route::post('donations/parse-csv-import', 'DonationController@parseCsvImport')->name('donations.parseCsvImport');
    Route::post('donations/process-csv-import', 'DonationController@processCsvImport')->name('donations.processCsvImport');
    Route::resource('donations', 'DonationController');

    // Governorates
    Route::delete('governorates/destroy', 'GovernoratesController@massDestroy')->name('governorates.massDestroy');
    Route::post('governorates/parse-csv-import', 'GovernoratesController@parseCsvImport')->name('governorates.parseCsvImport');
    Route::post('governorates/process-csv-import', 'GovernoratesController@processCsvImport')->name('governorates.processCsvImport');
    Route::resource('governorates', 'GovernoratesController');

    // Wilayats
    Route::delete('wilayats/destroy', 'WilayatsController@massDestroy')->name('wilayats.massDestroy');
    Route::post('wilayats/parse-csv-import', 'WilayatsController@parseCsvImport')->name('wilayats.parseCsvImport');
    Route::post('wilayats/process-csv-import', 'WilayatsController@processCsvImport')->name('wilayats.processCsvImport');

    Route::post('wilayats/update_record', 'WilayatsController@update_record')->name('wilayats.update_record');
    Route::get('wilayats/willayat_records/{will_id}', 'WilayatsController@willayat_records');

    Route::resource('wilayats', 'WilayatsController');
    // Social Solidarity
    Route::delete('social-solidarities/destroy', 'SocialSolidarityController@massDestroy')->name('social-solidarities.massDestroy');
    Route::post('social-solidarities/media', 'SocialSolidarityController@storeMedia')->name('social-solidarities.storeMedia');
    Route::post('social-solidarities/ckmedia', 'SocialSolidarityController@storeCKEditorImages')->name('social-solidarities.storeCKEditorImages');
    Route::post('social-solidarities/parse-csv-import', 'SocialSolidarityController@parseCsvImport')->name('social-solidarities.parseCsvImport');
    Route::post('social-solidarities/process-csv-import', 'SocialSolidarityController@processCsvImport')->name('social-solidarities.processCsvImport');
    Route::resource('social-solidarities', 'SocialSolidarityController');

    // Banners
    Route::delete('banners/destroy', 'BannersController@massDestroy')->name('banners.massDestroy');
    Route::post('banners/media', 'BannersController@storeMedia')->name('banners.storeMedia');
    Route::post('banners/ckmedia', 'BannersController@storeCKEditorImages')->name('banners.storeCKEditorImages');
    Route::resource('banners', 'BannersController');

    // Customers
    Route::delete('customers/destroy', 'CustomersController@massDestroy')->name('customers.massDestroy');
    Route::post('customers/update_status', 'CustomersController@update_status')->name('customers.update_status');
    Route::post('customers/media', 'CustomersController@storeMedia')->name('customers.storeMedia');
    Route::post('customers/ckmedia', 'CustomersController@storeCKEditorImages')->name('customers.storeCKEditorImages');
    Route::resource('customers', 'CustomersController');

    //Reports
    Route::get('report/donationReport', 'ReportController@donationReport')->name('report.donationReport');
    Route::get('report/donationRecord', 'ReportController@donationRecord')->name('report.donationRecord');
    Route::get('report/socialReport', 'ReportController@socialReport')->name('report.socialReport');
    Route::get('report/socialRecord', 'ReportController@socialRecord')->name('report.socialRecord');
    Route::resource('report', 'ReportController');


    //App Version Setting

    Route::post('app-version-settings/insert', 'Version_SettingController@insert')->name('app-version-settings.insert');
    Route::resource('app-version-settings', 'Version_SettingController', ['except' => ['create', 'store', 'show', 'destroy']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Contact Us
    Route::delete('contactuses/destroy', 'ContactUsController@massDestroy')->name('contactuses.massDestroy');
    Route::resource('contactuses', 'ContactUsController');

    // Thawani Setting
    Route::post('thawani-settings/insert', 'ThawaniSettingController@insert')->name('thawani-settings.insert');
    Route::resource('thawani-settings', 'ThawaniSettingController', ['except' => ['create', 'store', 'show', 'destroy']]);

    // Feedback
    Route::delete('feedback/destroy', 'FeedbackController@massDestroy')->name('feedback.massDestroy');
    Route::resource('feedback', 'FeedbackController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});