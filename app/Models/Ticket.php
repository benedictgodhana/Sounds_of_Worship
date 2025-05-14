<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // app/Models/Ticket.php
protected $fillable = [
    'event_id',
    'full_name',
    'email',
    'phone',
    'ticket_type',
    'quantity',
    'total_price',
    'payment_status',
    'transaction_id'
];



protected static function booted()
{
    static::creating(function ($ticket) {
        $ticket->ticket_number = 'TICKET-' . strtoupper(uniqid());
    });
}

public function event()
{
    return $this->belongsTo(Event::class);
}


protected static function boot()
{
    parent::boot();
    static::creating(function ($ticket) {
        $ticket->ticket_number = $ticket->ticket_number ?? 'TICKET-' . strtoupper(bin2hex(random_bytes(5)));
    });
}
}
