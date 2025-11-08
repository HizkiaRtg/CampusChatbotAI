<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrainingDataController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ChatHistoryController;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('chatbot.index');
    });
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Public chatbot
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');
Route::post('/chatbot/clear', [ChatbotController::class, 'clearChat'])->name('chatbot.clear');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Training Data Management - Explicit Routes
        Route::get('training-data', [TrainingDataController::class, 'index'])->name('training-data.index');
        Route::get('training-data/create', [TrainingDataController::class, 'create'])->name('training-data.create');
        Route::post('training-data', [TrainingDataController::class, 'store'])->name('training-data.store');
        Route::get('training-data/{id}/edit', [TrainingDataController::class, 'edit'])->name('training-data.edit');
        Route::put('training-data/{id}', [TrainingDataController::class, 'update'])->name('training-data.update');
        Route::delete('training-data/{id}', [TrainingDataController::class, 'destroy'])->name('training-data.destroy');
        Route::post('training-data/{id}/toggle', [TrainingDataController::class, 'toggle'])->name('training-data.toggle');

        // Keywords Management
        Route::get('training-data/{trainingData}/keywords', [KeywordController::class, 'index'])->name('keywords.index');
        Route::post('training-data/{trainingData}/keywords', [KeywordController::class, 'store'])->name('keywords.store');
        Route::delete('keywords/{keyword}', [KeywordController::class, 'destroy'])->name('keywords.destroy');

        // Chat History
        Route::get('chat-history', [ChatHistoryController::class, 'index'])->name('chat-history.index');
        Route::delete('chat-history/{chatHistory}', [ChatHistoryController::class, 'destroy'])->name('chat-history.destroy');
        Route::post('chat-history/clear', [ChatHistoryController::class, 'clear'])->name('chat-history.clear');
    });
});
