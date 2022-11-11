@extends('frontend.layout')

@section('content')
{{-- main --}}
@isset($home_top_banner)
<div>
  <div class="container mx-auto px-4 md:px-6 mt-4 md:mt-6">
    <div>
      <a target="_blank" target="_blank" href="{{$home_top_banner->url}}">
        <img class="w-full" src="{{$home_top_banner->image}}" alt="">
      </a>
      <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
    </div>
  </div>
</div>
@endisset
{{-- start breaking --}}
@isset($breaking)
<div>
  <div class="container mx-auto px-4 md:px-6 mt-6">
    {{-- --}}
    <div class="w-full md:h-full h-72 relative overflow-hidden md:hidden flex" style="background-size: cover; backgrond-position: center; background-image: url('{{$breaking->thumb}}')">
      <div class="w-full md:h-full h-72 bg-gradient-to-r from-red-700 to-blue-500 opacity-50"></div>
      @if(count($breaking->liveBlogs) > 0) <div class="font-semibold text-sm uppercase text-white absolute top-4 right-4 z-20 bg-red-600 rounded-lg px-3 py-1 flex items-center rtl">Live <div class="w-2 h-2 mr-2 rounded-full bg-white"></div>
      </div>
      @endif
    </div>
    <div class="grid md:grid-cols-2 grid-cols-1 h-full">
      <div class="w-full h-full w-full p-6 bg-red-700">
        <div class="flex justify-between items-center border-b border-white border-opacity-60 pb-4">
          <div class="text-white text-sm">{{Carbon\Carbon::parse($breaking->date)->format('d M Y')}}</div>
          <div class="text-white tetx-sm font-semibold">BREAKING</div>
        </div>
        <a href="/{{$breaking->id}}">
          <div class="dv-bold text-white lg:text-4xl text-2xl mt-4 mb-4 rtl tracking-[.06em]" style="line-height: 58px;">{{$breaking->title}}</div>
        </a>
        <div class="dv md:text-lg text-white text-md mt-2 rtl" style="line-height: 40px;">{{$breaking->summary}}</div>
        @if(count($breakingRelated) > 0)
        <div class="mt-6">
          <div class="justify-end flex border-opacity-60">
            <div class="text-xl dv-bold rtl pb-2 mb-4 border-b border-white border-opacity-50 text-white">
              ކުއްލި ހަބަރާ ގުޅެ
            </div>
          </div>
          <ul>
            @foreach ($breakingRelated as $item)
            <li><a class="hover:underline pb-4 rtl flex items-center text-white text-right dv-bold text-base" href="/{{$item->id}}">
                <div class="h-2 w-2 bg-white rounded-full ml-4"></div>{{$item->short_title ?? $item->title}}
              </a></li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <div class="w-full md:h-full h-72 relative hidden md:flex overflow-hidden" style="background-size: cover; backgrond-position: center; background-image: url('{{$breaking->thumb}}')">
        <div class="w-full md:h-full h-72 bg-gradient-to-r from-red-700 to-blue-500 opacity-50"></div>
        @if(count($breaking->liveBlogs) > 0) <div class="font-semibold text-sm uppercase text-white absolute top-4 right-4 z-20 bg-red-600 rounded-lg px-3 py-1 flex items-center rtl">Live <div class="w-2 h-2 mr-2 rounded-full bg-white"></div>
        </div>
        @endif
      </div>
    </div>
  </div>
  {{-- </a> --}}
