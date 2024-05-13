<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomTypeImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'room_type_image';
    public $timestamps = false;
    protected $fillable = [
        'path',
        'room_type_id',
    ];

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }
}
