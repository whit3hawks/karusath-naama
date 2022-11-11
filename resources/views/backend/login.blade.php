<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Boli</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@500;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="icon" type="image/x-icon" href="/favicon.png">
</head>

<body>
  <style>
    @font-face {
      font-family: typewrite;
      src: url('/fonts/mvtyper.ttf');
    }

    @font-face {
      font-family: mag;
      src: url('/fonts/mag.otf');
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

  </style>
  <div class="w-screen h-screen flex items-center justify-center">
    <div class="flex w-full justify-center">
      <form action="{{route(config('app.admindomain').'.auth')}}" method="POST" class="w-full flex justify-center px-6">
        @csrf
        <div class="w-full lg:w-1/4 md:w-2/4">
          <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
            </svg>
          </div>
          <p class="flex justify-center mb-6 text-2xl font-semibold">Login</p>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mb-4">
            <p class="w-full text-sm">Username</p>
            <input type="text" class="w-full outline-none" value="{{old('email')}}" placeholder="Email" name="email" />
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full text-sm">Password</p>
            <input type="password" class="w-full outline-none" value="{{old('password')}}" placeholder="Password" name="password" />
          </div>
          @if(session("errors"))
          <div class="text-red-600 mt-4 text-sm">{{ session("errors")->first('email') }}</div>
          @endif
          <input type="submit" class="bg-black w-full flex justify-center text-center items-center text-white mt-6 font-semibold rounded-lg w-24 py-3 text-sm" value="LOGIN" />
          <div class="content text-sm text-gray-400 text-center mb-12 mt-6">
            <div class="mb-1">
              Boli Content Management System 1.2.0
            </div>
            <div>
              Made with<span class="pl-1 pr-2">❤️</span>in Maldives
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
