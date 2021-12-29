<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciple extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'dnt',
        'date',
        'description',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
