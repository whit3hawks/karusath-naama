@extends('frontend.layout')

@section('content')
@isset($tag->cover)
<div class="@if(!isset($tag->cover))md:my-20 my-12 @endif relative">
  @if(isset($tag->cover))
  <div class="h-72 overflow-hidden flex items-center" style="background-image: url('{{$tag->cover}}');background-size: cover;background-position: center;">
  </div>
  @endif
  <div class="flex z-50 absolue top-0 h-full w-full items-center">
    <div class="container mx-auto md:px-6 px-4">
      <div class="md:flex relative rounded-xl" @if(isset($tag->cover)) style="top:-50px; background: #ffffff; padding: 40px 40px 0px 40px;" @endif>
        <div class="flex md:hidden justify-center mb-6">
          <div class="w-28 h-28 rounded-full" style="background-image: url('{{$tag->image}}'); background-size: cover; background-position: center;">
          </div>
        </div>
        <div class="rtl">
          <p class="dv-bold md:text-right text-center text-black md:text-4xl text-3xl text-white mb-6">{{$tag->name}}</p>
          <p class="dv text-lg md:text-right text-center text-black  md:w-5/6 text-white" style="line-height: 38px;">{{$tag->summary}}</p>
        </div>
        <div class="ml-6 md:flex justify-center hidden">
          <div class="w-28 h-28 rounded-full" style="background-image: url('{{$tag->image}}'); background-size: cover; background-position: center;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endisset
<div class="mt-6">
  <div class="flex container mx-auto px-6 justify-end">
    @foreach($tag->subTags as $subTag)
    <a href="/{{$subTag->tag->slug}}" class="items-center text-sm hover:underline border border-gray-200 dv-bold px-6 py-2 ml-4 text-gray-700 rounded-full">{{$subTag->tag->name}} <span class="border-jungle-green">#</span></a>
    @endforeach
  </div>
</div>
<div class="">
  @if(isset($tag_specific_top_banner))
  <div>
    <div class="container mx-auto px-6 mt-6">
      <div>
        <a href="{{$tag_specific_top_banner->url}}">
          <img class="w-full" src="{{$tag_specific_top_banner->image}}" alt="">
        </a>
        <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
      </div>
    </div>
  </div>
  @else
  @isset($tag_top_banner)
  <div>
    <div class="container mx-auto px-6 mt-6">
      <div>
        <a href="{{$tag_top_banner->url}}">
          <img class="w-full" src="{{$tag_top_banner->image}}" alt="">
        </a>
        <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
      </div>
    </div>
  </div>
  @endisset
  @endif
  @include('frontend.components.newsbox-sm',["heading"=>$tag->name,"items"=>$news])
  <div class="flex justify-center mt-12">
    {{$news->withQueryString()->links()}}
  </div>
  @isset($tag_bottom_banner)
  <div class="mt-12">
    <div class="container mx-auto px-6 mt-6">
      <div>
        <a href="{{$tag_bottom_banner->url}}">
          <img class="w-full" src="{{$tag_bottom_banner->image}}" alt="">
        </a>
        <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
      </div>
    </div>
  </div>
  @endisset
</div>
@endsection
