<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Http\Controllers\CampaignController;

class CampaignController extends Controller {
// Get all campaigns

 /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $campaigns = Campaign::all();
    // Return the campaigns as JSON
    return response()->json($campaigns);
  }
}
