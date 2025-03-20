<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user can have multiple roles
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    // A user can have multiple roles via user_roles table
    public function roles()
    {
        return $this->hasManyThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }

    // Method to check if a user has a specific role
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // Assign a role to a user
    public function assignRole($roleId)
    {
        // Prevent duplicate role assignment
        if (!$this->userRoles()->where('role_id', $roleId)->exists()) {
            $this->userRoles()->create(['role_id' => $roleId]);
        }
    }

    // Remove a role from a user
    public function removeRole($roleId)
    {
        // Delete the UserRole entry to remove the role
        $this->userRoles()->where('role_id', $roleId)->delete();
    }


}
