<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'employee_number',
        'name',
        'email',
        'phone',
        'address',
        'department_id',
        'position_id',
        'manager_id',
        'join_date',
        'birth_date',
        'employment_status',
    ];

    public function casts(): array
    {
        return [
            'join_date' => 'date',
            'birth_date' => 'date',
        ];
        
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(LeaveBalance::class);
    }

    public function leaveRequest(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function currentAttendance(): HasOne
    {
        return $this->hasOne(Attendance::class)
            ->whereDate('attendance_date', today());
    }
}
