<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'price',
    ];
    public $timestamps = true;
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function productVariant()
    {
        return $this->belongsTo(Product_variant::class, 'product_variant_id', 'id');
    }
}
