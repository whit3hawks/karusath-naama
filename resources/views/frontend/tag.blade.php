@extends('frontend.layout')

@section('content')
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
