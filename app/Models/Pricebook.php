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
            $query->where('pricebooks.Name', 'like', $term)
                ->orWhere('pricebooks.SKU', 'like', $term);
        });
    }

    public function scopeCategory($query, $category)
    {
        if ($category ?? false) {
            $query->where('fk_category', '=', $category);
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