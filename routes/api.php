<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;

// returns the home page with all posts
Route::get('/campaigns', [CampaignController::class, 'index']);
