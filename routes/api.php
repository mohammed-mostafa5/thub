<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('test', 'MainController@test');

// Authentication
// Route::post('forgotPassword', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');



//////////////////////////////////////////////////////////////////////////////
//////////////////////////////// Start Page //////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::get('pages/{id}', 'MainController@pages');
Route::get('informations', 'MainController@informations');
Route::get('metas', 'MainController@metas');
Route::get('blogs', 'MainController@blogs');
Route::get('blog/{id}', 'MainController@blog');
Route::get('services', 'MainController@services');
Route::get('faqs', 'MainController@faqs');
Route::get('vehicle-attributes', 'CompanyController@vehicle_attributes');
Route::get('models/{brand}', 'CompanyController@vehicle_model');
Route::get('colors', 'MainController@colors');
Route::get('categories', 'MainController@categories');
Route::post('send-contact', 'MainController@send_contact_message');
Route::post('newsletter', 'MainController@newsletter');
Route::get('landing-page', 'MainController@landing_page');

// Auth
Route::post('customer/login', 'AuthController@login_or_register_customer');
Route::post('customer/verify-code', 'AuthController@verify_code_customer');

Route::post('driver/login', 'AuthController@login_or_register_driver');
Route::post('driver/verify-code', 'AuthController@verify_code_driver');

Route::post('company/login', 'AuthController@login_or_register_company');
Route::post('company/verify-code', 'AuthController@verify_code_company');

Route::get('driver-rates/{driverId}', 'DriverController@rates');
Route::get('driver-rate/{driverRate}', 'DriverController@rate');
Route::get('customer-rates/{customerId}', 'CustomerController@rates');
Route::get('customer-rate/{customerRate}', 'CustomerController@rate');

Route::get('cancel-trip-reasons', 'MainController@cancelTripReasons');
Route::get('cancel-request-reasons', 'MainController@cancelRequestReasons');

//////////////////////////////////////////////////////////////////////////////
///////////////////////////////// End Page ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth:api.customer']], function () {

    Route::post('logout', 'CustomerController@logout')->name('users.logout');

    Route::post('update-customer-information', 'CustomerController@update_information');

    Route::get('customer-trips', 'CustomerController@trips');
    Route::get('customer-wallet', 'CustomerController@wallet');


    // Cap Service
    Route::post('find-captain', 'CustomerController@find_captain');
    Route::post('cancel-find-captain/{id}', 'CustomerController@cancel_find_captian');

    Route::post('cancel-trip/{trip}', 'CustomerController@cancel_trip');
    Route::post('change_location_trip/{id}', 'CustomerController@change_location_trip');
    // Cap Service

    // Towing Truck Service
    Route::post('towing-find-truck', 'CustomerController@towing_find_truck');
    Route::post('towing-cancel-find-truck/{seek}', 'CustomerController@towing_cancel_find_truck');

    Route::post('towing-cancel-trip/{trip}', 'CustomerController@towing_cancel_trip');
    Route::post('towing-change_trip_location/{trip}', 'CustomerController@towing_change_trip_location');
    // Towing Truck Service
    Route::get('customer-notifications', 'CustomerController@notifications');
    Route::get('customer-notifications/{notification}', 'CustomerController@notification');

    Route::get('customer-rewards', 'CustomerController@rewards');
    Route::get('customer-rewards/{reward}', 'CustomerController@reward');


    Route::post('customer-add-or-update-rate', 'CustomerController@addOrUpdateRate');
});

//////////////////////////////////////////////////////////////////////////////
/////////////////////////////// End Customer /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////
////////////////////////////// Start Company /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth:api.company']], function () {

    Route::post('update-company-information', 'CompanyController@update_information');

    Route::get('drivers', 'CompanyController@drivers');
    Route::get('driver/{id}', 'CompanyController@driver');
    Route::post('driver/store', 'CompanyController@driver_store');
    Route::post('driver/update/{id}', 'CompanyController@driver_update');
    Route::post('driver/delete/{id}', 'CompanyController@driver_delete');


    Route::get('vehicles', 'CompanyController@vehicles');
    Route::get('vehicle/{id}', 'CompanyController@vehicle');
    Route::post('vehicle/store', 'CompanyController@vehicle_store');
    Route::post('vehicle/update/{id}', 'CompanyController@vehicle_update');
    Route::post('vehicle/delete/{id}', 'CompanyController@vehicle_delete');

    Route::group(['middleware' => ['customeAuthProcess:company']], function () {

        Route::get('company-wallet', 'CompanyController@wallet');
        Route::get('company-revenue', 'CompanyController@revenue');

        Route::get('company/trips', 'CompanyController@trips');
        Route::get('company/trips-by-driver/{id}', 'CompanyController@trips_by_driver');
        Route::get('company/trips-by-vehicle/{id}', 'CompanyController@trips_by_vehicle');
    });
});

//////////////////////////////////////////////////////////////////////////////
/////////////////////////////// End Company //////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////
////////////////////////////// Start Driver //////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth:api.driver']], function () {

    Route::post('driver-update-information', 'DriverController@update_information');

    Route::post('bank-account-store', 'DriverController@bank_account_store');
    Route::get('bank-account', 'DriverController@bank_account');

    Route::get('driver-vehicle', 'DriverController@vehicle');
    Route::post('driver-vehicle-store', 'DriverController@vehicle_store');
    Route::post('driver-vehicle-update/{id}', 'DriverController@vehicle_update');

    Route::group(['middleware' => ['customeAuthProcess:driver']], function () {

        Route::get('driver-wallet', 'DriverController@wallet');
        Route::get('driver-revenue', 'DriverController@revenue');
        Route::get('driver-trips', 'DriverController@trips');

        // Cap Service
        Route::post('driver-online', 'DriverController@online');
        Route::post('driver-offline', 'DriverController@offline');
        Route::post('confirm-request/{id}', 'DriverController@confirm_request');
        Route::post('reject-request/{id}', 'DriverController@reject_request');
        Route::post('start-trip/{id}', 'DriverController@start_trip');
        Route::post('end-trip/{id}', 'DriverController@end_trip');
        // Cap Service

        // Towing Truck Service
        Route::post('towing-driver-online', 'DriverController@towing_online');
        Route::post('towing-update-my-location', 'DriverController@towing_update_my_location');
        Route::post('towing-confirm-request/{seek}', 'DriverController@towing_confirm_request');
        Route::post('towing-reject-request/{seek}', 'DriverController@towing_reject_request');
        Route::post('towing-start-trip/{seek}', 'DriverController@towing_start_trip');
        Route::post('towing-end-trip/{trip}', 'DriverController@towing_end_trip');
        // Towing Truck Service

        Route::get('driver-notifications', 'DriverController@notifications');
        Route::get('driver-notifications/{notification}', 'DriverController@notification');
        Route::post('driver-update-location', 'DriverController@update_my_location');

        Route::get('driver-rewards', 'DriverController@rewards');
        Route::get('driver-rewards/{reward}', 'DriverController@reward');


        Route::post('driver-add-or-update-rate', 'DriverController@addOrUpdateRate');
    });
});

//////////////////////////////////////////////////////////////////////////////
/////////////////////////////// End Driver ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
