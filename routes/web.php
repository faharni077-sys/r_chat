<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\GroupMemberController;

Route::view('/', 'welcome')->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/chat/{id}', [ChatController::class, 'show'])
    ->middleware(['auth'])
    ->name('chat.show');

Route::post('/message/send', [MessageController::class, 'store'])
    ->middleware('auth')
    ->name('message.send');

Route::delete('/message/{message}', [MessageController::class, 'destroy'])
    ->name('message.destroy');
       
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/group/{group}/member', [GroupMemberController::class, 'create'])
    ->name('group.member.create');
    Route::post('/group/member/store', [GroupMemberController::class, 'store'])
    ->name('group.member.store');

Route::get('/group/{id}', [GroupChatController::class, 'show'])
    ->name('group.show');

Route::post('/group/send', [GroupChatController::class, 'send'])
    ->name('group.send');

Route::get('/groups', [GroupChatController::class, 'index'])
    ->name('groups.index');

Route::get('/groups/create', [GroupChatController::class, 'create'])
    ->name('groups.create');

Route::post('/groups/store', [GroupChatController::class, 'store'])
    ->name('groups.store');

});

require __DIR__.'/auth.php';
