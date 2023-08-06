<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialUnitSize extends Model
{
    use HasFactory;
    protected $table = 'material_unit_sizes';
    protected $primaryKey = 'id';
    public function pricebook()
    {
        return $this->hasMany(Pricebook::class, 'fk_unit_size', 'id');
    }
}