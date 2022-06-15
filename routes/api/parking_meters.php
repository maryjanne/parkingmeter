<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::group(['namespace' => 'Spots', 'prefix' => 'parking_meters'], function () {
    Route::get('list', 'ParkingMeterController@listing')->name('parkingmeter.list');
});


