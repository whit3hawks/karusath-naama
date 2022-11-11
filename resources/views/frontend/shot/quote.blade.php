<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>News</title>
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
  <div class="h-screen antialiased overflow-hidden">
    <div class="w-2/4 absolute z-10 top-20 left-0 z-50 flex items-center">
      <div class="w-full px-12 flex justify-right rtl">
        <div>
          <p class="dv-bold px-6 py-6 text-right rtl w-full text-white text-5xl" style="line-height: 80px;">{{$quote->quote}}</p>
          <div class="border-t-4 border-orange-600 h-2 ml-40 mt-8 mr-6"></div>
          <p class="dv-bold px-6 py-6 text-right w-full rtl text-white text-4xl" style="line-height: 50px;">{{$quote->by}}</p>
        </div>
      </div>
    </div>
    <div class="overflow-hidden bg-gray-200 h-full w-full absolute z-10 top-0 left-0" style="background-image: url('{{$quote->image}}'); background-size: cover; background-position: center;">
      <div class="bg-black bg-opacity-50 w-full h-full"></div>
    </div>
    <div class="absolute top-0 z-20 left-0 w-full h-full">
      <img src="/images/quote.png" class="w-full h-full" alt="" />
    </div>
  </div>
</body>
</html>
