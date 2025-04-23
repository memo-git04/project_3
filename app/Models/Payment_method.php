<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentMethodFactory> */
    use HasFactory;
    protected $table = 'payment_methods';
    protected $primaryKey = 'id';
    protected $fillable = [
        'method_name',
    ];
    public $timestamps = true;
    public function orders()
    {
        return $this->hasMany(Order::class, 'method_id', 'id');
    }
}
