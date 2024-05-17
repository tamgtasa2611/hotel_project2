<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class RoomType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'room_types';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'max_capacity',
        'description'
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomTypeImage::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public static function checkAndGetRoomTypes()
    {
        return RoomType::with('rooms')->paginate(4)->withQueryString();
    }
}
