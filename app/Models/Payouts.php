<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payouts extends Model
{
    // Disable created_at & updated_at
    public $timestamps = false; 

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
    *
    * @var list<string>
    */
    protected $fillable = [
        'campaign_id',
        'country',
        'amount'
    ];

    // Define the inverse relationship to Campaign
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
