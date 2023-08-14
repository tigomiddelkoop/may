<?php

namespace Database\Seeders;

use App\Models\FuelCategory;
use App\Models\Fuel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $gasolineCategory = FuelCategory::create(['name' => 'GASOLINE']);
        $dieselCategory = FuelCategory::create(['name' => 'DIESEL']);
        $gaseousCategory = FuelCategory::create(['name' => 'GASEOUS']);
        $electricCategory = FuelCategory::create(['name' => 'ELECTRIC']);

        $gasoline = array();
        $diesel = array();
        $gaseous = array();

        $gasoline['e5'] = new Fuel();
        $gasoline['e5']->name = 'E5';
        $gasoline['e5']->description = 'This petrol contains 5% ethanol';
        $gasoline['e5']->fuelCategory()->associate($gasolineCategory);
        $gasoline['e5']->save();

        $gasoline['e10'] = new Fuel();
        $gasoline['e10']->name = 'E10';
        $gasoline['e10']->description = 'This petrol contains 10% ethanol';
        $gasoline['e10']->fuelCategory()->associate($gasolineCategory);
        $gasoline['e10']->save();

        $gasoline['e85'] = new Fuel();
        $gasoline['e85']->name = 'E85';
        $gasoline['e85']->description = 'This petrol contains 85% ethanol';
        $gasoline['e85']->fuelCategory()->associate($gasolineCategory);
        $gasoline['e85']->save();

        $diesel['b7'] = new Fuel();
        $diesel['b7']->name = 'B7';
        $diesel['b7']->description = 'This diesel contains 7% biodiesel';
        $diesel['b7']->fuelCategory()->associate($dieselCategory);
        $diesel['b7']->save();

        $diesel['b10'] = new Fuel();
        $diesel['b10']->name = 'B10';
        $diesel['b10']->description = 'This diesel contains 10% biodiesel';
        $diesel['b10']->fuelCategory()->associate($dieselCategory);
        $diesel['b10']->save();

        $diesel['b20'] = new Fuel();
        $diesel['b20']->name = 'B20';
        $diesel['b20']->description = 'This diesel contains 20% biodiesel';
        $diesel['b20']->fuelCategory()->associate($dieselCategory);
        $diesel['b20']->save();

        $diesel['b30'] = new Fuel();
        $diesel['b30']->name = 'B30';
        $diesel['b30']->description = 'This diesel contains 30% biodiesel';
        $diesel['b30']->fuelCategory()->associate($dieselCategory);
        $diesel['b30']->save();

        $diesel['b100'] = new Fuel();
        $diesel['b100']->name = 'B100';
        $diesel['b100']->description = 'This diesel is 100% biodiesel';
        $diesel['b100']->fuelCategory()->associate($dieselCategory);
        $diesel['b100']->save();

        $diesel['xtl'] = new Fuel();
        $diesel['xtl']->name = 'XTL';
        $diesel['xtl']->description = 'This diesel has not been made from crude oil';
        $diesel['xtl']->fuelCategory()->associate($dieselCategory);
        $diesel['xtl']->save();


        $gaseous['hydrogen'] = new Fuel();
        $gaseous['hydrogen']->name = 'H20';
        $gaseous['hydrogen']->description = 'This fuel is made from water';
        $gaseous['hydrogen']->fuelCategory()->associate($gaseousCategory);
        $gaseous['hydrogen']->save();

        $gaseous['lpg'] = new Fuel();
        $gaseous['lpg']->name = 'LPG';
        $gaseous['lpg']->description = 'Liquefied petroleum gas';
        $gaseous['lpg']->fuelCategory()->associate($gaseousCategory);
        $gaseous['lpg']->save();

        $gaseous['lng'] = new Fuel();
        $gaseous['lng']->name = 'LNG';
        $gaseous['lng']->description = 'Liquefied natural gas';
        $gaseous['lng']->fuelCategory()->associate($gaseousCategory);
        $gaseous['lng']->save();

        $gaseous['cng'] = new Fuel();
        $gaseous['cng']->name = 'CNG';
        $gaseous['cng']->description = 'Compressed natural gas';
        $gaseous['cng']->fuelCategory()->associate($gaseousCategory);
        $gaseous['cng']->save();

        $electric = new Fuel;
        $electric->name = 'Electric';
        $electric->description = 'This fuel type uses the electricity grid';
        $electric->fuelCategory()->associate($electricCategory);
        $electric->save();
    }
}
