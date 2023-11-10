<?php
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['register' => false]);
Route::prefix('admin')->middleware(['auth'])->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //profile
    Route::get('/profile',[ProfileController::class,'index'])->name('admin.profile');
    Route::get('/profile/edit/{id}',[ProfileController::class,'edit'])->name('admin.profile.edit');
    Route::post('/profile/update/{id}',[ProfileController::class,'update'])->name('admin.profile.update');
    Route::post('/profile/change_password/{id}',[ProfileController::class,'changePassword'])->name('admin.profile.changepassword');

    //Role
    Route::get('/role/list',[RoleController::class,'index'])->name('admin.role.index');
    Route::get('/role/create',[RoleController::class,'create'])->name('admin.role.create');
    Route::post('/role/store',[RoleController::class,'store'])->name('admin.role.store');
    Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('admin.role.edit');
    Route::post('/role/update/{id}',[RoleController::class,'update'])->name('admin.role.update');
    Route::post('/role/delete/{id}',[RoleController::class,'destroy'])->name('admin.role.destroy');

    //user
    Route::get('/user/list',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/user/create',[UserController::class,'create'])->name('admin.user.create');
    Route::post('/user/store',[UserController::class,'store'])->name('admin.user.store');
    Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('admin.user.edit');
    Route::post('/user/update/{id}',[UserController::class,'update'])->name('admin.user.update');
    Route::post('/user/delete/{id}',[UserController::class,'destroy'])->name('admin.user.destroy');

    //permission
    Route::get('/permission/list',[PermissionController::class,'index'])->name('admin.permission.index');
    Route::get('/permission/create',[PermissionController::class,'create'])->name('admin.permission.create');
    Route::post('/permission/store',[PermissionController::class,'store'])->name('admin.permission.store');
    Route::get('/permission/edit/{id}',[PermissionController::class,'edit'])->name('admin.permission.edit');
    Route::post('/permission/update/{id}',[PermissionController::class,'update'])->name('admin.permission.update');
    Route::post('/permission/delete/{id}',[PermissionController::class,'destroy'])->name('admin.permission.destroy');
});
