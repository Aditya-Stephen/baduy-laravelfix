<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Article extends Model
{
    //
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'title',
        'genre',
        'content',
        'header_image',
        'created_at'
    ];

    protected $dates = [
        'created_at',
    ];

    protected $attributes = [
        'created_at' => null,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
