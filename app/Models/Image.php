<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_variant_id',
        'url',
        'is_primary',
        'is_deleted',
    ];
    public $timestamps = true;
    public function productVariant()
    {
        return $this->belongsTo(Product_variant::class, 'product_variant_id', 'id');
    }
}
