<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // JANGAN PERNAH DIHAPUS!
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =================================
    // EXISTING RELATIONSHIPS - JANGAN DIHAPUS
    // =================================
    
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // =================================
    // ROLE METHODS - RESTORE SEMUA METHOD YANG ADA SEBELUMNYA
    // =================================
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Jika ada method role lain yang hilang, tambahkan di sini
    public function canAccessAdmin()
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function getRoleAttribute($value)
    {
        return $value ?? 'user'; // Default role
    }

    // =================================
    // PROFILE IMAGE SYSTEM - TAMBAHAN BARU SAJA
    // =================================

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function profileImages()
    {
        return $this->morphMany(Image::class, 'imageable')->where('image_type', 'profile');
    }

    // Helper method untuk mendapatkan profile image
    public function profileImage()
    {
        return $this->profileImages()->first();
    }

    // Helper method untuk default profile photo URL
    public function defaultProfilePhotoUrl()
    {
        // Generate default avatar berdasarkan nama
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&color=7C3AED&background=EBF4FF&size=200";
    }
}
