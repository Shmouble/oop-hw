<?php

Route::get(
    '/',
    'IndexController@index'
)->name('index');

Route::delete(
    '/delete/{id}',
    'IndexController@delete'
)->name('index.delete');

Route::get(
    '/todo/{id}',
    'IndexController@get'
)->name('index.get')->middleware('auth.check');

Route::post(
    '/todo/{id}',
    'IndexController@update'
)->name('index.update');

// Для добавления
Route::put(
    '/todo',
    'IndexController@add'
)->name('index.add');

Route::get(
    '/categories/{category}/{id}',
    'CategoryController@get'
)->name('category.get')->middleware('auth.check')->middleware('user.check');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Для доступа в админку
Route::get(
    '/administration',
    'AdminController@get'
)->name('admin.get')->middleware('auth.check')->middleware('admin.check');

// Информация для редактирования пользователя
Route::get(
    '/user/{id}',
    'AdminController@user'
)->name('admin.user')->middleware('auth.check')->middleware('admin.check');

// Обновление данных пользователя
Route::post(
    '/user/{id}',
    'AdminController@update'
)->name('admin.update')->middleware('auth.check')->middleware('admin.check');

// Удаление пользователя
Route::delete(
    '/deleteuser/{id}',
    'AdminController@delete'
)->name('admin.delete')->middleware('auth.check')->middleware('admin.check');

// Доступ к архиву
Route::get(
    '/archive',
    'ArchiveController@get'
)->name('admin.get')->middleware('auth.check');

//Меняем язык
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

// Для доступа к менеджеру файлов
Route::get(
    '/filemanager',
    'FileManagerController@get'
)->name('filemanager.get');

// Для "путешествия" по папкам
Route::get(
    '/filemanager/{folderName}',
    'FileManagerController@getFolder'
)->name('filemanager.getFolder');

// Для "путешествия" по папкам
Route::get(
    '/filemanager/go/up',
    'FileManagerController@goUp'
)->name('filemanager.goUp');

// Для загрузки файла
Route::post(
    '/filemanager/upload/file',
    'FileManagerController@upload'
)->name('filemanager.upload');

// Для создания папки
Route::post(
    '/filemanager/createfolder/{newFolderName}',
    'FileManagerController@create'
)->name('filemanager.create');

// Для удаления файла
Route::post(
    '/filemanager/deletefile/{fileName}',
    'FileManagerController@delete'
)->name('filemanager.delete');
