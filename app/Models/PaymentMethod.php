<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
