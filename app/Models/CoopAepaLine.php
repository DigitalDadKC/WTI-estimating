<?php

namespace App\Models;

use App\Models\CoopCategory;
use App\Models\UnitOfMeasurement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoopAepaLine extends Model
{
    use HasFactory;
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('coop_aepa_lines.Line', 'like', $term)
                ->orWhere('coop_aepa_lines.Description', 'like', $term);
        });
    }
    public function scopeCategory($query, $category, $state)
    {
        if ($state != 53) {
            if ($category ?? false) {
                $query->where('fk_category', '=', $category)->where('fk_category', '!=', 12);
            } else {
                $query->where('fk_category', '!=', 12);
            }
        } else {
            if ($category ?? false) {
                $query->where('fk_category', '=', $category);
            }
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
}