<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LessonController;

/*
|--------------------------------------------------------------------------
| الصفحة الرئيسية
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| تسجيل الدخول + إنشاء حساب
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| نسيت كلمة المرور
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| الصفحة الرئيسية بعد تسجيل الدخول
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| صفحة الملف الشخصي
|--------------------------------------------------------------------------
*/
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

/*
|--------------------------------------------------------------------------
| الأقسام الرئيسية
|--------------------------------------------------------------------------
*/
Route::get('/sections', function () {
    return view('sections.index');
})->name('sections');

/*
|--------------------------------------------------------------------------
| Switching Language (تغيير اللغة)
|--------------------------------------------------------------------------
*/
Route::get('language/{locale}', [LanguageController::class, 'switch'])
    ->name('lang.switch');

/*
|--------------------------------------------------------------------------
| قسم الذكاء الاصطناعي — AI
|--------------------------------------------------------------------------
*/
Route::prefix('section/ai')->group(function () {

    Route::get('/', function () {
        return view('sections.ai-community');
    })->name('section.ai');

    Route::get('/lessons', function () {
        return view('sections.lessons.ai.lessons-index');
    })->name('ai.lessons.index');

    Route::get('/lessons/{id}', function ($id) {
        return view('sections.lessons.ai.lesson-single', compact('id'));
    })->name('ai.lessons.single');

    Route::get('/lessons/{lesson_id}/paragraph/{paragraph_id}', function ($lesson_id, $paragraph_id) {
        return view('sections.lessons.ai.lesson-paragraph', compact('lesson_id', 'paragraph_id'));
    })->name('ai.lessons.paragraph');
});

/*
|--------------------------------------------------------------------------
| قسم اللغات — Languages
|--------------------------------------------------------------------------
*/
Route::prefix('languages')->group(function () {

    Route::get('/lessons', function () {
        return view('sections.lessons.languages.lessons-index');
    })->name('languages.lessons.index');

    Route::get('/lessons/{id}', function ($id) {
        return view('sections.lessons.languages.lesson-single', compact('id'));
    })->name('languages.lessons.single');

    Route::get('/lessons/{lesson_id}/paragraph/{paragraph_id}', function ($lesson_id, $paragraph_id) {
        return view(
            'sections.lessons.languages.lesson-paragraph',
            compact('lesson_id', 'paragraph_id')
        );
    })->name('languages.lessons.paragraph');

});
/*
|--------------------------------------------------------------------------
| قسم الدعم النفسي — Support
|--------------------------------------------------------------------------
*/
Route::prefix('section/support')->group(function () {

    Route::get('/', function () {
        return view('sections.support');
    })->name('section.support');

    Route::get('/lessons', function () {
        return view('sections.lessons.support.lessons-index');
    })->name('support.lessons.index');

    Route::get('/lessons/{id}', function ($id) {
        return view('sections.lessons.support.lesson-single', compact('id'));
    })->name('support.lessons.single');

    Route::get('/lessons/{lesson_id}/paragraph/{paragraph_id}', function ($lesson_id, $paragraph_id) {
        return view('sections.lessons.support.lesson-paragraph', compact('lesson_id', 'paragraph_id'));
    })->name('support.lessons.paragraph');
});

/*
|--------------------------------------------------------------------------
| قسم التحفيز — Motivation
|--------------------------------------------------------------------------
*/
Route::prefix('section/motivation')->group(function () {

    Route::get('/', function () {
        return view('sections.motivation');
    })->name('section.motivation');

    Route::get('/lessons', function () {
        return view('sections.lessons.motivation.lessons-index');
    })->name('motivation.lessons.index');

    Route::get('/lessons/{id}', function ($id) {
        return view('sections.lessons.motivation.lesson-single', compact('id'));
    })->name('motivation.lessons.single');

    Route::get('/lessons/{lesson_id}/paragraph/{paragraph_id}', function ($lesson_id, $paragraph_id) {
        return view('sections.lessons.motivation.lesson-paragraph', compact('lesson_id', 'paragraph_id'));
    })->name('motivation.lessons.paragraph');
});

/*
|--------------------------------------------------------------------------
| قسم الإبداع — Creativity
|--------------------------------------------------------------------------
*/
Route::prefix('section/creativity')->group(function () {

    Route::get('/', function () {
        return view('sections.creativity');
    })->name('section.creativity');

    Route::get('/lessons', function () {
        return view('sections.lessons.creativity.lessons-index');
    })->name('creativity.lessons.index');

    Route::get('/lessons/{id}', function ($id) {
        return view('sections.lessons.creativity.lesson-single', compact('id'));
    })->name('creativity.lessons.single');

    Route::get('/lessons/{lesson_id}/paragraph/{paragraph_id}', function ($lesson_id, $paragraph_id) {
        return view('sections.lessons.creativity.lesson-paragraph', compact('lesson_id', 'paragraph_id'));
    })->name('creativity.lessons.paragraph');
});
