<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

//gest閲覧可能ルート
Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{id}', [ItemController::class, 'show'])->name('items.show');

//認証必須ルート
Route::middleware(['auth'])->group(function () {
// Route::middleware(['auth', 'verified'])->group(function (){
    // プロフィール関連
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    //出品関連
    Route::get('/sell', [ItemController::class, 'create'])->name('items.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('items.store');
    //購入関連
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/address/{item_id}', [ProfileController::class, 'editAddress'])->name('purchase.address');
    Route::patch('/purchase/address/{item_id}', [ProfileController::class, 'updateAddress'])->name('purchase.address.update');
    //いいね・コメント
    Route::post('/item/{item_id}/like', [LikeController::class, 'toggle'])->name('items.like');
    Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])->name('items.comment');
});
