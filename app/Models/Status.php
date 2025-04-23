<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;
    protected $table = 'statuses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status_name',
    ];
    public $timestamps = true;
    public function orders()
    {
        return $this->hasMany(Order::class, 'status_id', 'id');
    }
}
