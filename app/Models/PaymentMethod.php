<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payment_method';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
