<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
  <channel>
    <title>
      <![CDATA[voice.mv]]>
    </title>
    <link>
    <![CDATA[https://voice.mv/news/latest]]>
    </link>
    <description>
      <![CDATA[Voice.mv]]>
    </description>
    @foreach($news as $post)
    <item>
      <title>
        <![CDATA[{{$post->title}}]]>
      </title>
      <image>
        <![CDATA[{{$post->image}}]]>
      </image>
      <link>https://voice.mv/{{ $post->id }}</link>
      <description>
        <![CDATA[{!!$post->summary!!}]]>
      </description>
      <guid>{{ $post->id }}</guid>
      <pubDate>{{ Carbon\Carbon::parse($post->date)->toRssString() }}</pubDate>
    </item>
    @endforeach
  </channel>
</rss>
