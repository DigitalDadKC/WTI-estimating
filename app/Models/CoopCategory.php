<?php

namespace App\Models;

use App\Models\CoopAepaLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoopCategory extends Model
{
    use HasFactory;
    protected $table = 'coop_categories';
    protected $primaryKey = 'id';
    public function CoopAepaLines()
    {
        return $this->hasMany(CoopAepaLine::class, 'fk_category', 'id');
    }
}