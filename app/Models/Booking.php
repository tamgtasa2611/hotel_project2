<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
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
