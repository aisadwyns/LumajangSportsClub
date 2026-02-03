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
use App\Http\Controllers\BagianController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\UserController;
use App\Models\LscTeam;
use App\Models\Role;

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [ClientController::class, 'index'])->name('client');

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

//hapus seluruh data
// Route::get('/truncate', function () {
//     LscTeam::truncate();
// });
#######################################################################################
Route::resource('member', MemberController::class);
Route::resource('users', UserController::class)->middleware('isSuperadmin');
Route::post('users.update-role', [UserController::class,'updateRole'])->name('users.update-role');
Route::resource('lapangan', LapanganController::class);
Route::resource('lscteam', LscTeamController::class);
Route::resource('bagian', BagianController::class);


