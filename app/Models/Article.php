<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'author_name',
        'profile_picture',
        'title', 
        'content',
        'created_at',
        'header_image'
    ];

    protected $dates = [
        'created_at',
    ];

    protected $attributes = [
        'created_at' => null,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->created_at)) {
                $model->created_at = now();
            }
        });
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at 
            ? $this->created_at->format('F j, Y') 
            : 'No date available';
    }
}