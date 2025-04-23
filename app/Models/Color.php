<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /** @use HasFactory<\Database\Factories\ColorFactory> */
    use HasFactory;
    protected $table = 'colors';
    public $primaryKey = 'id';
    protected $fillable = [
        'color_name',
        'is_deleted',
    ];
    public $timestamps = true;
    public function productVariants()
    {
        return $this->hasMany(Product_variant::class, 'color_id', 'id');
    }
}
