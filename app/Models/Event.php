<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', // Ensure this is fillable
        'name',
        'description',
        'event_date',
        'location',
        'event_image',
        'is_featured',
        'is_paid', // Added field
        'ticket_categories', // Added field (JSON)
        'capacity', // Add capacity
        'tickets_sold', // Add tickets sold
        'status', // Add status
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'datetime',
        'base_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_paid' => 'boolean',
        'ticket_categories' => 'array', // Cast JSON to array
    ];

    /**
     * Get the user who created the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
