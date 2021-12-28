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
        'leaveType',
        'description',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

}
