<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Payout;

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

  /**
   * Create a new campaign with payouts
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function createCampaign(Request $request)
  {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'url' => 'required|url',
        'status' => 'required|string|in:active,paused',
        'payouts' => 'required|array',
        'payouts.*.country' => 'required|string|max:255',
        'payouts.*.amount' => 'required|numeric|min:5',
    ]);

    // Convert status to integer
    $status = $validated['status'] === 'active' ? 1 : 0;

    // Create the campaign
    $campaign = Campaign::create([
        'title' => $validated['title'],
        'url' => $validated['url'],
        'status' => $status,
    ]);

    // Add payouts
    foreach ($validated['payouts'] as $payout) {
        $campaign->payouts()->create($payout);
    }

    return response()->json(['message' => 'Campaign created successfully'], 201);
  }

  /**
   * Update the specified campaign status.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateCampaign(Request $request, $id)
  {
    $validated = $request->validate([
      'status' => 'required|string|in:active,paused',
    ]);

    // Convert status to integer
    $status = $validated['status'] === 'active' ? 1 : 0;

    $campaign = Campaign::find($id);
    $campaign->status = $status;
    $campaign->save();

    return response()->json(['message' => 'Campaign status changed successfully'], 200);
  }
}
