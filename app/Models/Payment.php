<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    public $timestamps = false;
    protected $fillable = [
        'date',
        'amount',
        'note',
        'status',
        'guest_id',
        'booking_id',
        'method_id'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
