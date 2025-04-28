<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveTypes extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $dates = ['deleted_at'];


    protected $fillable =[
        'id',
        'name',
        'description',
        'is_active',
    ];

    protected $auditInclude =[
        'name',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function leaveRequest()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
