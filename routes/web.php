<?php
Route::get('/', 'BookController@index');
Route::get('/edit', 'BookController@edit')->name('EditBook');
Route::post('/', 'BookController@create')->name('AddNewBook');
Route::post('/edit', 'BookController@update')->name('UpdateBook');
Route::get('/delete', 'BookController@destroy')->name('DeleteBook');
Route::post('/checkout', 'BookController@checkout')->name('CheckoutBook');
Route::get('/checkout', 'BookController@getcheckout')->name('GetCheckoutBook');