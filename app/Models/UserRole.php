<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserRole extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'role_id'];

    // A user_role entry belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A user_role entry belongs to a role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
