<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;
    protected $table = 'brands';
    public $primaryKey = 'id';
    protected $fillable = [
        'brand_name',
        'is_deleted'
    ];
    public $timestamps = true;
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
