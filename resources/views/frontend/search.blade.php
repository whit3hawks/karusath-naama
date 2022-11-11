@extends('frontend.layout')

@section('content')
@isset($tag->cover)
<div class="h-96 bg-gray-50 relative" style="background-image: url('{{$tag->cover}}'); background-size: cover; background-position: center;">
  <div class="h-40 w-full absolute top-0 z-50" style="background: rgb(244,87,36);
  background: -moz-linear-gradient(180deg, rgba(244,87,36,1) 0%, rgba(0,0,0,0) 100%);
  background: -webkit-linear-gradient(180deg, rgba(244,87,36,1) 0%, rgba(0,0,0,0) 100%);
  background: linear-gradient(180deg, rgba(244,87,36,1) 0%, rgba(0,0,0,0) 100%);">
  </div>
  <div class="w-full bottom-0 h-60 z-50 absolute" style="background: rgb(255,255,255);
  background: -moz-linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(244,87,36,0) 100%);
  background: -webkit-linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(244,87,36,0) 100%);
  background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(244,87,36,0) 100%);"></div>
</div>
@endisset
<div>
  @isset($search_box_banner)
  <div>
    <div class="container mx-auto px-6 mt-6">
      <div>
        <a href="{{$search_box_banner->url}}">
          <img class="w-full" src="{{$search_box_banner->image}}" alt="">
        </a>
        <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
      </div>
    </div>
  </div>
  @endisset
  @include('frontend.components.newsbox-sm',["heading"=>'"'.request()->keyword.'" އާ ގުޅޭ',"items"=>$news])
  <div class="flex justify-center mt-12">
    {{$news->withQueryString()->links()}}
  </div>
</div>
@endsection
