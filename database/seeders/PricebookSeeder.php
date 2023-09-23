<?php

namespace Database\Seeders;

use App\Models\Pricebook;
use Illuminate\Database\Seeder;
use App\Models\MaterialCategory;
use App\Models\MaterialUnitSize;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PricebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'MaterialCategory',
            'MaterialUnitSize',
            'Pricebook'
        ];
        foreach ($models as $model) {
            $path = 'database/seeders/sql/' . strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $model)) . '.sql';
            DB::unprepared(file_get_contents($path));
            $this->command->info($model . ' Model Seeded!');
        }
    }


}