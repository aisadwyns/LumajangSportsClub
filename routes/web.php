<?php

use App\Models\Member;
use App\Models\Lapangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LscTeamController;
use App\Http\Controllers\LapanganController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/events', function () {
    return view('event');
});

//optional parameter
Route::get('/events/detail/{nama?}', function (?string $nama = null) {
    return "nama event : $nama";
});

Route::get('/test', function () {
    // return redirect()->to('/');
    return redirect()->away('https://github.com/aisadwyns');
});

Route::fallback(function () {
    return view('404');
});

Route::get('/coba_query', function () {
    //eloquent
    $member = Member::all();
    dd($member->toArray());
});

#######################################################################################
Route::resource('member', MemberController::class);
Route::resource('lapangan', LapanganController::class);
Route::resource('lscteam', LscTeamController::class);
