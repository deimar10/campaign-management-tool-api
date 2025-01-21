<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
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
        'title',
        'url',
        'status',
    ];

    // Define the relationship to Payouts
    public function payouts()
    {
        return $this->hasMany(Payouts::class, 'campaign_id');
    }
}
