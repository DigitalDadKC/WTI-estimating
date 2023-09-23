<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\Cooperative;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'States',
        ];
        foreach ($models as $model) {
            $path = 'database/seeders/sql/' . strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $model)) . '.sql';
            DB::unprepared(file_get_contents($path));
            $this->command->info($model . ' Model Seeded!');
        }
    }
}