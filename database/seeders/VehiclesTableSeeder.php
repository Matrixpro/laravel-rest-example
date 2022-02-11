<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
		Vehicle::truncate();

		$vehicles_csv = storage_path('app/vehicles/vehicles.csv');
		$rows = array_map('str_getcsv', file($vehicles_csv));
		$header = array_shift($rows);
		
		$vehicles_arr = [];
		
		foreach ($rows as $row)
			$vehicles_arr[] = array_combine($header, $row);
		
		foreach ($vehicles_arr as $vehicle_arr) {
			$vehicle = Vehicle::create([
            'make' => $vehicle_arr['make'],
            'year' => $vehicle_arr['year'],
            'model' => $vehicle_arr['model'],
            'type' => $faker->randomElement(['used','new']),
            'msrp' => $faker->randomFloat(2, 0, 100000),
            'miles' => $faker->randomNumber(),
            'vin' => $faker->randomNumber(),
        ]);
		}
    }
}
