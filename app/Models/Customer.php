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
        'is_deleted',
    ];
    public $timestamps = true;
}
