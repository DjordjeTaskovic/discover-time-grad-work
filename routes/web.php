<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HisDataController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\MailController;


//routes not intended for logged in users
Route::middleware(['loggedGuard'])->group(function () {
    Route::get('/loginpage', [AuthController::class, 'loginpage'])->name('loginpage');
    Route::get('/registerpage', [AuthController::class, 'registerpage'])->name('registerpage');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


// admin routes
Route::middleware(['adminIn'])->group(function () {
    
    Route::get('/ad_dashboard', [AdminController::class, 'ad_dashboard'])->name('ad_dashboard');//index
    Route::get('/ad_mailbox', [MailController::class, 'ad_mailbox'])->name('ad_mailbox');
    Route::get('/ad_mailbox_arch', [MailController::class, 'ad_mailbox_arch'])->name('ad_mailbox_arch');
    Route::post('/mail_trash', [MailController::class, 'mail_trash'])->name('mail_trash');
    Route::post('/mail_arch', [MailController::class, 'mail_arch'])->name('mail_arch');

    Route::get('/ad_reviews', [AdminController::class, 'ad_reviews'])->name('ad_reviews');
    Route::get('/log_file_msg', [AdminController::class, 'log_file_msg'])->name('log_file_msg'); 
    
    Route::resource('ad_his_data', HisDataController::class);
    Route::resource('ad_lectures', LectureController::class);
    Route::get('/ad_user/{userID}', [AdminController::class, 'ad_user'])->name('ad_user');
    Route::put('/ad_user_update', [AdminController::class, 'ad_user_update'])->name('ad_user_update');

});

//routes only for logged in users
Route::middleware(['loggedIn'])->group(function () {
    Route::get('/enroll_lecture/{id}', [MainController::class, 'enroll_lecture'])->name('enroll_lecture');

    Route::get('/membership_checkout/{id}', [MainController::class, 'membership_checkout'])->name('membership_checkout');
    Route::post('/purchase_subscription', [MainController::class, 'purchase_subscription'])->name('purchase_subscription');
    Route::get('/lecture_content/{id}', [MainController::class, 'lecture_content'])->name('lecture_content');
    Route::get('/lecture_content_finished/{id}', [MainController::class, 'lecture_content_finished'])->name('lecture_content_finished');
    Route::get('/quiz_details/{id}', [MainController::class, 'quiz_details'])->name('quiz_details');
    Route::get('/ajax_quiz', [MainController::class, 'ajax_quiz'])->name('ajax_quiz');


    //user routes
    Route::get('/u_dashboard',[UserController::class,"u_dashboard"])->name('u_dashboard');//index
    Route::get('/u_lectures',[UserController::class,"u_lectures"])->name('u_lectures');
    Route::get('/u_lecture/{ID}',[UserController::class,"u_lecture"])->name('u_lecture');
    
    Route::get('/u_lecture_favorites',[UserController::class,"u_lecture_favorites"])->name('u_lecture_favorites');
    Route::get('/u_lecture_archived',[UserController::class,"u_lecture_archived"])->name('u_lecture_archived');
    Route::get('/u_lecture_favorite/{id}/{parameter}',[UserController::class,"u_lecture_favorite"])->name('u_lecture_favorite');
    Route::get('/u_lecture_archive/{id}/{parameter}',[UserController::class,"u_lecture_archive"])->name('u_lecture_archive');

    Route::put('/u_user_update', [UserController::class, 'u_user_update'])->name('u_user_update');
    Route::get('/u_reviews', [UserController::class, 'u_reviews'])->name('u_reviews');
    Route::get('/u_sub_details/{id}', [UserController::class, 'u_sub_details'])->name('u_sub_details');
    Route::get('/u_sub_remove/{id}', [UserController::class, 'u_sub_remove'])->name('u_sub_remove');
    Route::post('/leave_review', [UserController::class, 'leave_review'])->name('leave_review');
    Route::post('/u_update_review', [UserController::class, 'u_update_review'])->name('u_update_review');

    Route::get('/u_calendar', [UserController::class, 'u_calendar'])->name('u_calendar');
    Route::get('/u_calendar_event_form', [UserController::class, 'u_calendar_event_form'])->name('u_calendar_event_form');
    Route::post('/u_add_calendar_event_form', [UserController::class, 'u_add_calendar_event_form'])->name('u_add_calendar_event_form');
    Route::post('/u_add_comment', [UserController::class, 'u_add_comment'])->name('u_add_comment');
    Route::get('/u_membership', [UserController::class, 'u_membership'])->name('u_membership');
    Route::get('/u_notifications', [UserController::class, 'u_notifications'])->name('u_notifications');
    Route::post('/u_notification_mark_read', [UserController::class, 'u_notification_mark_read'])->name('u_notification_mark_read');

    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

    //pages
    Route::get('/', [MainController::class, 'home']);
    Route::get('/home', [MainController::class, 'home'])->name('home');
    Route::get('/lectures', [MainController::class, 'lectures'])->name('lectures');
    Route::get('/lectures_ajax', [MainController::class, 'lectures_ajax'])->name('lectures_ajax');
    Route::get('/lecture_details/{ID}', [MainController::class, 'lecture_details'])->name('lecture_details');

    Route::get('/about', [MainController::class, 'about'])->name('about');
    Route::get('/faq', [MainController::class, 'faq'])->name('faq');
    Route::get('/contact_us', [MainController::class, 'contact_us'])->name('contact_us');
    Route::post('/contact_request', [MainController::class, 'contact_request'])->name('contact_request');
    Route::get('/error',[AuthController::class,"error"])->name('error');
    Route::get('/membership', [MainController::class, 'membership'])->name('membership');
    Route::get('/quizzes', [MainController::class, 'quizzes'])->name('quizzes');
    Route::get('/private_policy', [MainController::class, 'private_policy'])->name('private_policy');
    Route::get('/score_board', [MainController::class, 'score_board'])->name('score_board');
    Route::get('/author', [MainController::class, 'author'])->name('author');
