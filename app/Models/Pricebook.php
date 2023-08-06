<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricebook extends Model
{
    use HasFactory;

    protected $table = 'pricebooks';
    protected $primaryKey = 'id';
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('Pricebooks.Name', 'like', $term)
                ->orWhere('Pricebooks.SKU', 'like', $term);
        });
    }

    public function scopeCategoryFilter($query, $categories = [])
    {
        if ($categories ?? false) {
            $query->whereIn('fk_category', request('filter-checkbox'));
        }
    }
    public function materialUnitSizes()
    {
        return $this->belongsTo(MaterialUnitSize::class, 'fk_unit_size', 'id');
    }
    public function materialCategories()
    {
        return $this->belongsTo(MaterialCategory::class, 'fk_category', 'id');
    }
}