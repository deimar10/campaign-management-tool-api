<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller {
  // Get all campaigns with payouts

 /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getCampaigns()
  {
    // Retrieve all campaigns with their payouts
    $campaigns = Campaign::with('payouts')->get();
    // Return the campaigns as JSON
    return response()->json($campaigns);
  }
}
