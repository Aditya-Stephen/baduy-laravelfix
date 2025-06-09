<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Menambahkan kolom role
        'profile_photo_path',
        'profile_photo_data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'profile_photo_data', // hide raw photo data in API response
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'is_admin',
    ];

    /**
     * Get the URL of the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo_data) {
            return 'data:image/jpeg;base64,' . $this->profile_photo_data;
        }

        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        return $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl(): string
    {
        $name = urlencode($this->name ?: 'User');
        return "https://ui-avatars.com/api/?name={$name}&color=7F9CF5&background=EBF4FF";
    }

    /**
     * User has many articles.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Determine if the user is admin.
     *
     * @return bool
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin' || $this->role === 'superadmin'; 
    }

    /**
     * Check if the user is a superadmin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    /**
     * Check if the user is admin or superadmin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }

    /**
     * Ensure a default 'user' role for new users.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->role)) {
                $user->role = 'user';  // Default role for new users
            }
        });
    }
}
