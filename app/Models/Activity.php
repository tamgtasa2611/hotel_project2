<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public static function deleteByDate($date)
    {
        switch ($date) {
            case 'day':
                $date = [
                    Carbon::now()->startOfDay(),
                    Carbon::now()->endOfDay()
                ];
                break;
            case 'week':
                $date = [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ];
                break;
            case 'month':
                $date = [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ];
                break;
            case 'all':
                $date = [
                    Carbon::now()->startOfCentury(),
                    Carbon::now()->endOfCentury()
                ];
                break;
        }

        return Activity::whereBetween('date', $date)->delete();
    }
}