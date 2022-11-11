<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsQuote extends Model
{
    use HasFactory;

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
            return str_replace('original_', 'quote_', $this->image);
        } else {
            return null;
        }
    }
}
