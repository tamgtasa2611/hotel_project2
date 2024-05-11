<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employees';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'role',
        'image',
    ];
}
