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
  <div class="container mx-auto flex lg:w-2/4 md:w-2/3 w-full px-4">
    <img src="{{$quote->thumb}}" class="w-full" alt="">
  </div>
  <div class="flex justify-center mt-6">
    {!!
    Share::page(config('app.url').'/quotes/'.$quote->id, $quote->latin,['class' => 'opacity-40 w-6 h-6 flex mb-2 mx-3 justify-center items-center text-xl', 'id' => $quote->id, 'title' => $quote->latin, 'rel' => 'nofollow noopener noreferrer'],'<ul class="flex">', '</ul>')
    ->facebook()
    ->twitter()
    ->telegram()
    ->whatsapp()
    !!}
  </div>
  <div class="container dv text-lg mx-auto md:px-20 px-6 mt-2 text-center" style="line-height:46px;">
    <p>{{$quote->quote}}</p>
    <p class="dv-bold">{{$quote->by}}</p>
  </div>
</div>
@include('frontend.components.newsbox-sm',["heading"=>"އެންމެ ފަސް","items"=>$related])
@endsection
