<?php

namespace App\Models;

use App\Models\CoopEffectiveDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cooperative extends Model
{
    use HasFactory;
    public function CoopEffectiveDate()
    {
        return $this->hasMany(CoopEffectiveDate::class, 'fk_coop', 'id');
    }
}