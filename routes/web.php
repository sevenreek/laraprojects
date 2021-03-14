<?php

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Controllers\ProjectController;
use Illuminate\Http\Request;
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
    return redirect(RouteServiceProvider::HOME);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');;

// PROJECTS

Route::get('/project/{project_id}', 'ProjectController@display')->where('project_id', '[0-9]+')->middleware('auth');;

Route::get('/project/{project_id}/edit', 'ProjectController@edit')->where('project_id', '[0-9]+')->name('project_edit')->middleware('auth');;

Route::post('/project/{project_id}/edit', 'ProjectController@edit_finish')->where('project_id', '[0-9]+')->name('project_edit_finish')->middleware('auth');;

Route::get('/project/new', 'ProjectController@create')->middleware('auth');

Route::post('/project/new', 'ProjectController@store')->middleware('auth');

Route::get('/project/{project_id}/adduser', 'ProjectController@add_user')->where('project_id', '[0-9]+')->middleware('auth');

Route::post('/project/{project_id}/adduser', 'ProjectController@add_user_post')->where('project_id', '[0-9]+')->middleware('auth');

Route::post('/project/{project_id}/settask', 'ProjectController@set_task')->where('project_id', '[0-9]+')->middleware('auth');
Route::post('/project/{project_id}/addtask', 'ProjectController@add_task')->where('project_id', '[0-9]+')->middleware('auth');

Route::get('/switchlang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

// USERS

function getUserView($user_id)
{
    $users = DB::table('users')
        ->leftJoin('user_info', 'users.id', '=', 'user_info.user_id')
        ->where('users.id', '=', $user_id)
        ->select(
            'users.*',
            'user_info.bio'
        )
        ->get();
    $projects = DB::table('contributions')
        ->join('users', 'users.id', '=', 'contributions.contributor_id')
        ->where('users.id', '=', $user_id)
        ->join('access_levels', 'access_levels.id', '=', 'contributions.access_id')
        ->join('projects', 'projects.id', '=', 'contributions.project_id')
        ->select('projects.id AS id', 'projects.name AS project', 'access_levels.access AS access')
        ->get();
    return view('profile', [
        'user' => $users[0],
        'projects' => $projects
    ]);
}
Route::get('/user/{user_id}', function ($user_id) {
    return getUserView($user_id);
})->middleware('auth');;

Route::get(RouteServiceProvider::HOME, function () {
    if (Auth::check()) {
        return getUserView(Auth::id());
    } else {
        return redirect('login');
    }
});
Route::get('/users', function () {
    $users = DB::table('users')
        ->select('users.id AS id', 'users.name AS name')
        ->get();
    return view('users', [
        'users' => $users
    ]);
});
