<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CheckoutController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\Payment\CashController;
use App\Http\Controllers\Backend\Payment\StripeController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CartPageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserOrderController;
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
    Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
});

Route::middleware(['auth:admin'])->group(function () {

    Route::middleware([
        'auth:sanctum,admin',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('backend.index');
        })->name('dashboard')->middleware('auth:admin');
    });

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/changePassword', [\App\Http\Controllers\Backend\AdminProfileController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/admin/updatePassword', [\App\Http\Controllers\Backend\AdminProfileController::class, 'updatePassword'])->name('admin.updatePassword');

});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/change/companyProfile', [\App\Http\Controllers\Backend\SiteSettingController::class, 'changeProfileCompany'])->name('admin.changeProfileCompany');
    Route::post('/update/companyProfile', [\App\Http\Controllers\Backend\SiteSettingController::class, 'updateProfileCompany'])->name('admin.updateProfileCompany');


    Route::get('/view/slider', [\App\Http\Controllers\Backend\SliderController::class, 'viewSlider'])->name('admin.viewSlider');
    Route::get('/edit/slider/{id}', [\App\Http\Controllers\Backend\SliderController::class, 'editSlider'])->name('admin.editSlider');
    Route::post('/store/slider', [\App\Http\Controllers\Backend\SliderController::class, 'storeSlider'])->name('admin.storeSlider');
    Route::get('/inactive/slider/{id}', [SliderController::class, 'sliderInactive'])->name('inactive.slider');
    Route::get('/active/slider/{id}', [SliderController::class, 'sliderActive'])->name('active.slider');
    Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('delete.slider');
    Route::post('/update/slider', [SliderController::class, 'sliderUpdate'])->name('admin.updateSlider');


    Route::get('/view/category', [\App\Http\Controllers\Backend\CategoryController::class, 'viewCategory'])->name('admin.viewCategory');
    Route::post('/store/category', [\App\Http\Controllers\Backend\CategoryController::class, 'storeCategory'])->name('store.category');
    Route::get('/edit/category/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'editCategory'])->name('edit.category');
    Route::post('/update/category/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'updateCategory'])->name('update.category');
    Route::get('/delete/category/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'deleteCategory'])->name('delete.category');

    Route::get('/view/subcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'viewSubCategory'])->name('admin.viewSubCategory');
    Route::post('/store/subcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'storeSubcategory'])->name('store.subcategory');
    Route::get('/edit/subcategory/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'editSubcategory'])->name('edit.subcategory');
    Route::post('/update/subcategory/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'updateSubcategory'])->name('update.subcategory');
    Route::get('/delete/subcategory/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'deleteSubcategory'])->name('delete.subcategory');

    Route::get('/view/subsubcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'viewSubSubCategory'])->name('admin.viewSubSubCategory');
    Route::post('/store/subsubcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'storeSubSubcategory'])->name('store.subsubcategory');
    Route::get('/edit/subsubcategory/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'editSubSubcategory'])->name('edit.subsubcategory');
    Route::post('/update/subsubcategory/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'updateSubSubcategory'])->name('update.subsubcategory');
    Route::get('/delete/subsubcategory/{id}', [\App\Http\Controllers\Backend\CategoryController::class, 'deleteSubSubcategory'])->name('delete.subsubcategory');
    Route::get('/category/subcategory/ajax/{category_id}', [\App\Http\Controllers\Backend\CategoryController::class, 'getSubCategory']);
    Route::get('/category/sub_subcategory/ajax/{subcategory_id}', [\App\Http\Controllers\Backend\CategoryController::class, 'getSubSubCategory']);
    Route::get('/view/sub_subcategory', [\App\Http\Controllers\Backend\CategoryController::class, 'viewSubSubCategory'])->name('admin.viewSubSubCategory');


    Route::get('/view/brand', [\App\Http\Controllers\Backend\BrandController::class, 'viewBrand'])->name('admin.viewBrand');
    Route::post('/store/brand', [\App\Http\Controllers\Backend\BrandController::class, 'storeBrand'])->name('store.brand');
    Route::get('/edit/brand/{id}', [\App\Http\Controllers\Backend\BrandController::class, 'editBrand'])->name('edit.brand');
    Route::post('/update/brand/{id}', [\App\Http\Controllers\Backend\BrandController::class, 'updateBrand'])->name('update.brand');
    Route::get('/delete/brand/{id}', [\App\Http\Controllers\Backend\BrandController::class, 'deleteBrand'])->name('delete.brand');


    Route::get('/view/product', [\App\Http\Controllers\Backend\ProductController::class, 'viewProduct'])->name('admin.viewProduct');
    Route::get('/edit/product/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'editProduct'])->name('edit.product');
    Route::get('/delete/product/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'deleteProduct'])->name('delete.product');
    Route::post('/update/product/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'updateProduct'])->name('update.product');
    Route::get('/add/product', [\App\Http\Controllers\Backend\ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/store/product', [\App\Http\Controllers\Backend\ProductController::class, 'storeProduct'])->name('store.product');

    Route::post('/update/product/image/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'updateProductImage'])->name('update.product.image');
    Route::post('/update/product/thumbnail/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'updateProductThumbnail'])->name('update.product.thumbnail');
    Route::get('/multi_img/delete/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'MultiImageDelete'])->name('product.multi_img.delete');


    Route::get('product/inactive/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('product/active/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'ProductActive'])->name('product.active');

// Admin Blog  Routes
    Route::get('/blog-category/view', [BlogController::class, 'BlogCategory'])->name('view.blog.category');

    Route::post('/store/blog-category', [BlogController::class, 'BlogCategoryStore'])->name('blog.category.store');

    Route::get('/edit/blog-category/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blog.category.edit');
    Route::get('/delete/blog-category/{id}', [BlogController::class, 'BlogCategoryDelete'])->name('blog.category.delete');
    Route::post('/update/blog-category', [BlogController::class, 'BlogCategoryUpdate'])->name('blog.category.update');

// Admin View Blog Post Routes

    Route::get('view/list/blog', [BlogController::class, 'ListBlogPost'])->name('list.blog');

    Route::get('/add/blog', [BlogController::class, 'AddBlogPost'])->name('add.blog');
    Route::get('/edit/blog/{id}', [BlogController::class, 'EditBlogPost'])->name('edit.blog');
    Route::post('/update/blog', [BlogController::class, 'BlogPostUpdate'])->name('update.blog');
    Route::post('/store/blog', [BlogController::class, 'BlogPostStore'])->name('store.blog');
    Route::get('/delete/blog/{id}', [BlogController::class, 'DeleteBlogPost'])->name('delete.blog');


    // Ship Division
    Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');

    Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');

    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');

    Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');

    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');


// Ship District
    Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');

    Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');

    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');

    Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');

    Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');


// Ship State
    Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');

    Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');

    Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');

    Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');

    Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');

    Route::prefix('orders')->group(function(){

        Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders');

        Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');

        Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');

        Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');

        Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');

        Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');

        Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');

        Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

// Update Status
        Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');

        Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');

        Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');

        Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

        Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');

        Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');



    });


});
Route::get('/district-get/ajax/{division_id}', [ShippingAreaController::class, 'DistrictGetAjax']);

Route::get('/state-get/ajax/{district_id}', [ShippingAreaController::class, 'StateGetAjax']);

// Client all route
// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [\App\Http\Controllers\Frontend\HomeController::class, 'ProductViewAjax']);
//Product Detail
Route::get('/product/detail/{id}', [\App\Http\Controllers\Frontend\HomeController::class, 'ProductDetail'])->name('product.detail');


Route::group(['prefix' => 'user', 'middleware' => ['auth:web']], function () {
    // Add to Wishlist
    Route::get('/add-to-wishlist/{product_id}', [\App\Http\Controllers\Frontend\CartController::class, 'AddToWishlist'])->name('add.wishlist');
    Route::get('/get-wishlist', [\App\Http\Controllers\Frontend\CartController::class, 'GetWishlist'])->name('get.wishlist');
    Route::get('/remove-wishlist/{product_id}', [\App\Http\Controllers\Frontend\CartController::class, 'RemoveWishlist'])->name('remove.wishlist');
    Route::get('/get-cart-product', [CartPageController::class, 'GetCartProduct']);
    Route::get('/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);

    Route::post('/review-store', [\App\Http\Controllers\Backend\ReviewController::class, 'ReviewStore'])->name('review.store');

    Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

    Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');
    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    Route::get('/my/orders', [UserOrderController::class, 'MyOrders'])->name('my.orders');
    Route::get('/order_detail/{order_id}', [UserOrderController::class, 'OrderDetails']);
    Route::get('/return/order/list', [UserOrderController::class, 'ReturnOrderList'])->name('return.order.list');
    Route::get('/cancel/orders', [UserOrderController::class, 'CancelOrders'])->name('cancel.orders');
    Route::get('/invoice_download/{order_id}', [UserOrderController::class, 'InvoiceDownload']);


});
//get list product
Route::get('/list/product/{cat_id}', [HomeController::class, 'ListProduct'])->name('list.product');
// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcat_id}', [HomeController::class, 'SubCatWiseProduct']);
// Frontend Sub-SubCategory wise Data
Route::get('/subsubcategory/product/{subsubcat_id}', [HomeController::class, 'SubSubCatWiseProduct']);
// Add to Cart Store Data
Route::get('/add/cart/{id}', [CartController::class, 'AddToCart'])->name('add.toCart');


// Get Data from mini cart
Route::get('/product/mini-cart', [CartController::class, 'AddMiniCart']);
// Remove mini cart
Route::get('/mini-cart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Remove mini cart
Route::get('/mini-cart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

Route::get('/my-cart', [CartPageController::class, 'MyCart'])->name('mycart');
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

// Checkout Routes




Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('web/dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');
});
Route::get('/user/logout', [HomeController::class, 'UserLogout'])->name('user.logout');
