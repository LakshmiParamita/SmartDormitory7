<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;

class BuildingSeeder extends Seeder
{
    public function run()
    {
        $buildings = [
            ['name' => 'Gedung 1', 'floor' => 1],
            ['name' => 'Gedung 2', 'floor' => 1],
            ['name' => 'Gedung 3', 'floor' => 1],
            ['name' => 'Gedung 4', 'floor' => 1],
            ['name' => 'Gedung 5', 'floor' => 1],
            ['name' => 'Gedung 6', 'floor' => 1],
            ['name' => 'Gedung 7', 'floor' => 1],
            ['name' => 'Gedung 8', 'floor' => 1],
            ['name' => 'Gedung 9', 'floor' => 1],
            ['name' => 'Gedung 10', 'floor' => 1],
            ['name' => 'Gedung 11', 'floor' => 1],
            ['name' => 'Gedung 12', 'floor' => 1],
            ['name' => 'Gedung A', 'floor' => 1],
            ['name' => 'Gedung B', 'floor' => 1],
            ['name' => 'Gedung C', 'floor' => 1],
            ['name' => 'Gedung D', 'floor' => 1],
            ['name' => 'Gedung E', 'floor' => 1],
            ['name' => 'Gedung F', 'floor' => 1],
        ];

        foreach ($buildings as $building) {
            Building::create($building);
        }
    }
}