</div>
@endisset
{{-- .end breaking --}}
<div class="container lg:px-0 mx-auto px-4 md:px-6 mt-4 md:mt-6">
  <div class="w-full rtl lg:flex lg:-mx-3">
    @isset($featuredMain)
    <a class="lg:w-2/5 w-full lg:mx-3" href="/{{$featuredMain->id}}">
      <div>
        <div class="w-full bg-gray-50 relative">
          <img class="w-full" src="{{$featuredMain->thumb}}" alt="" />
          @if(count($featuredMain->liveBlogs) > 0) <div class="font-semibold text-sm uppercase text-white absolute top-4 right-4 z-20 bg-red-600 rounded-lg px-3 py-1 flex items-center">Live <div class="w-2 h-2 mr-2 rounded-full bg-white"></div>
          </div>
          @endif
          @if(isset($featuredMain->video))
          <div class="flex w-full h-full absolute top-0 bg-black bg-opacity-25 text-white justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
            </svg>
          </div>
          @endif
        </div>
        <div class="text-sm en-font ltr text-right mt-6 opacity-50">{{Carbon\Carbon::parse($featuredMain->date)->format('d M Y')}}</div>
        <div class="dv-bold lg:text-4xl text-3xl mt-2 tracking-[.06em] rtl opacity-80 tracking-[.06em]" style="line-height: 70px;">{{$featuredMain->title}}</div>
        <div class="dv md:text-lg text-md mt-2 rtl leading-10 opacity-60" style="line-height: 40px;">{{$featuredMain->summary}}</div>
      </div>
    </a>
    @endisset
    <div class="lg:w-3/5 w-full lg:mx-3 lg:mt-0 mt-6 md:border-r border-gray-100 md:pr-6">
      @isset($featuredMid)
      <a class="w-full lg:flex lg:-mx-6 lg:flex-row-reverse pb-6" href="/{{$featuredMid->id}}">
        <div class="w-full lg:flex lg:-mx-3 lg:flex-row-reverse">
          <div class="h-64 w-full lg:w-1/2 w-full lg:mx-3 mb-6" style="background-image: url('{{$featuredMid->small_thumb}}'); background-size: cover; background-position: center;"></div>
          <div class="lg:w-1/2 w-full lg:mx-3">
            <div class="text-sm en-font ltr text-right opacity-50">{{Carbon\Carbon::parse($featuredMid->date)->format('d M Y')}}</div>
            <div class="dv-bold text-2xl mt-2 rtl leading-10 opacity-80 tracking-[.06em]" style="line-height: 50px;">{{$featuredMid->short_title ?? $featuredMid->title}}</div>
            <div class="dv text-md mt-2 rtl leading-8 opacity-60">{{$featuredMid->summary}}</div>
          </div>
        </div>
      </a>
      @endisset
      <div>
        <div class="grid lg:grid-cols-2 md:mr-6 mr-0 grid-cols-1 gap-6 lg:mt-0 mt-6">
          @foreach ($featured as $item)
          <a href="/{{$item->id}}">
            <div class="flex -mx-3">
              <div class="w-1/3 mx-3 h-20">
                <img class="w-full" src="{{$item->small_thumb}}" alt=""></div>
              <div class="w-2/3 mx-3">
                <div class="text-xs en-font ltr text-right opacity-50">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
                <div class="dv-bold ld text-base mt-2 rtl leading-8 opacity-80 tracking-[.06em]" style="line-height:34px;">{{$item->short_title ?? $item->title}}</div>
              </div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  {{-- .main --}}
</div>
<div class="container lg:px-0 mx-auto px-4 md:px-6 mt-4 md:mt-6">
  <div class="w-full rtl lg:flex lg:-mx-3">
    <div class="lg:w-2/5 w-full lg:mx-3 md:mb-0 mb-6">
      <div class="mb-6 justify-start flex border-b-4 border-gray-100 md:mt-0 mt-8">
        <div class="text-xl dv-bold rtl border-b-4 -mb-1 border-teal-400 pb-4 opacity-80">
          އެޑިޓަރުގެ ހޮވުން
        </div>
      </div>
      <ul>
        @foreach ($editorsPick as $item)
        <li><a class="pb-4 flex items-center dv-bold text-lg" href="/{{$item->id}}">
            <div class="h-2 w-2 bg-orange-600 rounded-full ml-4"></div>{{$item->title}}
          </a></li>
        @endforeach
      </ul>
    </div>
    <div class="lg:w-3/5 w-full lg:mx-3 lg:mt-0">
      @isset($home_featured_box_banner)
      <div>
        <div>
          <a target="_blank" href="{{$home_featured_box_banner->url}}">
            <img class="lg:px-6 px-0 w-full" src="{{$home_featured_box_banner->image}}" alt="">
          </a>
          <p class="text-xs opacity-40 mt-1 lg:px-6 px-0 text-right">Advertisement</p>
        </div>
      </div>
      @endisset
    </div>
  </div>
