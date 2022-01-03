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
        'batch',
        'major',
        'phone',
        'gender',
        'ngo',
        'picture',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function permission(){
        return $this->hasMany(permission::class);
    }
    public function disciple(){
        return $this->hasMany(Disciple::class);
    }

}
