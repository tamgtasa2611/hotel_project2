<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'activities';
    public $timestamps = false;
    protected $fillable = [
        'detail',
        'date',
        'admin_id'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public static function saveActivity(int $id, string $detail)
    {
        $adminName = Admin::where('id', '=', $id)->first()->first_name;
        Activity::create([
            'detail' => 'Admin ' . $adminName . ' ' . $detail,
            'date' => date('Y-m-d H:i:s'),
            'admin_id' => $id,
        ]);
    }
}
