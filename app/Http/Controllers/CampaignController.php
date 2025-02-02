<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Payout;
use Illuminate\Support\Facades\DB;

class CampaignController {

  public function getCampaigns(): \Illuminate\Http\JsonResponse
  {
    // Retrieve all campaigns with their payouts
    $campaigns = Campaign::with('payouts')->get();

    if ($campaigns->isEmpty()) {
      return response()->json(['message' => 'No campaigns found'], 200);
    }

    // Return the campaigns as JSON
    return response()->json($campaigns);
  }

  public function createCampaign(Request $request): \Illuminate\Http\JsonResponse
  {
    try {
      DB::beginTransaction(); // <= Starting the transaction

      $validated = $request->validate([
        'title' => 'required|string|max:255',
        'url' => 'required|url',
        'status' => 'required|string|in:active,paused',
        'payouts' => 'required|array',
        'payouts.*.country' => 'required|string|max:255',
        'payouts.*.amount' => 'required|numeric|min:5|max:99',
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
        
      DB::commit(); // <= Commit the changes

      return response()->json(['message' => 'Campaign created successfully'], 201);

    } catch (\Exception $e) {
        report($e);
        DB::rollBack(); // <= Rollback in case of an exception

        return response()->json(['message' => 'Failed to create campaign.'], 500);
    }
  }

  public function updateCampaign(Request $request, $id): \Illuminate\Http\JsonResponse
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

  public function deleteCampaign(int $id): \Illuminate\Http\JsonResponse
  {
    $campaign = Campaign::find($id);

    if (!$campaign) {
      return response()->json(['message' => 'Campaign not found', 404]);
    }

    $campaign->delete();

    return response()->json(['message' => 'Campaign deleted sucessfully'], 200);
  }
}
