<?php

namespace Database\Seeders;

use App\Models\ActivityCategory;
use Illuminate\Database\Seeder;

class ActivityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $small_repair = new ActivityCategory();
        $small_repair->name = 'Small Repair';
        $small_repair->save();

        $big_repair = new ActivityCategory();
        $big_repair->name = 'Big Repair';
        $big_repair->save();

        $cleaning = new ActivityCategory();
        $cleaning->name = 'Cleaning';
        $cleaning->save();

        $tyre_air = new ActivityCategory();
        $tyre_air->name = 'Tyre air';
        $tyre_air->save();
    }
}
