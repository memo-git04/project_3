<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory;
    protected $table = 'product_variants';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'stock_quantity',
        'price',
    ];
    public $timestamps = true;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'product_variant_id', 'id');
    }
}
