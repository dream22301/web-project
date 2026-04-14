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
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Returns the URL of the profile photo, or a placeholder avatar using initials.
     */
    public function profilePhotoUrl(): string
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }
        $initials = urlencode(strtoupper(substr($this->name, 0, 2)));
        return "https://ui-avatars.com/api/?name={$initials}&background=4f46e5&color=fff&bold=true&size=128";
    }
}

