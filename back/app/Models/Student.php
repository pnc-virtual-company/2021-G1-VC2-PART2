<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstName',
        'lastName',
        'class',
        'phone',
        'gender',
        'ngo',
        'picture',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
