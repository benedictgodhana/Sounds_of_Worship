<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'description',
        'price',
        'image_url',
        'stock_quantity',
        'metadata',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'metadata' => 'array',
        'is_available' => 'boolean',
    ];

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event associated with the product.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }


    public function getMetadataAttribute($value)
    {
        return json_decode($value, true);  // Decode JSON into an array
    }

    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);  // Encode array to JSON before saving
    }
}
