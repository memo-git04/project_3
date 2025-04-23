<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'method_id',
        'total_amount',
        'status_id',
        'admin_id',
        'order_date',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'is_deleted',

    ];
    public $timestamps = true;
    public function paymentMethod()
    {
        return $this->belongsTo(Payment_method::class, 'method_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
    public function orderItems()
    {
        return $this->hasMany(Order_item::class, 'order_id', 'id');
    }
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id', 'id');
    }

}
