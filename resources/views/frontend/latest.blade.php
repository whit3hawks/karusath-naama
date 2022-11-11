<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
  <channel>
    <title>
      <![CDATA[karusathnaama.com]]>
    </title>
    <link>
    <![CDATA[https://karusathnaama.com/news/latest]]>
    </link>
    <description>
      <![CDATA[Karusath Naama]]>
    </description>
    @foreach($news as $post)
    <item>
      <title>
        <![CDATA[{{$post->title}}]]>
      </title>
      <image>
        <![CDATA[{{$post->image}}]]>
      </image>
      <link>https://karusathnaama.com/{{ $post->id }}</link>
      <description>
        <![CDATA[{!!$post->summary!!}]]>
      </description>
      <guid>{{ $post->id }}</guid>
      <pubDate>{{ Carbon\Carbon::parse($post->date)->toRssString() }}</pubDate>
    </item>
    @endforeach
  </channel>
</rss>