</div>
@isset($specialReport)
{{-- special --}}
<div class="mt-16">
  <div class="container mx-auto px-4 md:px-6 mt-4 md:mt-6">
    <div class="mb-6 justify-center relative flex border-b-4 border-gray-100">
      <div class="text-4xl mb-2 px-8 text-gray-800 bg-white absolute dv-bold rtl" style="top: -12px;">
        <span class="text-orange-600">ކަރުސަތުނާމާ</span> ޚާއްސަ ރިޕޯޓް
      </div>
    </div>
    <a class="w-full" href="/{{$specialReport->id}}">
      <div class="mt-16">
        <div class="flex justify-center">
          <div class="md:w-2/3 w-full bg-gray-50">
            <img class="w-full" src="{{$specialReport->thumb}}" alt="">
          </div>
        </div>
        <div class="text-sm en-font ltr text-center mt-6 mb-4 opacity-50">{{Carbon\Carbon::parse($specialReport->date)->format('d M Y')}}</div>
        <div class="flex justify-center">
          <div class="dv-bold text-center lg:text-5xl text-4xl mt-2 mb-6 rtl opacity-80" style="line-height: 58px;">{{$specialReport->title}}</div>
        </div>
        <div class="flex justify-center">
          <div class="dv md:text-lg md:w-2/3 text-center text-md mt-2 rtl leading-10 opacity-60" style="line-height: 40px;">{{$specialReport->summary}}</div>
        </div>
      </div>
    </a>
  </div>
</div>
{{-- .special --}}
@endisset
@isset($home_latest_box_top_banner)
<div class="container mx-auto mt-12">
  <div class="md:px-0 px-4">
    <a target="_blank" href="{{$home_latest_box_top_banner->url}}">
      <img class="lg:px-6 px-0 w-full" src="{{$home_latest_box_top_banner->image}}" alt="">
    </a>
    <p class="text-xs opacity-40 mt-1 lg:px-6 px-0 text-right">Advertisement</p>
  </div>
</div>
@endisset
<div class="w-full mt-16">
  <div class="container mx-auto px-4 md:px-6">
    <div class="mb-6 justify-end flex border-b-4 border-gray-100">
      <div class="flex cursor-pointer items-center text-xl px-6 dv-bold rtl border-b-4 -mb-1 border-gray-200 pb-4 opacity-80" id="popularbtn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 ml-4 h-5">
          <path fill-rule="evenodd" d="M12.963 2.286a.75.75 0 00-1.071-.136 9.742 9.742 0 00-3.539 6.177A7.547 7.547 0 016.648 6.61a.75.75 0 00-1.152-.082A9 9 0 1015.68 4.534a7.46 7.46 0 01-2.717-2.248zM15.75 14.25a3.75 3.75 0 11-7.313-1.172c.628.465 1.35.81 2.133 1a5.99 5.99 0 011.925-3.545 3.75 3.75 0 013.255 3.717z" clip-rule="evenodd" />
        </svg>
        އެންމެ މަޤްބޫލު
      </div>
      <div class="flex cursor-pointer items-center pl-6 text-xl dv-bold rtl border-b-4 -mb-1 border-teal-400 pb-4 opacity-80" id="latestbtn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 ml-4 h-5">
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
        </svg>
        އެންމެ ފަސް
      </div>
    </div>
    <div id="latest-news">
      <div class="w-full grid md:grid-cols-4 grid-cols-2 rtl gap-6">
        @foreach ($latest as $item)
        <a href="/{{$item->id}}">
          <div class="w-full">
            <div class="w-full">
              <img class="w-full" src="{{$item->small_thumb}}" alt="" />
            </div>
            <div class="ltr flex justify-end en-font text-sm mt-4 rtl opacity-50">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
            <div class="dv-bold md:text-lg text-base tracking-[.06em] rtl mt-2 rtl opacity-80" style="line-height:38px;">{{$item->short_title ?? $item->title}}</div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
    <div id="popular-news" class="hidden">
      <div class="w-full grid md:grid-cols-4 grid-cols-2 rtl gap-6">
        @foreach ($popular as $item)
        <a href="/{{$item->id}}">
          <div class="w-full">
            <div class="w-full">
              <img class="w-full" src="{{$item->small_thumb}}" alt="" />
            </div>
            <div class="ltr flex justify-end en-font text-sm mt-4 rtl opacity-50">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
            <div class="dv-bold md:text-lg text-base tracking-[.06em] rtl mt-2 rtl opacity-80" style="line-height:38px;">{{$item->short_title ?? $item->title}}</div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
