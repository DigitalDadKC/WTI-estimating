<?php

namespace App\Models;

use App\Livewire\Cooperatives;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoopEffectiveDate extends Model
{
    use HasFactory;
    public function Cooperatives()
    {
        return $this->belongsTo(Cooperatives::class, 'id', 'fk_coop');
    }
}