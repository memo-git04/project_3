<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Admin extends Model implements Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;

    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',
        'phone',
        'address',
        'is_deleted',
        'role_id'
    ];
    public $timestamps = true;
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }


}
