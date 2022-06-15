<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingMeter;

class ParkingMeterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParkingMeter::truncate();

        $csvFile = fopen(base_path("database/data/parking_meter_geo_dataset .csv"), "r");



        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {

                ParkingMeter::create([
                    "meter_no" => $data['0'],
                    "meter_type" => $data['1'],
                    "long" => $data['2'],
                    "lat" => $data['3'],
                    "status" => $data['4'] === 'Active' ? 1 : 0,
                    "borough" => $data['5'],
                ]);
            }

            $firstline = false;
        }



        fclose($csvFile);
    }
}
