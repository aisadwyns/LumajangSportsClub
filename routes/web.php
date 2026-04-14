<?php

use App\Models\Member;
use App\Models\Lapangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LscTeamController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\JenisKomunitasController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VenueController;

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\JoinKomunitasController;
use App\Http\Controllers\Client\RiwayatController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Models\LscTeam;
use App\Models\Role;

use App\Http\Controllers\Venue\AdminVenueController;


Route::get('/login', function () {
    return view('auth.login');
});

// Auth::routes();
Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [ClientController::class, 'index'])->name('client');
Route::get('/blogs', [ClientController::class, 'publicBlogIndex'])->name('blogs.public');
Route::get('/blogs/{slug}', [ClientController::class, 'publicBlogShow'])->name('blog.show');
Route::get('/events', [ClientController::class, 'publicEventIndex'])->name('events.public');
Route::get('/gabung-komunitas', [ClientController::class, 'publicKomunitasIndex'])->name('komunitas.public');
Route::get('/gabung-komunitas/{id}', [ClientController::class, 'publicKomunitasShow'])->name('client.komunitas.show');

Route::middleware(['auth','preventBackHistory'])->group(function () {
    Route::post('/komunitas/{id}/join-bayar-sekarang', [JoinKomunitasController::class, 'joinbayarsekarang'])->name('komunitas.joinbayarsekarang');
    Route::post('/komunitas/{id}/join', [JoinKomunitasController::class, 'join'])->name('komunitas.join');
    Route::post('/komunitas/{id}/leave', [JoinKomunitasController::class, 'leave'])->name('komunitas.leave');
    Route::resource('profil', ProfileController::class)->only(['edit', 'update']);
    Route::put('profil/password', [ProfileController::class, 'updatePassword']) ->name('profil.password');

    Route::get('/dashboard/riwayat-komunitas', [RiwayatController::class, 'index'])->name('riwayat.komunitas');
    Route::get('/dashboard/profile', [ProfileController::class, 'edit'])->name('profil.index');
});
Route::get('/leaderboard', [ClientController::class, 'publicLeaderboard'])->name('leaderboard.public');
// Route::post('/komunitas/{id}/join', [JoinKomunitasController::class, 'join'])->name('komunitas.join')->middleware('auth');
// Route::post('/komunitas/{id}/leave', [JoinKomunitasController::class, 'leave'])->name('komunitas.leave')->middleware('auth');
// Route::post('/komunitas/{id}/join-bayar-sekarang', [JoinKomunitasController::class, 'joinbayarsekarang'])->name('komunitas.joinBayarSekarang');

// Route::get('/events', function () {
//     return view('event');
// });

// //optional parameter
// Route::get('/events/detail/{nama?}', function (?string $nama = null) {
//     return "nama event : $nama";
// });

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
//route super admin
Route::middleware('auth')->group(function () {
    Route::get('/venue/register', [AdminVenueController::class, 'create'])->name('venue.create');
    Route::post('/venue/register', [AdminVenueController::class, 'store'])->name('venue.store');
});

#######################################################################################
//routes superadmin
Route::middleware([ 'auth', 'preventBackHistory'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']) ->middleware('verified')->name('home');
    // Route khusus Superadmin saja
    Route::middleware(['isSuperadmin'])->group(function () {
    Route::resource('member', MemberController::class);
    //Route::resource('users', UserController::class)->middleware('isSuperadmin');
    Route::resource('users', UserController::class);
    Route::post('users.update-role', [UserController::class,'updateRole'])->name('users.update-role');
    Route::resource('lapangan', LapanganController::class);
    Route::resource('lscteam', LscTeamController::class);
    Route::resource('bagian', BagianController::class);
    Route::resource('jenis-komunitas', JenisKomunitasController::class);
    Route::resource('komunitas', KomunitasController::class);
    Route::resource('event', EventController::class);
    Route::resource('blog', BlogController::class);

    Route::get('/admin/venues', [VenueController::class, 'index'])->name('admin.venues');
    Route::post('/admin/venues/{id}/approve', [VenueController::class, 'approve'])->name('admin.venues.approve');
    Route::post('/admin/venues/{id}/reject', [VenueController::class, 'reject'])->name('admin.venues.reject');
    });
});
Route::fallback(function () {
    return view('404');
});

