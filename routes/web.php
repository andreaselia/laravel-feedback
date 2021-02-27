<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ShowFeedbackDashboard')->name('feedback.dashboard');
Route::post('/', 'StoreFeedbackSubmission')->name('feedback.store');
