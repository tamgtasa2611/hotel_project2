<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $limit = 150;

        $status = array(0, 0, 0, 0, 1);
        $roomType = array(1, 1, 2, 2, 3, 3, 4, 4, 5);

        for ($i = 100; $i < $limit; $i++) {
            DB::table('rooms')->insert([
                'name' => 'P' . ($i + 1),
                'status' => $status[array_rand($status, 1)],
                'room_type_id' => $roomType[array_rand($roomType, 1)],
                'deleted_at' => null,
            ]);
        }
    }
}
