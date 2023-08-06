<?php

namespace App\Models;

use App\Models\CoopAepaLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitOfMeasurement extends Model
{
    use HasFactory;
    protected $table = 'unit_of_measurement';
    protected $primaryKey = 'id';
    public function CoopAepaLines()
    {
        return $this->hasMany(CoopAepaLine::class, 'fk_UOM', 'id');
    }
}