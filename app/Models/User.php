<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens,  Notifiable, SoftDeletes , \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    // protected $table = 'users';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $auditInclude = [
        'name','email','role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id' , 'id');
    }
    public function role_name()
    {
        return $this->belongsTo(Roles::class, 'role_id' , 'name');
    }
    public function leaveRequest()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
