<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subTags()
    {
        return $this->hasMany(SubTag::class, 'parent_tag_id');
    }

    public function getCoverAttribute($value)
    {
        if ($value) {
            return config('filesystems.disks.do.url') . '/' . $value;
        } else {
            return null;
        }
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return config('filesystems.disks.do.url') . '/' . $value;
        } else {
            return null;
        }
    }
}
