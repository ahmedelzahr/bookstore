<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GallaryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

use Illuminate\Support\Facades\Route;

Route::Post('/test/checkout', [PurchaseController::class,"creditCheckout"])->name('checkout');

Route::get('checkout/subscription/complete', [PurchaseController::class,"completePayment"])->name('subscription.complete');

// Route::get('/test/checkout', function (Request $request) {
//     $stripePriceId = 'price_1U9NkU2FTSwnmB8c2tnaWnPC';

//     $quantity = 1;

//     return $request->user()->checkout([$stripePriceId => $quantity], [
//         'success_url' => route('checkout-success'),
//         'cancel_url' => route('checkout-cancel'),
//     ]);
// })->name('checkout');

// Route::view('/checkout/success', 'checkout.success')->name('checkout-success');
// Route::view('/checkout/cancel', 'checkout.cancel')->name('checkout-cancel');
// Route::get('/test-cart', function () {
//     return 'Laravel is working';
// });
Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        return redirect(route('books.index'));
    })->name('dashboard');
});
Route::get('/orders',[OrderController::class,'orders'])->name('orders');
Route::get('/', [GallaryController::class, 'index'])->name('books.index');
Route::get('/search', [GallaryController::class, 'search'])->name('book.search');
Route::get('/{book}', [BookController::class, 'details'])->name('book.details');
Route::post('/{book}/rating/rate', [BookController::class, 'rate'])->name('book.rate');

Route::post('/cart/add', [CartController::class, 'addToCart'])->middleware('auth')->name('cart.add');
Route::post('/cart/remove_one_item', [CartController::class, 'removeOneItem'])->middleware('auth')->name('cart.removeOne');
Route::post('/cart/delete', [CartController::class, 'delete'])->middleware('auth')->name('cart.delete');
Route::get('/categories/list', [CategoryController::class, 'list'])->name('ctegories_list');
Route::get('/categories/{category}/books', [CategoryController::class, 'categoryBooks'])->name('catgory.books');
Route::get('/catgories/search', [CategoryController::class, 'search'])->name('category.search');

Route::get('/authors/list', [AuthorController::class, 'list'])->name('authors_list');
Route::get('/authors/{author}/books', [AuthorController::class, 'authorBooks'])->name('author.books');
Route::get('/authors/search', [AuthorController::class, 'search'])->name('author.search');

Route::get('/publishers/list', [PublisherController::class, 'list'])->name('publishers_list');
Route::get('/publishers/{publisher}/books', [PublisherController::class, 'publisherBooks'])->name('publisher.books');
Route::get('/publishers/search', [PublisherController::class, 'search'])->name('publisher.search');
Route::prefix('admin')->middleware('can:update-books')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');
    Route::get('/orders',[OrderController::class,'allOrders'])->name('admin.orders');
    Route::resource('/book', BookController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/publisher', PublisherController::class);
    Route::resource('/author', AuthorController::class);
    Route::resource('/user', UserController::class)->middleware('can:update-users');
});
