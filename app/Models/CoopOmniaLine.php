<?php

namespace App\Models;

use App\Models\CoopCategory;
use App\Models\UnitOfMeasurement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoopOmniaLine extends Model
{
    use HasFactory;
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('coop_omnia_lines.Line', 'like', $term)
                ->orWhere('coop_omnia_lines.Description', 'like', $term);
        });
    }
    public function scopeCategory($query, $category)
    {
        if ($category ?? false) {
            $query->where('fk_category', '=', $category);
        }
    }
    public function coopCategories()
    {
        return $this->belongsTo(CoopCategory::class, 'fk_category', 'id');
    }
    public function unitOfMeasurements()
    {
        return $this->belongsTo(UnitOfMeasurement::class, 'fk_UOM', 'id');
    }
    public function coopEffectiveDates()
    {
        return $this->hasMany(CoopEffectiveDate::class, 'fk_coop', 'id');
    }
}