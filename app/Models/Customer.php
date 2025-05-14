<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_name',
        'fullname',
        'email',
        'phone',
        'address',
        'password',
        'img',
        'reset_password',
        'reset_expire',
        'is_deleted',
    ];
    public $timestamps = true;

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'customer_promotion', 'customer_id', 'promotion_id')
            ->withTimestamps();
    }
}
