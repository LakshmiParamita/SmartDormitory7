<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnlockingRecord;

class UnlockingRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnlockingRecord::create(['timestamp' => now(), 'activity' => 'Pintu berhasil dibuka oleh Arya Anggadipa Manova.']);
        UnlockingRecord::create(['timestamp' => now(), 'activity' => 'Pintu gagal dibuka.']);
        UnlockingRecord::create(['timestamp' => now(), 'activity' => 'Pintu gagal dibuka.']);
    }
}

// cara jalanin seeder:
// php artisan db:seed --class=UnlockingRecordSeeder