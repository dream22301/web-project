<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nis',
        'class_major',
    ];

    protected $hidden = [
        'password',
    ];

    protected function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
