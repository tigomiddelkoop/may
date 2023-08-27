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
        $small_repair->saveOrFail();

        $big_repair = new ActivityCategory();
        $big_repair->name = 'Big Repair';
        $big_repair->saveOrFail();

        $big_repair = new ActivityCategory();
        $big_repair->name = 'Annual Checkup';
        $big_repair->saveOrFail();

        $cleaning = new ActivityCategory();
        $cleaning->name = 'Cleaning';
        $cleaning->saveOrFail();

        $tyre_air = new ActivityCategory();
        $tyre_air->name = 'Tyre air';
        $tyre_air->saveOrFail();
    }
}
