<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    protected $guarded = [
        'role',
        'is_admin',
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Returns the URL of the profile photo, or a placeholder avatar using initials.
     */
    public function profilePhotoUrl(): string
    {
        if ($this->profile_photo) {
            return asset('storage/'.$this->profile_photo);
        }
        $initials = urlencode(strtoupper(substr($this->name, 0, 2)));

        return "https://ui-avatars.com/api/?name={$initials}&background=4f46e5&color=fff&bold=true&size=128";
    }
}
