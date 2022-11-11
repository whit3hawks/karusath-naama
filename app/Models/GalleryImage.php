<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value) {
            return config('filesystems.disks.do.url') . '/' . $value;
        } else {
            return asset('images/no-image.png');
        }
    }
}
