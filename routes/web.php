<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Auth Redirect - redirect based on role after login
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'konselor' => redirect()->route('konselor.dashboard'),
        'konseli' => redirect()->route('konseli.dashboard'),
        default => redirect('/'),
    };
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Instrumen - Option Groups
    Route::resource('option-groups', \App\Http\Controllers\Admin\OptionGroupController::class);

    // Instrumen - Questions
    Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class);

    // Interpretations
    Route::resource('interpretations', \App\Http\Controllers\Admin\InterpretationController::class);

    // Counselors
    Route::resource('counselors', \App\Http\Controllers\Admin\CounselorController::class);

    // Self-Help: Tribes
    Route::resource('tribes', \App\Http\Controllers\Admin\TribeController::class);

    // Self-Help: Materials (nested under tribes)
    Route::resource('tribes.materials', \App\Http\Controllers\Admin\MaterialController::class);

    // Self-Help: Material Questions (nested under materials)
    Route::resource('materials.questions', \App\Http\Controllers\Admin\MaterialQuestionController::class)
        ->names('material-questions');

    // Lessons
    Route::resource('lessons', \App\Http\Controllers\Admin\LessonController::class);

    // Users Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

/*
|--------------------------------------------------------------------------
| Konseli Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:konseli'])->prefix('konseli')->name('konseli.')->group(function () {
    Route::get('/', function () {
        return view('konseli.dashboard');
    })->name('dashboard');

    // Wellbeing
    Route::get('/wellbeing', [\App\Http\Controllers\Konseli\WellbeingController::class, 'index'])->name('wellbeing.index');
    Route::get('/wellbeing/{type}', [\App\Http\Controllers\Konseli\WellbeingController::class, 'show'])->name('wellbeing.show');
    Route::post('/wellbeing/{type}/start', [\App\Http\Controllers\Konseli\WellbeingController::class, 'start'])->name('wellbeing.start');
    Route::post('/wellbeing/{type}/save', [\App\Http\Controllers\Konseli\WellbeingController::class, 'save'])->name('wellbeing.save');
    Route::post('/wellbeing/{type}/finish', [\App\Http\Controllers\Konseli\WellbeingController::class, 'finish'])->name('wellbeing.finish');
    Route::get('/wellbeing/{type}/result', [\App\Http\Controllers\Konseli\WellbeingController::class, 'result'])->name('wellbeing.result');
    Route::get('/wellbeing/{type}/pdf', [\App\Http\Controllers\Konseli\WellbeingController::class, 'downloadPdf'])->name('wellbeing.pdf');

    // Choose Counselor
    Route::get('/counselor', [\App\Http\Controllers\Konseli\CounselorSelectController::class, 'index'])->name('counselor.index');
    Route::post('/counselor/{user}', [\App\Http\Controllers\Konseli\CounselorSelectController::class, 'select'])->name('counselor.select');

    // Choose Tribe
    Route::get('/tribe', [\App\Http\Controllers\Konseli\TribeSelectController::class, 'index'])->name('tribe.index');
    Route::post('/tribe/{tribe}', [\App\Http\Controllers\Konseli\TribeSelectController::class, 'select'])->name('tribe.select');

    // Self-Help
    Route::get('/self-help/{tribe}', [\App\Http\Controllers\Konseli\SelfHelpController::class, 'show'])->name('self-help.show');
    Route::post('/self-help/save', [\App\Http\Controllers\Konseli\SelfHelpController::class, 'save'])->name('self-help.save');

    // Lessons (Pembelajaran)
    Route::get('/lessons', [\App\Http\Controllers\Konseli\LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessons/{lesson}', [\App\Http\Controllers\Konseli\LessonController::class, 'show'])->name('lessons.show');

    // Profile
    Route::get('/profile', [\App\Http\Controllers\Konseli\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Konseli\ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Konselor Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:konselor'])->prefix('konselor')->name('konselor.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Konselor\DashboardController::class, 'index'])->name('dashboard');

    // View Konseli Wellbeing Answers
    Route::get('/konseli/{user}/wellbeing', [\App\Http\Controllers\Konselor\KonseliWellbeingController::class, 'show'])->name('konseli.wellbeing');

    // View Konseli Self-Help Answers
    Route::get('/konseli/{user}/self-help', [\App\Http\Controllers\Konselor\KonseliSelfHelpController::class, 'show'])->name('konseli.self-help');

    // Lessons
    Route::resource('lessons', \App\Http\Controllers\Konselor\LessonController::class);

    // Profile
    Route::get('/profile', [\App\Http\Controllers\Konselor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Konselor\ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
