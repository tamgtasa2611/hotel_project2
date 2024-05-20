<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rooms';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'status',
        'room_type_id'
    ];

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class);
    }

    public static function roomSort(int $sort)
    {
        switch ($sort) {
            case 0:
                return [
                    'by' => 'id',
                    'direction' => 'ASC'
                ];
            case 1:
                return [
                    'by' => 'id',
                    'direction' => 'ASC'
                ];
            case 2:
                return [
                    'by' => 'id',
                    'direction' => 'DESC'
                ];
            case 3:

                return [
                    'by' => 'room_types.base_price',
                    'direction' => 'ASC'
                ];
            case 4:
                return [
                    'by' => 'room_types.base_price',
                    'direction' => 'DESC'
                ];
        }
    }

    public static function getRooms(array $search, array $price, array $type, int $sort)
    {
        //            format lai tu d-m-y thanh y-m-d
        $checkInDate = date('Y-m-d', strtotime($search['checkin']));
        $checkOutDate = date('Y-m-d', strtotime($search['checkout']));
        $dateIn = Carbon::createFromFormat('Y-m-d', $checkInDate);
        $dateOut = Carbon::createFromFormat('Y-m-d', $checkOutDate);

        //check trung lich
        $bookings = Booking::with('room')->get();
        //luu id cua rooms da dat truoc
        $alreadyBookedRoomId = [];
        foreach ($bookings as $booking) {
            $dateInCheck = Carbon::createFromFormat('Y-m-d', $booking->checkin_date);
            $dateOutCheck = Carbon::createFromFormat('Y-m-d', $booking->checkout_date);
            if ($dateIn->between($dateInCheck, $dateOutCheck) || $dateOut->between($dateInCheck, $dateOutCheck)) {
                $alreadyBookedRoomId[] = $booking->room_id;
            }
        }

        $order = Room::roomSort($sort);
        return Room::with('roomType')->with('images')
//            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
//            ->select('rooms.*', 'room_types.base_price')
//            ->where('bed_size', '>=', $search['guest_num'] ?? 1)
            ->whereNotIn('rooms.id', $alreadyBookedRoomId)
            ->whereBetween('rooms.price', [$price['from_price'], $price['to_price']])
//            ->whereIn('room_type_id', $type)
            ->orderBy($order['by'], $order['direction']);
    }

    public static function getRoomsWithBooking()
    {
        return DB::table('booked_rooms')
            ->rightJoin('rooms', 'rooms.id', '=', 'booked_rooms.room_id')
            ->leftJoin('bookings', 'bookings.id', '=', 'booked_rooms.booking_id')
            ->where('rooms.status', '=', 0)
            ->get();
    }
}
