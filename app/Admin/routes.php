<?php


Route::get('all/showhide/{model?}/{id?}','App\Admin\Controllers\ShowHideController@Show')->name('admin_showhide');
Route::get('all/showhidecategory/{model?}/{id?}','App\Admin\Controllers\ShowHideController@Category')->name('admin_showhide_category');
Route::get('cacheclear', 'App\Admin\Controllers\ClearController@index')->name('cacheclear');
