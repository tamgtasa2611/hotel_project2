<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'food_items';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public function foodOrders(): HasMany
    {
        return $this->hasMany(FoodOrder::class);
    }
}
