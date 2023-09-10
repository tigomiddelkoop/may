<?php

namespace Database\Seeders;

use App\Models\Fuel;
use App\Models\FuelType;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Gasonline fuels
        $gasolineCategory = FuelType::create([
            'id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
            'name' => 'GASOLINE',
        ]);
        $gasoline = [];

        $gasoline['e5'] = new Fuel();
        $gasoline['e5']->id = '1a9157a7-ae5f-4cf9-9883-c9d26c082cba';
        $gasoline['e5']->name = 'E5';
        $gasoline['e5']->description = 'This petrol contains 5% ethanol';
        $gasoline['e5']->fuelType()->associate($gasolineCategory);
        $gasoline['e5']->saveOrFail();

        $gasoline['e10'] = new Fuel();
        $gasoline['e10']->id = '9e3b4a6d-ec48-46a4-9a52-f5df3e9bc640';
        $gasoline['e10']->name = 'E10';
        $gasoline['e10']->description = 'This petrol contains 10% ethanol';
        $gasoline['e10']->fuelType()->associate($gasolineCategory);
        $gasoline['e10']->saveOrFail();

        $gasoline['e85'] = new Fuel();
        $gasoline['e85']->id = '706b6ced-713f-4419-b2c7-359ba4aa5561';
        $gasoline['e85']->name = 'E85';
        $gasoline['e85']->description = 'This petrol contains 85% ethanol';
        $gasoline['e85']->fuelType()->associate($gasolineCategory);
        $gasoline['e85']->saveOrFail();

        // Diesel fuels
        if (! app()->runningUnitTests()) {
            $dieselCategory = FuelType::create([
                'id' => '1863a211-23e8-45ea-b86c-3fc11a677065',
                'name' => 'DIESEL',
            ]);
            $diesel = [];

            $diesel['b7'] = new Fuel();
            $diesel['b7']->id = '56904832-5829-4d57-87ea-94a538c9b3dd';
            $diesel['b7']->name = 'B7';
            $diesel['b7']->description = 'This diesel contains 7% biodiesel';
            $diesel['b7']->fuelType()->associate($dieselCategory);
            $diesel['b7']->saveOrFail();

            $diesel['b10'] = new Fuel();
            $diesel['b10']->id = '16d5dced-d64c-479d-9ccc-698fcf089ba9';
            $diesel['b10']->name = 'B10';
            $diesel['b10']->description = 'This diesel contains 10% biodiesel';
            $diesel['b10']->fuelType()->associate($dieselCategory);
            $diesel['b10']->saveOrFail();

            $diesel['b20'] = new Fuel();
            $diesel['b20']->id = '9b12eec0-4328-4f09-95f1-1da55dae538d';
            $diesel['b20']->name = 'B20';
            $diesel['b20']->description = 'This diesel contains 20% biodiesel';
            $diesel['b20']->fuelType()->associate($dieselCategory);
            $diesel['b20']->saveOrFail();

            $diesel['b30'] = new Fuel();
            $diesel['b30']->id = '6cfe3b74-270f-4816-9374-530c7e2469e5';
            $diesel['b30']->name = 'B30';
            $diesel['b30']->description = 'This diesel contains 30% biodiesel';
            $diesel['b30']->fuelType()->associate($dieselCategory);
            $diesel['b30']->saveOrFail();

            $diesel['b100'] = new Fuel();
            $diesel['b100']->id = 'e646f3fc-82de-4178-92b0-122fffc11ca8';
            $diesel['b100']->name = 'B100';
            $diesel['b100']->description = 'This diesel is 100% biodiesel';
            $diesel['b100']->fuelType()->associate($dieselCategory);
            $diesel['b100']->saveOrFail();

            $diesel['xtl'] = new Fuel();
            $diesel['xtl']->id = '757c25e8-c811-4258-9492-03e11e30e38c';
            $diesel['xtl']->name = 'XTL';
            $diesel['xtl']->description = 'This diesel has not been made from crude oil';
            $diesel['xtl']->fuelType()->associate($dieselCategory);
            $diesel['xtl']->saveOrFail();
        }

        // Gaseous fuels
        if (! app()->runningUnitTests()) {
            $gaseousCategory = FuelType::create([
                'id' => '32a881af-cbf1-4449-933b-0661c59913f9',
                'name' => 'GASEOUS',
            ]);
            $gaseous = [];

            $gaseous['hydrogen'] = new Fuel();
            $gaseous['hydrogen']->id = '3e0cc9b9-19a7-4dfe-85a9-3670603047f0';
            $gaseous['hydrogen']->name = 'H20';
            $gaseous['hydrogen']->description = 'This fuel is made from water';
            $gaseous['hydrogen']->fuelType()->associate($gaseousCategory);
            $gaseous['hydrogen']->saveOrFail();

            $gaseous['lpg'] = new Fuel();
            $gaseous['lpg']->id = '9b854c2a-9a51-4566-b6ce-7f78709bf4fd';
            $gaseous['lpg']->name = 'LPG';
            $gaseous['lpg']->description = 'Liquefied petroleum gas';
            $gaseous['lpg']->fuelType()->associate($gaseousCategory);
            $gaseous['lpg']->saveOrFail();

            $gaseous['lng'] = new Fuel();
            $gaseous['lng']->id = '5a72a232-f2bf-4c3a-b93d-85c418e8ae04';
            $gaseous['lng']->name = 'LNG';
            $gaseous['lng']->description = 'Liquefied natural gas';
            $gaseous['lng']->fuelType()->associate($gaseousCategory);
            $gaseous['lng']->saveOrFail();

            $gaseous['cng'] = new Fuel();
            $gaseous['cng']->id = '4c8943d4-1636-43bc-974c-5c117bd49bbd';
            $gaseous['cng']->name = 'CNG';
            $gaseous['cng']->description = 'Compressed natural gas';
            $gaseous['cng']->fuelType()->associate($gaseousCategory);
            $gaseous['cng']->saveOrFail();
        }

        // Electric fuels
        if (! app()->runningUnitTests()) {
            $electricCategory = FuelType::create([
                'id' => '7542c53c-0713-421c-aca8-348df2568385',
                'name' => 'ELECTRIC',
            ]);

            $electric = new Fuel();
            $electric->id = '49e7196b-92ef-4ca2-8e64-7d46356a76fe';
            $electric->name = 'Electric';
            $electric->description = 'This fuel type uses the electricity grid';
            $electric->fuelType()->associate($electricCategory);
            $electric->saveOrFail();
        }
    }
}
