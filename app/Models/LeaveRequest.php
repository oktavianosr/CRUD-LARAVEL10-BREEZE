<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeaveRequest extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'leave_types_id',
        'start_date',
        'end_date',
        'status',
        'is_approved',
        'attachment',
        'metadata' ,
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_approved' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    protected $auditInclude = [
        'user_id',
        'leave_types_id',
        'status',
        'metadata'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveTypes::class, 'leave_types_id');
    }
}
