<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Roles extends Model implements Auditable
{
    use HasUuids, \OwenIt\Auditing\Auditable;

    protected $fillable= [
        'name',
        'slug',
        'permissions',
        'level',
        'is_active',
        'description',
        'level'
    ];
    protected $dates = ['deleted_at'];

    protected $auditInclude =[
        'name',
    ];


    protected $casts = [
        'permissions' => 'json',
        'is_active' => 'boolean',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function leaveRequest()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
