<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CooperativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'Cooperative',
            'UnitOfMeasurement',
            'CoopCategory',
            'CoopEffectiveDate',
            'CoopAepaLine',
            'CoopEiLine',
            'CoopOmniaLine'
        ];
        foreach ($models as $model) {
            $path = 'database/seeders/sql/' . Str::of(strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $model)))->plural() . '.sql';
            DB::unprepared(file_get_contents($path));
            $this->command->info($model . ' Model Seeded!');
        }
    }
}