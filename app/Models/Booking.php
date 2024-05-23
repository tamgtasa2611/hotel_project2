<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    public $timestamps = false;
    protected $fillable = [
        'date',
        'checkin',
        'checkout',
        'status',
        'total_price',
        'note',
        'guest_lname',
        'guest_fname',
        'guest_email',
        'guest_phone',
        'guest_id',
        'admin_id'
    ];

    public function roomTypes(): BelongsToMany
    {
        return $this->belongsToMany(RoomType::class)->withPivot('number_of_room');
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public static function getBookedRoomTypes(int|string $bookingId)
    {
        return DB::table('booked_room_types')->where('booking_id', '=', $bookingId)->get();
    }

    public static function getRoomTypes(int|string $bookingId)
    {
        return DB::table('booked_room_types')
            ->join('room_types', 'booked_room_types.room_type_id', '=', 'room_types.id')
            ->where('booking_id', '=', $bookingId)
            ->get();
    }

    public static function getBookedRooms(array $roomIds)
    {
        return DB::table('booked_rooms')
            ->join('rooms', 'booked_rooms.room_id', '=', 'rooms.id')
            ->join('bookings', 'bookings.id', '=', 'booked_rooms.booking_id')
            ->whereIn('room_id', $roomIds)
            ->get();
    }

    public static function getAllBookedRooms()
    {
        return DB::table('booked_rooms')
            ->join('bookings', 'bookings.id', '=', 'booked_rooms.booking_id')
            ->get();
    }

    public static function getBookedRoomsByBookingId(int|string $bookingId)
    {
        return DB::table('booked_rooms')
            ->join('rooms', 'booked_rooms.room_id', '=', 'rooms.id')
            ->where('booking_id', '=', $bookingId)
            ->get();
    }
}
