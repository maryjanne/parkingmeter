<?php
Route::group(['middleware' => ['throttle:60,1']], function () {
    Route::post('token', 'TokenController@login')->name('token');
});
