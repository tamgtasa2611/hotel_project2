<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

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
