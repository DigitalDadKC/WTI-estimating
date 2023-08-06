<?php

namespace Database\Seeders;

use App\Models\Pricebook;
use Illuminate\Database\Seeder;
use App\Models\MaterialCategory;
use App\Models\MaterialUnitSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PricebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/material_unit_size.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                MaterialUnitSize::create([
                    "Unit_Size" => $data['0']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        $csvFile = fopen(base_path("database/material_category.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                MaterialCategory::create([
                    "Name" => $data['0']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        Pricebook::truncate();
        $csvFile = fopen(base_path("database/pricebook.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, null, ",")) !== false) {
            if (!$firstline) {
                Pricebook::create([
                    "SKU" => $data['0'],
                    "Name" => $data['1'],
                    "fk_unit_size" => $data['2'],
                    "PB_FY24_1" => ($data['3'] !== 'NULL') ? $data['3'] : NULL,
                    "PB_FY24_1_Status" => ($data['4'] !== 'NULL') ? $data['4'] : NULL,
                    "PB_FY23_3" => ($data['5'] !== 'NULL') ? $data['5'] : NULL,
                    "PB_FY23_3_Status" => ($data['6'] !== 'NULL') ? $data['6'] : NULL,
                    "Discountable" => $data['7'],
                    "fk_category" => $data['8']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }


}