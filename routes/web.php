<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
});

Route::middleware(['auth:admin'])->group(function (){

    Route::middleware([
        'auth:sanctum,admin',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('backend.index');
        })->name('dashboard')-> middleware('auth:admin');
    });

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/changePassword',[\App\Http\Controllers\Backend\AdminProfileController::class,'changePassword'])->name('admin.changePassword');
    Route::post('/admin/updatePassword',[\App\Http\Controllers\Backend\AdminProfileController::class,'updatePassword'])->name('admin.updatePassword');

});

Route::middleware(['auth:admin'])->group(function (){
    Route::get('/change/companyProfile',[\App\Http\Controllers\Backend\SiteSettingController::class,'changeProfileCompany'])->name('admin.changeProfileCompany');
    Route::post('/update/companyProfile',[\App\Http\Controllers\Backend\SiteSettingController::class,'updateProfileCompany'])->name('admin.updateProfileCompany');



    Route::get('/view/slider',[\App\Http\Controllers\Backend\SliderController::class,'viewSlider'])->name('admin.viewSlider');
    Route::get('/edit/slider/{id}',[\App\Http\Controllers\Backend\SliderController::class,'editSlider'])->name('admin.editSlider');
    Route::post('/store/slider',[\App\Http\Controllers\Backend\SliderController::class,'storeSlider'])->name('admin.storeSlider');
    Route::get('/inactive/slider/{id}', [SliderController::class, 'sliderInactive'])->name('inactive.slider');
    Route::get('/active/slider/{id}', [SliderController::class, 'sliderActive'])->name('active.slider');
    Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('delete.slider');
    Route::post('/update/slider', [SliderController::class, 'sliderUpdate'])->name('admin.updateSlider');


    Route::get('/view/category',[\App\Http\Controllers\Backend\CategoryController::class,'viewCategory'])->name('admin.viewCategory');
    Route::post('/store/category', [\App\Http\Controllers\Backend\CategoryController::class, 'storeCategory'])->name('store.category');
    Route::get('/edit/category/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'editCategory'])->name('edit.category');
    Route::post('/update/category/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'updateCategory'])->name('update.category');
    Route::get('/delete/category/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'deleteCategory'])->name('delete.category');

    Route::get('/view/subcategory',[\App\Http\Controllers\Backend\CategoryController::class,'viewSubCategory'])->name('admin.viewSubCategory');
    Route::post('/store/subcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'storeSubcategory'])->name('store.subcategory');
    Route::get('/edit/subcategory/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'editSubcategory'])->name('edit.subcategory');
    Route::post('/update/subcategory/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'updateSubcategory'])->name('update.subcategory');
    Route::get('/delete/subcategory/{id}',[\App\Http\Controllers\Backend\CategoryController::class,'deleteSubcategory'])->name('delete.subcategory');


    Route::get('/view/sub_subcategory',[\App\Http\Controllers\Backend\CategoryController::class,'viewSubSubCategory'])->name('admin.viewSubSubCategory');


    Route::get('/view/product',[\App\Http\Controllers\Backend\ProductController::class,'viewProduct'])->name('admin.viewProduct');
    Route::get('/edit/product/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'editProduct'])->name('edit.product');
    Route::get('/delete/product/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'deleteProduct'])->name('delete.product');
    Route::post('/update/product/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'updateProduct'])->name('update.product');
    Route::get('/add/product', [\App\Http\Controllers\Backend\ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/store/product', [\App\Http\Controllers\Backend\ProductController::class, 'storeProduct'])->name('store.product');
});


Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
