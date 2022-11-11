<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaPhoto extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return config('filesystems.disks.do.url') . '/' . $value;
        } else {
            return asset('images/no-image.png');
        }
    }

    public function getThumbAttribute()
    {
        if ($this->image) {
            return str_replace('original_', 'large_thumb_', $this->image);
        } else {
            return null;
        }
    }

    public function getSmallThumbAttribute()
    {
        if ($this->image) {
            return str_replace('original_', 'small_thumb_', $this->image);
        } else {
            return null;
        }
    }
}
