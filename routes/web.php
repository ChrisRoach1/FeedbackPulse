<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\RespondController;
use App\Http\Controllers\ResponseController;
use App\Models\Questionnaire;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'totalResponders' => auth()->user()->totalResponders(),
        'totalUserQuestionnaireCount' => auth()->user()->questionnaires()->get()->count(),
        'totalQuestionnaireCount' => Questionnaire::all()->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/thankyou', function(){
    return Inertia::render('ThankYou');
})->name('thankyou');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/questionnaire', [QuestionnaireController::class, 'store'])->name('questionnaire.store');
    Route::get('/questionnaire', [QuestionnaireController::class, 'index'])->name('allQuestionnaires');
    Route::get('/questionnaire/{id}', [QuestionnaireController::class, 'index'])->name('questionnaire.show');
});

Route::middleware([])->group(function(){
    Route::get('/respond/{slug}', [RespondController::class, 'index'])->name('response.show');
    Route::post('/respond/{slug}', [RespondController::class, 'store'])->name('response.store');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/response/{id}', [ResponseController::class, 'index'])->name('allResponses');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
