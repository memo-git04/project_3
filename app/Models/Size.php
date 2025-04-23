<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /** @use HasFactory<\Database\Factories\SizeFactory> */
    use HasFactory;
    protected $table = 'sizes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'size_name',
        'is_deleted',
    ];
    public $timestamps = true;
    public function productVariants()
    {
        return $this->hasMany(Product_variant::class, 'size_id', 'id');
    }
}
