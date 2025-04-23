<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_name',
        'full_name',
        'email',
        'phone',
        'address',
        'password',
        'is_deleted',
    ];
    public $timestamps = true;
}
