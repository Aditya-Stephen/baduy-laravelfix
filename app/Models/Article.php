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

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $appends = ['header_image_url'];

    public function getHeaderImageUrlAttribute()
    {
        if (empty($this->header_image)) {
            return null;
        }

        // Periksa jika sudah berupa base64 string
        if (is_string($this->header_image) && base64_decode($this->header_image, true) !== false) {
            return 'data:image/jpeg;base64,'.$this->header_image;
        }

        // Jika binary data, encode ke base64
        return 'data:image/jpeg;base64,'.base64_encode($this->header_image);
    }

    protected $hidden = ['header_image'];


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
