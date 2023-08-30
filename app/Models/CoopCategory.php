<?php

namespace App\Models;

use App\Models\CoopEiLine;
use App\Models\CoopAepaLine;
use App\Models\CoopOmniaLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoopCategory extends Model
{
    use HasFactory;
    protected $table = 'coop_categories';
    protected $primaryKey = 'id';
    public function scopeCafilter($query, $state)
    {
        ($state != 53) ? $query->whereNot('id', 12) : $query;
    }
    public function CoopAepaLines()
    {
        return $this->hasMany(CoopAepaLine::class, 'fk_category', 'id');
    }
    public function CoopEiLines()
    {
        return $this->hasMany(CoopEiLine::class, 'fk_category', 'id');
    }
    public function CoopOmniaLines()
    {
        return $this->hasMany(CoopOmniaLine::class, 'fk_category', 'id');
    }
}