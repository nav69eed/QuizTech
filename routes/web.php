<?php

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customAuthController;
use App\Http\Controllers\quizController;
use Illuminate\Contracts\Session\Session;

function finduser()
{
    return User::find(session('loginID'));
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'loginusercheck'], function () {
    Route::view('/login', 'login');
    Route::view('/registration', 'registration');
});
// 
// 
// 
Route::post('/login', [customAuthController::class, 'loginuser'])->name('login');
Route::post('/registration', [customAuthController::class, 'registeruser'])->name('registration');
Route::post('/quizform', [quizController::class, 'quizform'])->name('quizform');
Route::post('/createquiz', [quizController::class, 'createques'])->name('createques');
// 
// 
// 
// 
Route::view('/', 'index');
// 
// 
// 
// 

Route::middleware(['authenticationcheck'])->group(function () {
    Route::get('/home', [customAuthController::class, 'homepage']);
    Route::get('/logout', [customAuthController::class, 'logoutuser'])->name('logout');
    // Add more routes if needed
});


Route::get('/quiz', function () {
    $id = 1;
    $quiz = Quiz::with('questions.options', 'attemptedusers')->get();
    return $quiz;
});

Route::get('/quizform', function () {
    $user = finduser();
    if ($user) {
        return view('quizform', ['user' => $user]);
    } else {
        // User not found
        return 'User not found';
    }
});
Route::get('/createquiz', function () {
    $qid = Session('quizID');
    $quiz = Quiz::with('questions.options')->find($qid);
    $user = finduser();
    if ($user) {

        return view('createquiz', ['user' => $user, 'quiz' => $quiz]);
    } else {
        return 'User not found';
    }
});


Route::get('/allquizzes', [quizController::class, 'allquiz'])->name('allquiz');
Route::get('/singlequiz/{id}', [quizController::class, 'squiz'])->name('squiz');
Route::post('/quiz/submit/{id}', [quizController::class, 'quizsubmit'])->name('quizsubmit');
