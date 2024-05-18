<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Amenity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'amenities';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function roomTypes(): BelongsToMany
    {
        return $this->belongsToMany(RoomType::class);
    }

    public static function insertToRoomTypeAmenities($roomTypeId, $amenityId)
    {
        DB::table('room_type_amenities')->insert([
            'room_type_id' => $roomTypeId,
            'amenity_id' => $amenityId
        ]);
        return null;
    }

    public static function getRoomTypeAmenities($roomTypeId)
    {
        return DB::table('room_type_amenities')
            ->select('amenity_id')
            ->where('room_type_id', $roomTypeId)
            ->get();
    }

    public static function destroyRoomTypeAmenities($roomTypeId, $amenityId)
    {
        DB::table('room_type_amenities')
            ->where('room_type_id', $roomTypeId)
            ->where('amenity_id', $amenityId)
            ->delete();
        return null;
    }
}
