<?php

// Route::get('route-list', function () {
//     $exitCode = Artisan::call('route:list');
//     return Redirect::to('admin')->with('status', Artisan::output());
// });

Route::get('/', 'DashboardController@index')->name('admin.dashboard');

Route::get('{module}/settings', 'SettingsController@module')->name('admin.settings.module');
Route::post('{module}/settings', 'SettingsController@moduleUpdate')->name('admin.settings.module_save');
Route::post('articles/mass_update', 'ArticlesController@massUpdate')->name('admin.articles.mass_update');
Route::get('categories/position_reset', 'CategoriesController@positionReset')->name('admin.categories.position_reset'); // NEED to Formaction button //
Route::post('categories/position_update', 'CategoriesController@positionUpdate')->name('admin.categories.position_update'); // NEED to Formaction button //
Route::post('files/upload', 'FilesController@upload')->name('admin.files.upload');
Route::post('privileges/mass_update', 'PrivilegesController@massUpdate')->name('admin.privileges.mass_update');
Route::post('users/mass_update', 'UsersController@massUpdate')->name('admin.users.mass_update');

Route::name('admin.')->group(function () {
    Route::resource('articles', 'ArticlesController')->except(['show'])->names(['destroy' => 'articles.delete']);
    Route::resource('categories', 'CategoriesController')->except(['show'])->names(['destroy' => 'categories.delete']);
    Route::resource('files', 'FilesController')->names(['destroy' => 'files.delete']);
    Route::resource('notes', 'NotesController')->names(['destroy' => 'notes.delete']);
    Route::resource('privileges', 'PrivilegesController')->except(['show', 'destroy']);
    Route::resource('settings', 'SettingsController')->except(['show'])->names(['destroy' => 'settings.delete']);
    Route::resource('themes/templates', 'TemplatesController')->except(['create', 'show'])->names(['destroy' => 'templates.delete'])->middleware(['can:admin.themes']);
    Route::resource('themes', 'ThemesController')->only(['index'])->middleware(['can:admin.themes']);
    Route::resource('users', 'UsersController')->except(['show'])->names(['destroy' => 'users.delete']);
});
