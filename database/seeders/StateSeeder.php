<?php

namespace Database\Seeders;

use App\Models\Cooperative;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::truncate();
        $csvFile = fopen(base_path("database/state.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                State::create([
                    "State" => $data['0'],
                    "AEPA_NPW" => $data['1'],
                    "AEPA_PW" => $data['2'],
                    "EI" => $data['3'],
                    "OMNIA" => $data['4'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        Cooperative::truncate();
        $csvFile = fopen(base_path("database/cooperatives.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                Cooperative::create([
                    "Name" => $data['0'],
                    "Contract_No" => ($data['1'] !== "NULL") ? $data['1'] : NULL,
                    "Award_Date" => ($data['2'] !== "NULL") ? $data['2'] : NULL,
                    "End_Date" => ($data['3'] !== "NULL") ? $data['3'] : NULL,
                    "Admin_Fee" => ($data['4'] !== "NULL") ? $data['4'] : NULL,
                    "Discount" => ($data['5'] !== "NULL") ? $data['5'] : NULL,
                    "Freight_Free" => $data['6'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}