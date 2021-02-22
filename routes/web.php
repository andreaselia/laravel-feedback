<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FeedbackController')->name('feedback.dashboard');
Route::post('/', 'FeedbackSubmissionController')->name('feedback.store');
