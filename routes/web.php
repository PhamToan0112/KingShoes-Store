<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as C_Home;
use App\Http\Controllers\AboutController as C_About;
use App\Http\Controllers\CartController as C_Cart;
use App\Http\Controllers\BillController as C_Bill;
use App\Http\Controllers\ContactController as C_Contact;
use App\Http\Controllers\Auth\LoginController as C_Login;
use App\Http\Controllers\Auth\RegisterController as C_Register;
use App\Http\Controllers\ProductController as C_Product;
use App\Http\Controllers\A_HomeController as A_HomeController;
use App\Http\Controllers\A_UserController as A_UserController;
use App\Http\Controllers\A_ProductController as A_ProductController;
use App\Http\Controllers\A_Categories as A_Categories;
use App\Http\Controllers\A_BillsController as A_BillsController;
use App\Http\Controllers\A_BannerController as A_BannerController;

Route::middleware(['web'])->group(function () {

    Route::get('/', [C_Home::class, 'index'])->name('home');
    Route::get('/about', [C_About::class, 'index'])->name('about');
    Route::get('/view-cart', [C_Cart::class, 'viewcart'])->name('viewcart');
    Route::post('/add-to-cart', [C_Cart::class, 'addToCart'])->name('addToCart');
    Route::get('/buyNow/{id}', [C_Cart::class, 'buyNow'])->name('buyNow');
    Route::delete('/remove-cart', [C_Cart::class, 'cartRemove'])->name('cart.remove');

    Route::get('/view-bill', [C_Bill::class, 'viewbill'])->name('view.bill');
    Route::post('/checkout', [C_Bill::class, 'checkout'])->name('checkout');
    Route::get('/thank-you', [C_Bill::class, 'thank_you'])->name('thank_you');

    Route::get('/contact', [C_Contact::class, 'index'])->name('contact');

    Route::get('/login', [C_Login::class, 'showLoginForm'])->name('login');
    Route::post('/login', [C_Login::class, 'login']);
    Route::get('/logout', [C_Login::class, 'logout'])->name('logout');

    Route::get('/auth/reset_password', [C_Login::class, 'reset_password'])->name('reset_password');
    Route::post('/auth/reset_password', [C_Login::class, 'checkmail'])->name('reset_password');

    Route::get('/auth/update-password/{token}', [C_Login::class, 'update_password'])->name('update_password');
    Route::post('auth/update-password', [C_Login::class, 'handleUpdatePassword'])->name('handle_update_password');


    Route::get('/auth/register', [C_Register::class, 'showRegistrationForm'])->name('register');
    Route::post('/auth/register', [C_Register::class, 'register']);

    Route::get('/product', [C_Product::class, 'index'])->name('viewproduct');
    Route::get('product/category/{name_url}', [C_Product::class, 'index'])->name('category.name_url');
    Route::get('/product/product_detail/{slug}', [C_Product::class, 'product_detail'])->name('product.product_detail');
    Route::get('/search', [C_Product::class, 'search'])->name('search');
    Route::post('/load-comment', [C_Product::class, 'load_comment'])->name('load_comment');
    Route::post('/send-comment', [C_Product::class, 'send_comment'])->name('/send_comment');
});


Route::middleware(['web'])->group(function () {

    Route::get('/admin_page/A-Banners', [A_BannerController::class, 'view_banners'])->name('admin.A_Banner');
    Route::get('/admin_page/A-AddBanner', [A_BannerController::class, 'view_addbanner'])->name('view_addbanner');
    Route::post('/admin_page/A-AddBanner', [A_BannerController::class, 'add_banner'])->name('add_banner');
    Route::get('/admin_page/A-EditBanner/{id}', [A_BannerController::class, 'edit_banner'])->name('edit_banner');
    Route::put('/admin_page/A-UpdateBanner/{id}', [A_BannerController::class, 'update_banner'])->name('update_banner');
    Route::delete('/admin_page/A-DestroyBanner/{id}', [A_BannerController::class, 'destroy_banner'])->name('destroy_banner');

    Route::get('/admin_page', [A_HomeController::class, 'index'])->name('home_admin');
    Route::get('/admin_page/A-Products', [A_ProductController::class, 'index'])->name('A_Products');
    Route::get('/admin_page/View_addproduct', [A_ProductController::class, 'view_addproduct'])->name('view_addproduct');
    Route::post('/admin_page/View_addproduct', [A_ProductController::class, 'view_addproduct'])->name('view_addproduct');
    Route::post('/A-AddProduct', [A_ProductController::class, 'add_product'])->name('add_product');

    Route::get('/admin_page/edit/{id}', [A_ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [A_ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [A_ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/admin_page/A-User', [A_UserController::class, 'index'])->name('A_User');
    Route::get('/admin_page/A-AddUser', [A_UserController::class, 'view_adduser'])->name('view_adduser');
    Route::post('/admin_page/A-AddUser', [A_UserController::class, 'add_user'])->name('add_user');
    Route::get('/admin_page/A-UserEdit/{id}', [A_UserController::class, 'edit'])->name('user.edit');
    Route::put('/admin_page/A-UserUpdate/{id}', [A_UserController::class, 'update'])->name('user.update');
    Route::delete('/admin_page/A-UserDestroy/{id}', [A_UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/admin_page/export', [A_UserController::class, 'export'])->name('export');

    Route::get('/admin_page/A-Categories', [A_Categories::class, 'view_categories'])->name('A_Categories');
    Route::get('/admin_page/View_AddCategories', [A_Categories::class, 'view_addcategories'])->name('view_addcategories');
    Route::post('/admin_page/A-AddCategories', [A_Categories::class, 'add_categories'])->name('add_categories');
    Route::get('/admin_page/A-EditCategories/{id}', [A_Categories::class, 'edit_categories'])->name('edit_categories');
    Route::put('/admin_page/A-UpdateCategories/{id}', [A_Categories::class, 'update_categories'])->name('update_categories');
    Route::delete('/admin_page/A-DestroyCategories/{id}', [A_Categories::class, 'destroy_categories'])->name('destroy_categories');

    Route::get('/admin_page/A-Bills', [A_BillsController::class, 'view_bills'])->name('A_Bills');
    Route::get('/edit-bill/{id}', [A_BillsController::class, 'editbill'])->name('edit.bill');
    Route::put('/update-bill/{id}', [A_BillsController::class, 'updatebill'])->name('update.bill');
    Route::get('/detail-bill/{id}', [A_BillsController::class, 'detailbill'])->name('detail.bill');
    Route::delete('/delete-bill/{id}', [A_BillsController::class, 'destroy_bill'])->name('delete.bill');
    Route::get('/admin_page/exportBills', [A_BillsController::class, 'export'])->name('exportBill');


});
