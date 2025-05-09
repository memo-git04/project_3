<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /** @use HasFactory<\Database\Factories\PromotionFactory> */
    use HasFactory;
    protected $table = 'promotions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'discount_percent',
        'min_order_value',
        'is_used',
        'start_date',
        'end_date',
        'usage_limit',
        'current_usage',
        'is_deleted',
    ];
    public $timestamps = true;

    public function orders()
    {
        return $this->hasMany(Order::class, 'promotion_id', 'id');
    }
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_promotion', 'promotion_id', 'customer_id')
            ->withTimestamps();
    }
}
