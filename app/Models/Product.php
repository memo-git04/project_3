<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_name',
        'category_id',
        'brand_id',
        'material_id',
        'origin_id',
        'description',
        'base_price',
        'is_deleted',
    ];
    public $timestamps = true;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }
    public function origin()
    {
        return $this->belongsTo(Origin::class, 'origin_id', 'id');
    }
    public function productVariants()
    {
        return $this->hasMany(Product_variant::class, 'product_id', 'id');
    }
}
