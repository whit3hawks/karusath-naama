<div>
  @foreach(json_decode($body,true)['blocks'] as $key => $block)
  @switch($block['type'])
  @case('paragraph')
  <p class="text-lg dv rtl py-4" style="line-height: 40px;">{!!$block['data']['text']!!}</p>
  @if($key == 2)
  @isset($adv)
  <div class="md:hidden flex justify-center items-center">
    <div class="lg:w-1/3 md:w-1/2 w-60">
      <a target="_blank" href="{{$adv->url}}">
        <img class="w-full" src="{{$adv->image}}" alt="">
      </a>
      <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
    </div>
  </div>
  @endisset
  @endif
  @break
  @case('quote')
  <div class="pr-4 pr-4 border-r-4 border-orange-600 md:pl-12 my-4">
    <p class="text-md dv rtl opacity-50 flex mb-4" style="line-height: 40px;">
      {!!$block['data']['text']!!}
    </p>
    <p class="text-xl dv-bold rtl opacity-50">{!!$block['data']['caption']!!}</p>
  </div>
  @break
  @case('image')
  <div>
    <img class="w-full pt-6" src="{{$block['data']['file']['url']}}" alt="">
    <p class="dv text-sm rtl opacity-50 mt-2" style="line-height: 30px;">{{$block['data']['caption']}}</p>
  </div>
  @break
  @case('embed')
  <div>
    @switch($block['data']['service'])
    @case('youtube')
    <div class="video-container mt-6">
      <iframe src="{{$block['data']['embed']}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>
      <p class="dv text-sm rtl opacity-50 mt-2" style="line-height: 30px;">{{$block['data']['caption']}}</p>
    </div>
    @break
    @case('twitter')
    <div>
      <div class="flex justify-center mt-6">
        <iframe width="{{$block['data']['width']}}" height="{{$block['data']['height']}}" class="twitfram" src="{{$block['data']['embed']}}" frameborder="0"></iframe>
      </div>
      <p class="dv text-sm rtl opacity-50 mt-2" style="line-height: 30px;">{{$block['data']['caption']}}</p>
    </div>
    @break
    @case('facebook')
    <div>
      <div class="video-container mt-6">
        <iframe class="w-full" src="{{$block['data']['embed']}}" frameborder="0"></iframe>
      </div>
      <p class="dv text-sm rtl opacity-50 mt-2" style="line-height: 30px;">{{$block['data']['caption']}}</p>
    </div>
    @break
    @default
    <p></p>
    @endswitch
  </div>
  @break
  @case('header')
  <div>
    @switch($block['data']['level'])
    @case(1)
    <h1 class="text-4xl dv-bold mt-6 mb-2 rtl tracking-[.06em]" style="line-height: 70px;">{!!$block['data']['text']!!}</h1>
    @break
    @case(2)
    <h1 class="text-3xl dv-bold mt-6 mb-2 rtl tracking-[.06em]" style="line-height: 60px;">{!!$block['data']['text']!!}</h1>
    @break
    @case(3)
    <h1 class="text-3xl dv-bold mt-6 mb-2 rtl tracking-[.06em]" style="line-height: 56px;">{!!$block['data']['text']!!}</h1>
    @break
    @case(4)
    <h1 class="text-2xl dv-bold mt-6 mb-2 rtl tracking-[.06em]" style="line-height: 50px;">{!!$block['data']['text']!!}</h1>
    @break
    @case(5)
    <h1 class="text-2xl dv-bold mt-6 mb-2 rtl tracking-[.06em]" style="line-height: 50px;">{!!$block['data']['text']!!}</h1>
    @break
    @case(6)
    <h1 class="text-2xl dv-bold mt-6 mb-2 rtl tracking-[.06em]" style="line-height: 50px;">{!!$block['data']['text']!!}</h1>
    @break
    @default
    @endswitch
  </div>
  @break
  @default
  @endswitch
  @endforeach
</div>
