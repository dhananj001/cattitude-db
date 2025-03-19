<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // A role can be assigned to many users via user_roles table
    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }
}
