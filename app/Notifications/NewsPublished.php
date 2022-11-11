<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twitter\TwitterChannel;
use NotificationChannels\Twitter\TwitterStatusUpdate;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class NewsPublished extends Notification
{
    use Queueable;
    protected $news;

    public function __construct($news)
    {
        $this->news = $news;
    }

    public function via($notifiable)
    {
        //return [TwitterChannel::class, FacebookPosterChannel::class];
        return [TwitterChannel::class];
    }

    public function toTwitter($news)
    {
        return (new TwitterStatusUpdate($this->news->latin . ' https://karusathnaama.com/' . $this->news->id));
    }

    // public function toFacebookPoster($news)
    // {
    //     return (new FacebookPosterPost('Laravel notifications are awesome!'))
    //         ->withLink('https://laravel.com');
    // }

    public function toArray($notifiable)
    {
        return [];
    }
}
