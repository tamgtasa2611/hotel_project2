<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'services';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
