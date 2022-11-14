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
<div class="container flex mx-auto">
  <div class="w-full rtl">
    @isset($featuredMain)
    <a class="w-full flex md:px-6 px-4 md:pt-12 pt-4" href="/{{$featuredMain->id}}">
      <div class="w-full lg:flex rounded-2xl overflow-hidden">
        <div class="md:w-1/2 w-full bg-gray-50 relative md:h-auto h-80" style="background-image:url('{{$featuredMain->thumb}}'); background-size:cover; background-position: center;">
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
        <div class="lg:w-1/2 w-full px-6 py-4 md:mb-0 bg-gray-50">
          <div class="dv-bold lg:text-4xl text-3xl mt-2 tracking-[.05em] rtl opacity-80 tracking-[.05em]" style="line-height: 70px;">{{$featuredMain->title}}</div>
          <div class="dv md:text-lg text-md mt-2 rtl leading-10 opacity-60" style="line-height: 40px;">{{$featuredMain->summary}}</div>
          <div class="text-sm en-font ltr text-right mt-4 opacity-50">{{Carbon\Carbon::parse($featuredMain->date)->format('d M Y')}}</div>
        </div>
      </div>
    </a>
    @endisset
    @isset($featuredMid)
    <div class="w-full flex md:px-6 px-4 md:pt-12 pt-8">
      <div class="w-full grid md:grid-cols-4 grid-cols-2 rtl gap-6">
        @foreach ($featuredMid as $item)
        <a href="/{{$item->id}}">
          <div class="w-full">
            <div class="w-full">
              <img class="w-full rounded-2xl" src="{{$item->small_thumb}}" alt="" />
            </div>
            <div class="dv-bold md:text-lg text-base tracking-[.06em] rtl mt-2 rtl opacity-80" style="line-height:38px;">{{$item->short_title ?? $item->title}}</div>
            <div class="ltr flex justify-end en-font text-xs mt-2 rtl opacity-40">
              {{Carbon\Carbon::parse($item->date)->format('d M Y')}}
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
    @endisset
  </div>
  {{-- .main --}}
</div>
<div class="container lg:px-0 mx-auto px-4 md:px-6 mt-4 md:mt-6">
  <div class="w-full lg:mx-3 lg:mt-0">
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
@include('frontend.components.newsbox-sm',["heading"=>"ރިޕޯޓް","items"=>$reports,'adv'=> $home_report_box_banner])
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
@endsection
@push('scripts')
<script>
  $('#latestbtn').click(function() {
    $('#latest-news').show();
    $('#popular-news').hide();

    $('#popularbtn').removeClass('border-jungle-green');
    $('#popularbtn').addClass('border-gray-200');

    $('#latestbtn').addClass('border-jungle-green');
    $('#latestbtn').removeClass('border-gray-200');
  });

  $('#popularbtn').click(function() {
    $('#latest-news').hide();
    $('#popular-news').show();

    $('#popularbtn').removeClass('border-gray-200');
    $('#popularbtn').addClass('border-jungle-green');

    $('#latestbtn').addClass('border-gray-200');
    $('#latestbtn').removeClass('border-jungle-green');
  });

</script>
@endpush
