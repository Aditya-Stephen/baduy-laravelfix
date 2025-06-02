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
            // Return base64 encoded image data URI
            return 'data:image/jpeg;base64,' . $this->profile_photo_data;
        }

        if ($this->profile_photo_path) {
            // Return URL to stored file
            return asset('storage/' . $this->profile_photo_path);
        }

        // Return default avatar URL if no photo available
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
        // Example admin logic; update as needed
        return $this->id === 1;
    }
}
