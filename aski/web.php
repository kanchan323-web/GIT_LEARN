Route::any('/User','OCMSLoginController@user_table')->middleware('PageAccess:User');
Route::post('/insertuser','OCMSLoginController@new_user');
Route::get('/UserEdit/{id}','OCMSLoginController@edit_user')->middleware('PageAccess:User');

Route::get('/UserDelete/{id}','OCMSLoginController@delete_user')->middleware('PageAccess:User');

Route::post('/updateuser/{id}','OCMSLoginController@update_user');

