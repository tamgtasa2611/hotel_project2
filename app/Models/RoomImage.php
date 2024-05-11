<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'room_images';
    public $timestamps = false;
    protected $fillable = [
        'path',
        'room_id',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
