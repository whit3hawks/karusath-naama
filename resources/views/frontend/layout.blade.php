<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ MetaTag::get('title') }}</title>
  @if(isset($is_news) && $is_news)
  {!! MetaTag::tag('description') !!}
  {!! MetaTag::tag('image',$news->thumb) !!}
  @else
  {!! MetaTag::tag('description') !!}
  {!! MetaTag::tag('image') !!}
  @endif
  {!! MetaTag::openGraph() !!}
  {!! MetaTag::twitterCard() !!}
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fa/css/all.min.css') }}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="/js/jquery.thaana.min.js"></script>
  <link rel="icon" type="image/x-icon" href="/favicon.png">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="{{ asset('js/share.js') }}"></script>
  {!! htmlScriptTagJsApi([
  "theme" => "light",
  "size" => "normal",
  "tabindex" => "3",
  "callback" => "callbackFunction",
  "expired-callback" => "expiredCallbackFunction",
  "error-callback" => "errorCallbackFunction",
  ]) !!}
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126248247-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-126248247-1');

  </script>
</head>
<body class="antialiased">
  <style>
    @font-face {
      font-family: typewrite;
      src: url('/fonts/mvtyper.ttf');
    }

    @font-face {
      font-family: mag;
      src: url('/fonts/mag.otf');
    }

    @font-face {
      font-family: MVWaheed;
      src: url('/fonts/MVWaheed.otf');
    }

    @font-face {
      font-family: MV Randhoo;
      src: url('/fonts/randhoo.otf');
    }

    @font-face {
      font-family: MV Aammu;
      src: url('/fonts/mv-aammu.ttf');
    }

    .bg-blacked {
      background-color: #191919;
    }

    .bg-primary {
      background-color: #f45724;
    }

    .en-font {
      font-family: "Lato";
    }

    .randhoo {
      font-family: MV Randhoo;
    }

    .waheed {
      font-family: MVWaheed;
    }

    .dv {
      font-family: 'typewrite';
    }

    .dv-bold {
      font-family: MV Aammu;
    }

    .rtl {
      direction: rtl;
    }

    .ltr {
      direction: ltr !important;
    }

    .ce-paragraph {
      font-family: "mag";
      direction: rtl;
      font-size: 18px;
    }

    h1.ce-header {
      font-family: "mag";
      direction: rtl;
      font-size: 32px;
    }

    h2.ce-header {
      font-family: "mag";
      direction: rtl;
      font-size: 28px;
    }

    h3.ce-header {
      font-family: "mag";
      direction: rtl;
      font-size: 24px;
    }

    h4.ce-header {
      font-family: "mag";
      direction: rtl;
      font-size: 23px;
    }

    h5.ce-header {
      font-family: "mag";
      direction: rtl;
      font-size: 22px;
    }

    h6.ce-header {
      font-family: "mag";
      direction: rtl;
      font-size: 20px;
    }

    .cdx-block {
      direction: rtl;
      padding: 22px,
    }

    .cdx-list__item {
      font-family: "mag";
      direction: rtl;
      font-size: 20px;
    }

    .video-container {
      position: relative;
      padding-bottom: 56.25%;
    }

    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

  </style>
  <div>
    <nav class="w-full bg-primary fixed z-50">
      <div class="container justify-between rtl h-20 mx-auto px-6 flex items-center">
        <div class="flex">
          <div class="flex items-center">
            <a href="/"><img class="h-12" src="/images/white-default-logo.png" alt="Voice Logo"></a>
          </div>
          <div class="mx-3 md:flex hidden">
            <ul class="flex">
              @foreach($menus as $menu)
              <li>
                <a href="/{{$menu->slug}}" class="px-4 flex text-lg py-10 dv-bold text-white">{{$menu->name}}</a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="flex items-center">
          <div class="flex items-center">
            <div class="cursor-pointer flex" id="search-box-button">
              <svg xmlns="http://www.w3.org/2000/svg" class="md:h-8 md:w-8 h-6 w-6 md:ml-0 ml-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
          </div>
          <div class="cursor-pointer flex md:hidden" id="mobilenavbutton">
            <svg xmlns="http://www.w3.org/2000/svg" class="md:h-8 md:w-8 h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
          </div>
        </div>
      </div>
    </nav>
    <div class="w-full bg-primary border-t fixed border-orange-500 z-40 hidden pt-20" id="mobilenav">
      <div class="w-full mx-3 flex">
        <ul class="w-full py-4">
          @foreach($menus as $menu)
          <li>
            <a href="/{{$menu->slug}}" class="px-4 justify-center flex text-lg py-4 dv-bold text-white">{{$menu->name}}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    {{-- <div class="bg-red-600 w-full">
      <div class="flex justify-end container mx-auto md:px-6 px-4">
        <div class="flex items-center">
          <a href="" class="flex dv-bold rtl text-white md:text-lg text-sm py-4" style="line-height: 36px;">ރައީސް ނަޝީދަށް އިންސާފު ހޯދައިނުދެވި ދައުލަތުގެ ތަރުތީބު ގެއްލިއްޖެ: ދިޔާނާ</a>
          <div class="bg-white rounded-lg flex items-center py-2 ml-4 px-4">
            <p class="dv-bold text-red-700 text-sm whitespace-nowrap text-white mr-2 rtl">ކަރުސަތުނާމާ ލައިވް</p>
            <div class="w-2 h-2 bg-red-700 rounded-full"></div>
          </div>
        </div>
      </div>
    </div> --}}
    <div class="w-full pt-20">
      @yield('content')
    </div>
  </div>
  <footer class="bg-blacked py-12 mt-16">
    <div class="container mx-auto px-6">
      <div class="py-6 flex justify-center">
        <div class="grid grid-cols-3 gap-6">
          <div class="bg-white rounded-full w-10 h-10 flex justify-center items-center">
            <a target="_blank" href="https://t.me/karusathnaamamedia" class="mr-1">
              <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="22px" height="22px">
                <path d="M46.137,6.552c-0.75-0.636-1.928-0.727-3.146-0.238l-0.002,0C41.708,6.828,6.728,21.832,5.304,22.445	c-0.259,0.09-2.521,0.934-2.288,2.814c0.208,1.695,2.026,2.397,2.248,2.478l8.893,3.045c0.59,1.964,2.765,9.21,3.246,10.758	c0.3,0.965,0.789,2.233,1.646,2.494c0.752,0.29,1.5,0.025,1.984-0.355l5.437-5.043l8.777,6.845l0.209,0.125	c0.596,0.264,1.167,0.396,1.712,0.396c0.421,0,0.825-0.079,1.211-0.237c1.315-0.54,1.841-1.793,1.896-1.935l6.556-34.077	C47.231,7.933,46.675,7.007,46.137,6.552z M22,32l-3,8l-3-10l23-17L22,32z" />
              </svg>
            </a>
          </div>
          <div class="bg-white rounded-full w-10 h-10 flex justify-center items-center">
            <a target="_blank" href="https://twitter.com/karusathnaamamedia">
              <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="22px" height="22px">
                <path d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z" />
              </svg>
            </a>
          </div>
          <div class="bg-white rounded-full w-10 h-10 flex justify-center items-center">
            <a target="_blank" href="https://www.facebook.com/karusathnaamamedia/">
              <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30px" height="30px">
                <path d="M15,3C8.373,3,3,8.373,3,15c0,6.016,4.432,10.984,10.206,11.852V18.18h-2.969v-3.154h2.969v-2.099c0-3.475,1.693-5,4.581-5 c1.383,0,2.115,0.103,2.461,0.149v2.753h-1.97c-1.226,0-1.654,1.163-1.654,2.473v1.724h3.593L19.73,18.18h-3.106v8.697 C22.481,26.083,27,21.075,27,15C27,8.373,21.627,3,15,3z" />
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="flex justify-center items-center">
        <a href="/karusathnaama/our-team" class="hover:underline text-white text-md text-center my-2 px-3">Our Team</a>
      </div>
      <p class="text-white text-sm text-center opacity-60 mt-6">© 2018 – 2022 Copyright | Voice Media, All Rights reserved</p>
    </div>
    <div class="flex w-full justify-center h-screen z-50 top-0 bg-white" style="position:fixed; display: none;" id="search-box">
      <div class="container md:px-6 mx-4">
        <div class="flex justify-between py-6">
          <a href="/"><img class="h-14" src="/images/white-default-logo.png" alt="Voice Logo"></a>
          <button class="bg-gray-100 w-12 h-12 rounded-full flex items-center justify-center" id="search-box-close-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
        <div class="mt-6">
          <form action="/search/news">
            <div class="flex rounded-full items-center border border-orange-600 px-6 py-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <input type="text" name="keyword" class="dv-bold text-gray-800 dv text-2xl flex items-center rtl focus:outline-none w-full px-6 py-2">
            </div>
          </form>
          @isset($search_box_banner)
          <div>
            <div class="container mx-auto mt-6">
              <div>
                <a target="_blank" target="_blank" href="{{$search_box_banner->url}}">
                  <img class="w-full" src="{{$search_box_banner->image}}" alt="Search box banner">
                </a>
                <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
              </div>
            </div>
          </div>
          @endisset
        </div>
      </div>
    </div>
  </footer>
  <script>
    $("#mobilenavbutton").click(() => {
      $("#mobilenav").toggle();
    });

    $("#search-box-close-button").click(() => {
      $("#search-box").toggle();
    });

    $("#search-box-button").click(() => {
      $("#search-box").toggle();
    });

    $('.dv').thaana({
      keyboard: 'phonetic'
    });

  </script>
  @stack('scripts')
</body>
</html>
