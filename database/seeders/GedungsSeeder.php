<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gedung;

class GedungsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gedung::create(['name' => 'Gedung 1']);
        Gedung::create(['name' => 'Gedung 2']);
        Gedung::create(['name' => 'Gedung 3']);
        Gedung::create(['name' => 'Gedung 4']);
        Gedung::create(['name' => 'Gedung 5']);
        Gedung::create(['name' => 'Gedung 6']);
        Gedung::create(['name' => 'Gedung 7']);
        Gedung::create(['name' => 'Gedung 8']);
        Gedung::create(['name' => 'Gedung 9']);
        Gedung::create(['name' => 'Gedung 10']);
        Gedung::create(['name' => 'Gedung 11']);
        Gedung::create(['name' => 'Gedung 12']);
        Gedung::create(['name' => 'Gedung A']);
        Gedung::create(['name' => 'Gedung B']);
        Gedung::create(['name' => 'Gedung C']);
        Gedung::create(['name' => 'Gedung D']);
        Gedung::create(['name' => 'Gedung E']);
        Gedung::create(['name' => 'Gedung F']);
    }
}

// cara jalanin seeder:
// php artisan db:seed --class=GedungsSeeder