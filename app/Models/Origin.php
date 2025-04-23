<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    /** @use HasFactory<\Database\Factories\OriginFactory> */
    use HasFactory;
    protected $table = 'origins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'origin_name',
        'is_deleted',
    ];
    public $timestamps = true;
    public function products()
    {
        return $this->hasMany(Product::class, 'origin_id', 'id');
    }

}
