<?php

use App\Http\Controllers\GroqController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\EntitiesController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [EntitiesController::class, 'dashboardlist'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/list', [EntitiesController::class, 'list'])
->middleware(['auth','verified'])->name('list');

Route::get('/dashboard/card/{card_id}',[CardController::class, 'rud'])
->middleware(['auth', 'verified'])->name('card.rud');

Route::get('/list/deck/{deck_id}',[DeckController::class, 'rud'])
->middleware(['auth', 'verified'])->name('deck.rud');


Route::get('/dashboard/card',[CardController::class, 'cardGeneration'])
->middleware(['auth','verified'])->name('card-creation');

Route::post('/dashboard/card',[CardController::class, 'create'])
->middleware(['auth','verified'])->name('card.create');

Route::get('/dashboard/cardai',[GroqController::class, 'show'])
->middleware(['auth','verified'])->name('ia-card-creation');

Route::post('/dashboard/cardai',[GroqController::class, 'getGroqChatCompletion'])
->middleware(['auth','verified'])->name('cardai.send');

Route::post('/dashboard/cardai/send',[CardController::class, 'cardGenerationAI'])
->middleware(['auth','verified'])->name('cardai.create');

Route::put('/dashboard/card/{card_id}',[CardController::class,'update'])
->middleware(['auth','verified'])->name('card.update');


Route::delete('/dashboard/card/{card_id}',[CardController::class, 'delete'])
->middleware(['auth', 'verified'])->name('card.delete');

Route::post('/dashboard/deck',[DeckController::class, 'create'])
->middleware(['auth','verified'])->name('deck.create');

Route::put('list/deck/{deck_id}',[DeckController::class, 'update'])
->middleware(['auth','verified'])->name('deck.update');

Route::put('list/deck/{deck_id}/{card_id}',[CardController::class, 'removeCard'])
->middleware(['auth','verified'])->name('deck.update.remove.card');

Route::delete('list/deck/{deck_id}',[DeckController::class, 'delete'])
->middleware(['auth','verified'])->name('deck.delete');

Route::post('/dashboard/category',[CategoryController::class, 'create'])
->middleware(['auth', 'verified'])->name('category.create');

Route::get('/groq-chat-completion', [GroqController::class, 'getGroqChatCompletion']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
