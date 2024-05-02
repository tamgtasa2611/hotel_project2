<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    public $timestamps = false;
    protected $fillable = [
        'created_date',
        'status',
        'guest_id',
        'room_id',
        'admin_id',
        'checkin_date',
        'checkout_date',
        'guest_num',
        'total_price',
        'note'
    ];

    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
