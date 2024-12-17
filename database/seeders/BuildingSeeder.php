<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Building;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BuildingSeeder::class);
        DB::table('buildings')->insert([
            [
                'name' => 'Gedung 1',
                'floor' => 'Lantai 1',
                'cctv_url' => 'video1.mp4',
            ],
            [
                'name' => 'Gedung 2',
                'floor' => 'Lantai 2',
                'cctv_url' => 'video2.mp4',
            ],
            [
                'name' => 'Gedung 3',
                'floor' => 'Lantai 3',
                'cctv_url' => 'video3.mp4',
            ],
            [
                'name' => 'Gedung 4',
                'floor' => 'Lantai 4',
                'cctv_url' => 'video4.mp4',
            ],
            [
                'name' => 'Gedung 5',
                'floor' => 'Lantai 5',
                'cctv_url' => 'video5.mp4',
            ],
        ]);
    }
}

