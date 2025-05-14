<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookings extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'trip_id',
        'number_of_travelers',
        'special_requests',
        'status',
    ];

    /**
     * Relationship with Trip Model.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

}
