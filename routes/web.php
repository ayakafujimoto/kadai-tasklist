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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('tasks/create', 'TasksController@create')->name('tasks.create');

//MessagesController@indexを処理
Route::get('/', 'TasksController@index');


// create: 新規作成用のフォームページ
Route::get('tasks/create', 'TasksController@create')->name('tasks.create');



// CRUD
// タスクの個別詳細ページ表示
Route::get('tasks/{task}', 'TasksController@show')->name('tasks.show');
// タスクの新規登録を処理（新規登録画面を表示するためのものではありません）
Route::post('tasks', 'TasksController@store')->name('tasks.store');
// タスクの更新処理（編集画面を表示するためのものではありません）
Route::put('tasks/{task}', 'TasksController@update')->name('tasks.update');
// タスクを削除
Route::delete('tasks/{task}', 'TasksController@destroy')->name('tasks.destroy');


// index: showの補助ページ
Route::get('tasks', 'TasksController@index')->name('tasks.index');

// edit: 更新用のフォームページ
Route::get('tasks/{task}/edit', 'TasksController@edit')->name('tasks.edit');

Route::resource('tasks', 'TasksController');