</div>
@isset($home_latest_box_banner)
<div class="container mx-auto mt-12">
  <div class="md:px-0 px-4">
    <a target="_blank" href="{{$home_latest_box_banner->url}}">
      <img class="lg:px-6 px-0 w-full" src="{{$home_latest_box_banner->image}}" alt="">
    </a>
    <p class="text-xs opacity-40 mt-1 lg:px-6 px-0 text-right">Advertisement</p>
  </div>
</div>
@endisset
@include('frontend.components.newsbox-xl',["heading"=>"ރިޕޯޓް","items"=>$reports,'adv'=> $home_report_box_banner])
@include('frontend.components.newsbox-sm',["heading"=>"ދުނިޔެ","items"=>$world])
@isset($home_gallery_box_top_banner)
<div class="container mx-auto mt-12">
  <div class="md:px-0 px-4">
    <a target="_blank" href="{{$home_gallery_box_top_banner->url}}">
      <img class="lg:px-6 px-0 w-full" src="{{$home_gallery_box_top_banner->image}}" alt="">
    </a>
    <p class="text-xs opacity-40 mt-1 lg:px-6 px-0 text-right">Advertisement</p>
  </div>
</div>
@endisset
@include('frontend.components.newsbox-sm',["heading"=>"ކުޅިވަރު","items"=>$sports])
@isset($home_sports_box_top_banner)
<div class="container mx-auto mt-12">
  <div class="md:px-0 px-4">
    <a target="_blank" href="{{$home_sports_box_top_banner->url}}">
      <img class="lg:px-6 px-0 w-full" src="{{$home_sports_box_top_banner->image}}" alt="">
    </a>
    <p class="text-xs opacity-40 mt-1 lg:px-6 px-0 text-right">Advertisement</p>
  </div>
</div>
@endisset
@include('frontend.components.galleries',["heading"=>"ގެލެރީ","items"=>$galleries])
@include('frontend.components.newsbox-sm',["heading"=>"ދީން","items"=>$religion,'adv'=> $home_religion_box_banner])
@include('frontend.components.videos',["heading"=>"ވީޑިއޯ","items"=>$videos])
@include('frontend.components.newsbox-sm',["heading"=>"ވިޔަފާރި","items"=>$business,'adv'=> $home_business_box_banner])
@include('frontend.components.newsbox-sm',["heading"=>"ލައިފްސްޓައިލް","items"=>$lifestyle])
@include('frontend.components.newsbox-sm',["heading"=>"ވާހަކަ","items"=>$stories])
@endsection
@push('scripts')
<script>
  $('#latestbtn').click(function() {
    $('#latest-news').show();
    $('#popular-news').hide();

    $('#popularbtn').removeClass('border-teal-400');
    $('#popularbtn').addClass('border-gray-200');

    $('#latestbtn').addClass('border-teal-400');
    $('#latestbtn').removeClass('border-gray-200');
  });

  $('#popularbtn').click(function() {
    $('#latest-news').hide();
    $('#popular-news').show();

    $('#popularbtn').removeClass('border-gray-200');
    $('#popularbtn').addClass('border-teal-400');

    $('#latestbtn').addClass('border-gray-200');
    $('#latestbtn').removeClass('border-teal-400');
  });

</script>
@endpush
