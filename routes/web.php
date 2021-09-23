<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\FavoriteQuestionController;
use App\Http\Controllers\QuestionsAndAnswersController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\VotesQuestionAnswerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//qna
Route::get('qna', [QuestionsAndAnswersController::class, 'index'])->name('qna');
Route::get('qna/your-questions', [QuestionsAndAnswersController::class, 'yourQuestions'])->name('qna.yourQuestions')->middleware('auth');
Route::get('qna/favorites', [QuestionsAndAnswersController::class, 'favorites'])->name('qna.favorites')->middleware('auth');
Route::get('qna/notifications', [QuestionsAndAnswersController::class, 'notifications'])->name('qna.notifications')->middleware('auth');
Route::get('qna/questions-you-answered', [QuestionsAndAnswersController::class, 'questionsYouAnswerd'])->name('qna.questionsYouAnswerd')->middleware('auth');

//qna Questions
Route::resource('qna/questions', QuestionsController::class)->except(['create', 'show']);

//qna Answers
Route::resource('qna/questions.answers', AnswersController::class);

//Questions Slug
Route::get('qna/questions/{slug}', [QuestionsController::class, 'show'])->name('questions.show');

//Mark Best/unbest/Vote
Route::put('answers/{answer}/mark-best-answer', [AnswersController::class, 'markbestAnswer'])->name('answers.markBestAnswer');
Route::put('answers/{answer}/unmark-best-answer', [AnswersController::class, 'unmarkBestAnswer'])->name('answers.unmarkBestAnswer');
Route::post('answers/{answer}/vote/{vote}', [VotesQuestionAnswerController::class, 'voteAnswer'])->name('answers.vote');

//Courses
Route::get('courses', [CoursesController::class, 'index'])->name('courses.index');
Route::post('courses', [CoursesController::class, 'store'])->name('courses.store');
Route::get('courses/create', [CoursesController::class, 'create'])->name('courses.create');
Route::get('courses/{courseSlug}', [CoursesController::class, 'show'])->name('courses.show');
Route::put('courses/{courseSlug}', [CoursesController::class, 'update'])->name('courses.update');
Route::delete('courses/{courseSlug}', [CoursesController::class, 'destroy'])->name('courses.destroy');
Route::get('courses/{courseSlug}/edit', [CoursesController::class, 'edit'])->name('courses.edit');


//Testimonials

Route::resource('testimonials', TestimonialsController::class)->middleware('auth');

//User Verify Email Token
Route::get('users/verify/{token}', [RegisterController::class, 'verify'])->name('users.verify');

//Questions favorite/unfavorite/vote
Route::put('questions/{question}/favorite', [FavoriteQuestionController::class, 'favorite'])->name('questions.favorite');
Route::put('questions/{question}/unfavorite', [FavoriteQuestionController::class, 'unfavorite'])->name('questions.unfavorite');
Route::post('questions/{question}/vote/{vote}', [VotesQuestionAnswerController::class, 'voteQuestion'])->name('questions.vote');
