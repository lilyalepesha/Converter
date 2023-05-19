<?php

namespace Database\Seeders;

use App\Models\Zip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zip::factory()->count(10000)->create();
    }
}
