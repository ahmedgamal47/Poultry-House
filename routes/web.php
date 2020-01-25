<?php

Route::namespace('Auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');

        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    });


    Route::middleware('auth')->group(function () {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::middleware('role:' . \App\Enums\UserType::POULTRY_JAM)->group(function () {
            Route::get('register/success', 'RegisterController@registerSuccess')->name('register-success');
            Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

            Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
            Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
        });
    });
});

Route::namespace('Main')->group(function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('who-we-are', 'HomeController@whoWeAre')->name('who-we-are');
    Route::get('contact-us', 'HomeController@contactUs')->name('contact-us');
    Route::post('send-inquiry', 'HomeController@sendInquiry')->name('send-inquiry');
    Route::get('experts', 'HomeController@experts')->name('experts');
    Route::get('experts/article/{slug}', 'HomeController@article')->name('article');

    Route::middleware('auth', 'verified')->group(function () {
        Route::get('products', 'ProductController@getProducts')->name('products');
        Route::get('product/{id}', 'ProductController@getProduct')->name('product');

        Route::middleware('role:' . \App\Enums\UserType::COMPANY)->group(function () {
            Route::post('product/{id}/activate', 'ProductController@activate')->name('product.activate');
            Route::post('product/create', 'ProductController@createProduct')->name('product.create');
            Route::put('product/update/{id}', 'ProductController@updateProduct')->name('product.update');
        });

        Route::get('companies', 'CompanyController@getCompanies')->name('companies');
        Route::get('company/{id}', 'CompanyController@getCompany')->name('company');
        Route::middleware('role:' . \App\Enums\UserType::COMPANY)->group(function () {
            Route::get('company/account', 'CompanyController@account')->name('company.account');
            Route::post('company/account/update', 'CompanyController@updateInfo')->name('company.update-info');
            Route::post('company/account/video/create', 'CompanyController@createVideo')->name('company.video.create');
            Route::delete('company/account/video/delete/{id}', 'CompanyController@deleteVideo')->name('company.video.remove');

            Route::get('company/orders', 'OrderController@companyOrders')->name('company.orders');
        });

        Route::get('poultry-jams', 'PoultryJamController@getPoultryJams')->name('poultry-jams');
        Route::get('poultry-jam/{id}', 'PoultryJamController@getPoultryJam')->name('poultry-jam');
        Route::post('poultry-jam/send-inquiry', 'PoultryJamController@sendInquiry')->name('poultry-jam.send-inquiry');
        Route::middleware('role:' . \App\Enums\UserType::POULTRY_JAM)->group(function () {
            Route::get('poultry-jam/account', 'PoultryJamController@account')->name('poultry-jam.account');
            Route::post('poultry-jam/account/update', 'PoultryJamController@updateInfo')->name('poultry-jam.update-info');

            Route::post('order/create', 'OrderController@createOrder')->name('order.create');
            Route::get('poultry-jam/orders', 'OrderController@poultryJamOrders')->name('poultry-jam.orders');
        });
    });
});

Route::namespace('Dashboard')->prefix('admin')->name('admin.')->middleware('auth', 'role:' . \App\Enums\UserType::ADMINISTRATOR)->group(function () {
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('profile', 'DashboardController@profile')->name('profile');

    Route::get('configurations', 'ConfigurationController@getConfigurations')->name('config');
    Route::post('configurations', 'ConfigurationController@saveConfigurations');

    Route::resource('category', 'CategoryController');
    Route::post('category/activate/{category}', 'CategoryController@activate')->name('category.activate');

    Route::resource('company', 'CompanyController');
    Route::post('company/activate/{company}', 'CompanyController@activate')->name('company.activate');

    Route::resource('product', 'ProductController');
    Route::post('product/activate/{product}', 'ProductController@activate')->name('product.activate');

    Route::resource('poultry-jam', 'PoultryJamController');
    Route::post('poultry-jam/activate/{poultryJam}', 'PoultryJamController@activate')->name('poultry-jam.activate');

    Route::resource('order', 'OrderController');
    Route::post('order/{order}/process', 'OrderController@processOrder')->name('order.process');
    Route::post('order/{order}/finish', 'OrderController@finishOrder')->name('order.finish');
    Route::post('order/{order}/cancel', 'OrderController@cancelOrder')->name('order.cancel');

    Route::resource('post', 'BlogController');
    Route::post('post/activate/{post}', 'BlogController@activate')->name('post.activate');
});
