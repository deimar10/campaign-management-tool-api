<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;

// returns the campagins JSON with payouts
Route::get('/campaigns', [CampaignController::class, 'getCampaigns']);
// creates campaign with payout(s)
Route::post('/campaigns/create', [CampaignController::class, 'createCampaign']);
// update campaign status based on selected id
Route::put('/campaigns/{campaign}', [CampaignController::class, 'updateCampaign']);
// delete campaign based on id
Route::delete('/campaigns/{campaign}', [CampaignController::class, 'deleteCampaign']);