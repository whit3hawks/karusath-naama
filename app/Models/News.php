<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class News extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public function articleTags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags')->where('hide_from_article', 'no');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function publishedComments()
    {
        return $this->hasMany(Comment::class)->where('status', 1);
    }

    public function liveBlogs()
    {
        return $this->hasMany(LiveBlog::class)->orderBy('datetime', 'DESC');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            if (str_contains($value, 'voicemv-cdn')) {
                return $value;
            } else {
                return config('filesystems.disks.do.url') . '/' . $value;
            }
        } else {
            return asset('images/no-image.png');
        }
    }

    public function getThumbAttribute()
    {
        if ($this->image) {
            if (str_contains($this->image, 'voicemv-cdn')) {
                return $this->image;
            } else {
                return str_replace('original_', 'large_thumb_', $this->image);
            }
        } else {
            return null;
        }
    }

    public function getSmallThumbAttribute()
    {
        if ($this->image) {
            if (str_contains($this->image, 'voicemv-cdn')) {
                return $this->image;
            } else {
                return str_replace('original_', 'small_thumb_', $this->image);
            }
        } else {
            return null;
        }
    }

    public function getOgImageAttribute($value)
    {
        if ($value) {
            if (str_contains($this->image, 'voicemv-cdn')) {
                return $value;
            } else {
                return config('filesystems.disks.do.url') . '/' . $value;
            }
        } else {
            return null;
        }
    }
}
