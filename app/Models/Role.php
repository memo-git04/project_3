<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;
    protected  $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'role_name',
        'is_deleted',
    ];
    public $timestamps = true;
    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_id', 'id');
    }
}
