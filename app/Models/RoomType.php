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
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public static function getRoomTypes(object $roomList)
    {
        $roomTypeIdWithRoom = [];
        foreach ($roomList as $room) {
            if (in_array($room->room_type_id, $roomTypeIdWithRoom)) {
                continue;
            } else {
                $roomTypeIdWithRoom[] = $room->room_type_id;
            }
        }
        return RoomType::with('rooms')
            ->whereIn('id', $roomTypeIdWithRoom)
            ->get();
    }
}
