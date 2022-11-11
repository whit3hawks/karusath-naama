@extends('frontend.layout')

@section('content')
@isset($tag_top_banner)
<div>
  <div class="container mx-auto px-4 md:px-6 mt-4 md:mt-6">
    <div>
      <a href="{{$tag_top_banner->url}}">
        <img class="w-full" src="{{$tag_top_banner->image}}" alt="">
      </a>
      <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
    </div>
  </div>
</div>
@endisset
<div class="lg:mt-16 mt-4 md:mt-6 w-full">
  <div class="container mx-auto flex">
    <div class="px-4 md:px-6 w-full lg:flex flex-row-reverse">
      <div class="lg:w-full">
        <p class="dv-bold text-center rtl lg:text-4xl text-3xl opacity-80" style="line-height: 50px;">{{$video->title}}</p>
        <div class="mt-2 ltr en-font text-center opacity-50 border-b border-gray-200 pb-6">{{Carbon\Carbon::parse($video->date)->format('d M Y')}}</div>
        <div class="video-container mt-6">
          <iframe src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="flex justify-center mt-6">
    {!!
    Share::page(config('app.url').'/videos/'.$video->id, $video->latin,['class' => 'opacity-40 w-6 h-6 flex mb-2 mx-3 justify-center items-center text-xl', 'id' => $video->id, 'title' => $video->latin, 'rel' => 'nofollow noopener noreferrer'],'<ul class="flex">', '</ul>')
    ->facebook()
    ->twitter()
    ->telegram()
    ->whatsapp()
    !!}
  </div>
  <div class="container dv text-lg mx-auto md:px-20 px-6 mt-2 text-center" style="line-height:46px;">
    <p>{{$video->description}}</p>
  </div>
</div>
@include('frontend.components.newsbox-sm',["heading"=>"އެންމެ ފަސް","items"=>$related])
@endsection
