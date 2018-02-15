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

Route::get('/', function () {
    return view('welcome');
});

//route for backoffice
Route::group(['prefix' => 'admin-backoffice', 'namespace' => 'Backoffice'], function () {
    //login and logout
    Route::get('/', 'AuthController@index')->name('backoffice.login.form');
    Route::post('/', 'AuthController@login')->name('backoffice.login');
    Route::get('logout', 'AuthController@logout')->name('backoffice.logout');

    //route for backoffice
    Route::group(['middleware' => 'auth.backoffice'], function () {

        //dashboard
        Route::get('dashboard', 'DashboardController@index')->name('backoffice.dashboard');

        // User
        Route::get('user/detail/{id?}', 'UserController@detail')->name('backoffice.user.detail');

        // Training
        Route::get('trainings', 'TrainingController@index')->name('backoffice.trainings');

        // routing for admin
        Route::group(['middleware' => 'auth.admin'], function () {
            //User
            Route::get('users', 'UserController@index')->name('backoffice.users');
            // Certificate
            Route::get('certificates', 'CertificateController@index')->name('backoffice.certificates');
            // Grades
            Route::get('grades', 'GradeController@index')->name('backoffice.grades');
            // Positions
            Route::get('positions', 'PositionController@index')->name('backoffice.positions');
            // Units
            Route::get('units', 'UnitController@index')->name('backoffice.units');

        });

        // routing for super admin
        Route::group(['middleware' => 'auth.superadmin'], function () {

            // Certificate
            Route::get('certificate/form/{id?}', 'CertificateController@form')->name('backoffice.certificate.form');
            Route::post('certificate/store/{id?}', 'CertificateController@save')->name('backoffice.certificate.save');
            Route::delete('certificate/delete/{id?}', 'CertificateController@delete')->name('backoffice.certificate.delete');
            Route::get('certificate/export', 'CertificateController@export')->name('backoffice.certificate.export');

            //User
            Route::get('user/form/{id?}', 'UserController@form')->name('backoffice.user.form');
            Route::post('user/store/{id?}', 'UserController@save')->name('backoffice.user.save');
            Route::delete('user/delete/{id?}', 'UserController@delete')->name('backoffice.user.delete');
            Route::get('user/export', 'UserController@export')->name('backoffice.user.export');

            // Training
            Route::get('training/form/{id?}', 'TrainingController@form')->name('backoffice.training.form');
            Route::post('training/store/{id?}', 'TrainingController@save')->name('backoffice.training.save');
            Route::delete('training/delete/{id?}', 'TrainingController@delete')->name('backoffice.training.delete');
            Route::get('training/export', 'TrainingController@export')->name('backoffice.training.export');

            // Histories
            Route::get('histories', 'HistoryController@index')->name('backoffice.histories');

            // Grade
            Route::get('grade/form/{id?}', 'GradeController@form')->name('backoffice.grade.form');
            Route::post('grade/store/{id?}', 'GradeController@save')->name('backoffice.grade.save');
            Route::delete('grade/delete/{id?}', 'GradeController@delete')->name('backoffice.grade.delete');

            // Position
            Route::get('position/form/{id?}', 'PositionController@form')->name('backoffice.position.form');
            Route::post('position/store/{id?}', 'PositionController@save')->name('backoffice.position.save');
            Route::delete('position/delete/{id?}', 'PositionController@delete')->name('backoffice.position.delete');

            // Unit
            Route::get('unit/form/{id?}', 'UnitController@form')->name('backoffice.unit.form');
            Route::post('unit/store/{id?}', 'UnitController@save')->name('backoffice.unit.save');
            Route::delete('unit/delete/{id?}', 'UnitController@delete')->name('backoffice.unit.delete');
        });
    });
});
