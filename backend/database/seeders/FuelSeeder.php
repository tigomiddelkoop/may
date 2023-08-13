<?php

namespace Database\Seeders;

use App\Models\Fuels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gasoline = array();
        $diesel = array();
        $gaseous = array();

        $gasoline['e5'] = Fuels::create(['name' => 'E5', 'type' => 'GASOLINE', 'description' => 'This petrol contains 5% ethanol']);
        $gasoline['e10'] = Fuels::create(['name' => 'E10', 'type' => 'GASOLINE', 'description' => 'This petrol contains 10% ethanol']);
        $gasoline['e85'] = Fuels::create(['name' => 'E85', 'type' => 'GASOLINE', 'description' => 'This petrol contains 85% ethanol']);

        $diesel['b7'] = Fuels::create(['name' => 'B7', 'type' => 'DIESEL', 'description' => 'This diesel contains 7% biodiesel']);
        $diesel['b10'] = Fuels::create(['name' => 'B10', 'type' => 'DIESEL', 'description' => 'This diesel contains 10% biodiesel']);
        $diesel['b20'] = Fuels::create(['name' => 'B20', 'type' => 'DIESEL', 'description' => 'This diesel contains 20% biodiesel']);
        $diesel['b30'] = Fuels::create(['name' => 'B30', 'type' => 'DIESEL', 'description' => 'This diesel contains 30% biodiesel']);
        $diesel['b100'] = Fuels::create(['name' => 'B100', 'type' => 'DIESEL', 'description' => 'This diesel contains 100% biodiesel']);
        $diesel['xtl'] = Fuels::create(['name' => 'XTL', 'type' => 'DIESEL', 'description' => 'This diesel has not been made from crude oil']);

        $gaseous['hydrogen'] = Fuels::create(['name' => 'Hydrogen', 'type' => 'GASEOUS', 'description' => 'This fuel is made from water']);
        $gaseous['lpg'] = Fuels::create(['name' => 'LPG', 'type' => 'GASEOUS', 'description' => 'Liquefied petroleum gas']);
        $gaseous['lng'] = Fuels::create(['name' => 'LNG', 'type' => 'GASEOUS', 'description' => 'Liquefied natural gas']);
        $gaseous['cng'] = Fuels::create(['name' => 'CNG', 'type' => 'GASEOUS', 'description' => 'Compressed natural gas']);

        $electric = Fuels::create(['name' => 'Electric', 'type' => 'ELECTRIC', 'description' => 'This fuel type uses the electricity grid']);
    }
}
