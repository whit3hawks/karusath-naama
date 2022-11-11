@extends('frontend.layout')

@section('content')
@isset($tag_top_banner)
<div>
  <div class="container mx-auto px-4 md:px-6 mt-4 md:mt-6">
    <div>
      <a target="_blank" href="{{$tag_top_banner->url}}">
        <img class="w-full" src="{{$tag_top_banner->image}}" alt="">
      </a>
      <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
    </div>
  </div>
</div>
@endisset
<div class="lg:mt-16 mt-6 w-full">
  <div class="container mx-auto flex">
    <div class="w-full px-4 md:px-6 lg:flex flex-row-reverse">
      <div class="lg:w-full">
        <p class="dv-bold text-center rtl lg:text-4xl text-3xl opacity-80" style="line-height: 50px;">{{$gallery->title}}</p>
        <div class="mt-2 text-center text-md ltr en-font opacity-50 border-b border-gray-200 pb-6">{{Carbon\Carbon::parse($gallery->date)->format('d M Y')}}</div>
        <div class="slider mt-6">
          @foreach($gallery->images as $image)
          <div>
            <img src="{{$image->image}}" class="w-full" alt="">
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<div class="flex justify-center mt-6">
  {!!
  Share::page(config('app.url').'/galleries/'.$gallery->id, $gallery->latin,['class' => 'opacity-40 w-6 h-6 flex mb-2 mx-3 justify-center items-center text-xl', 'id' => $gallery->id, 'title' => $gallery->latin, 'rel' => 'nofollow noopener noreferrer'],'<ul class="flex">', '</ul>')
  ->facebook()
  ->twitter()
  ->telegram()
  ->whatsapp()
  !!}
</div>
<div class="container dv text-lg mx-auto md:px-20 px-6 mt-2 text-center" style="line-height:46px;">
  <p>{{$gallery->description}}</p>
</div>
@include('frontend.components.newsbox-sm',["heading"=>"އެންމެ ފަސް","items"=>$related])
<script>
  $('.slider').slick({
    autoplay: true
    , arrows: true
    , prevArrow: "<button type='button' class='slick-prev pull-left rounded-full bg-white w-12 text-orange-600 h-12 flex justify-center items-center' style='position: absolute; left: 20px; top: 50%; z-index: 1000;'><svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2'><path stroke-linecap='round' stroke-linejoin='round' d='M15 19l-7-7 7-7' /></svg></button>"
    , nextArrow: "<button type='button' class='slick-prev pull-left rounded-full bg-white w-12 text-orange-600 h-12 flex justify-center items-center' style='position: absolute; right: 20px; top: 50%; z-index: 1000;'><svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='2'><path stroke-linecap='round' stroke-linejoin='round' d='M9 5l7 7-7 7' /></svg></button>"
  });

</script>
@endsection
