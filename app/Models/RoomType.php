<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomTypeImage::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class)->withPivot('number_of_room');
    }

    public static function checkAndGetRoomTypes(int $sort)
    {
        $orderBy = 'id';
        $direction = 'ASC';
        switch ($sort) {
            case 0:
                $direction = 'DESC';
                break;
            case 1:
                $orderBy = 'price';
                break;
            case 2:
                $orderBy = 'price';
                $direction = 'DESC';
                break;
        }
        return RoomType::with('rooms')
            ->orderBy($orderBy, $direction)
            ->paginate(4)
            ->withQueryString();
    }
}
