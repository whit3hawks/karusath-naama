<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{config('app.name')}}</title>
  @if(Route::currentRouteName() == config('app.admindomain').".news.edit")
  <script src="{{ asset('js/app.js') }}" defer></script>
  @endif
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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

    .en-font {
      font-family: "Lato";
    }

    .dv {
      font-family: "typewrite";
    }

    .dv-bold {
      font-family: "mag";
    }

    .rtl {
      direction: rtl;
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

    .cdx-input {
      direction: rtl;
      font-family: "mag";
      padding: 20px,
    }

  </style>
  <menu class="border-b border-gray-200">
    <div class="container flex justify-between mx-auto px-6">
      <div class="py-6 flex text-lg font-semibold items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 mr-2 w-8" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
        </svg>
        <div>
          Boli
        </div>
        <div class="ml-6 border-l border-gray-200 pl-4">
          <form action="?{{http_build_query(request()->all())}}">
            <input type="text" name="keyword" placeholder="Search..." class="bg-gray-100 focus:outline-none rounded-full px-6 py-2 text-sm">
          </form>
        </div>
      </div>
      <div class="flex items-center">
        <ul class="md:flex hidden items-center">
          @include('backend.components.navlinks',['mobile'=>false])
        </ul>
        <div class="cursor-pointer md:hidden block" id="togglemobilenav">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </div>
      </div>
    </div>
  </menu>
  {{-- mobile --}}
  <div class="flex border-b border-gray-200 hidden" id="mobilenav">
    <div class="container mx-auto flex">
      <ul class="w-full">
        @include('backend.components.navlinks',['mobile'=>true])
      </ul>
    </div>
  </div>
  {{-- .mobile --}}
  {{-- sub --}}
  @if(Route::currentRouteName() == config('app.admindomain').".news.index" || Route::currentRouteName() == config('app.admindomain').".news.published-news" || Route::currentRouteName() == config('app.admindomain').".news.editorbox-news")
  <div class="flex border-b border-gray-200">
    <div class="container mx-auto flex justify-center px-6">
      <ul class="flex">
        <li><a class="px-4 py-4 flex font-semibold items-center en-font text-md @if(Route::current()->getName() == config('app.admindomain').'.news.published-news') underline @endif" href="{{route(config('app.admindomain').'.news.published-news')}}">Published</a></li>
        <li><a class="px-4 py-4 flex font-semibold items-center en-font text-md @if(Route::current()->getName() == config('app.admindomain').'.news.index') underline @endif" href="{{route(config('app.admindomain').'.news.index')}}">Drafts</a></li>
        @hasanyrole('admin|editor')
        <li><a class="px-4 py-4 flex font-semibold items-center en-font text-md @if(Route::current()->getName() == config('app.admindomain').'.news.editorbox-news') underline @endif" href="{{route(config('app.admindomain').'.news.editorbox-news')}}">Editor Box</a></li>
        @endhasanyrole
      </ul>
    </div>
  </div>
  @endif
  @hasanyrole('admin')
  @if(Route::currentRouteName() == config('app.admindomain').".roles.index" || Route::currentRouteName() == config('app.admindomain').".permissions.index" || Route::currentRouteName() == config('app.admindomain').".users.index")
  <div class="flex border-b border-gray-200">
    <div class="container mx-auto flex justify-center px-6">
      <ul class="flex">
        <li><a class="px-4 py-4 flex font-semibold items-center en-font text-md @if(Route::current()->getName() == config('app.admindomain').'.users.index') underline @endif" href="{{route(config('app.admindomain').'.users.index',['show'=>'published'])}}">Users</a></li>
        <li><a class="px-4 py-4 flex font-semibold items-center en-font text-md @if(Route::current()->getName() == config('app.admindomain').'.roles.index') underline @endif" href="{{route(config('app.admindomain').'.roles.index',['show'=>'published'])}}">Roles</a></li>
        {{-- <li><a class="px-4 py-4 flex font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.permissions.index',['show'=>'drafts'])}}">Permissions</a></li> --}}
      </ul>
    </div>
  </div>
  @endif
  @endhasanyrole
  {{-- .sub --}}
  <div id="app">
    @yield('content')
  </div>
  <div class="content text-sm text-gray-400 text-center mb-12">
    <div class="mb-1">
      Boli Content Management System 1.2.0
    </div>
    <div>
      Made with<span class="pl-1 pr-2">❤️</span>by <a target="_blank" class="en-font font-semibold" href="https://whit3hawks.com">Sharif Khaleel</a>
    </div>
  </div>
  <script>
    $("#togglemobilenav").click(function() {
      $("#mobilenav").toggle('medium');
    });
    $('.dv').thaana({
      keyboard: 'phonetic'
    });
    $('.dv-bold').thaana({
      keyboard: 'phonetic'
    });

    $('.ce-paragraph').thaana({
      keyboard: 'phonetic'
    });

  </script>
  @stack('scripts')
</body>
</html>
