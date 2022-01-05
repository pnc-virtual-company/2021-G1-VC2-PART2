<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'teacher',
        'startDate',
        'endDate',
        'time',
        'manyDay',
        'leaveType',
        'description',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

}
