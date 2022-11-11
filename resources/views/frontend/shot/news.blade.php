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
      font-family: MVWaheed;
      src: url('/fonts/MVWaheed.otf');
    }

    @font-face {
      font-family: mag;
      src: url('/fonts/mag.otf');
    }

    .dv {
      font-family: "typewrite";
    }

    .dv-bold {
      font-family: "MVWaheed";
    }

    .rtl {
      direction: rtl;
    }

  </style>
  <div class="h-screen w-screen antialiased overflow-hidden" style="background-image: url('{{$news->thumb}}'); background-size: cover; background-position: center; background-repeat:no-repeat;">
    <div class="w-full absolute justify-end z-10 bottom-0 h-auto right-0 z-50 flex items-right mb-12">
      <div class="px-16 flex justify-end item-center">
        <div>
          <p id="contentText" class="dv-bold px-6 rtl py-4 text-right w-auto bg-white bg-opacity-70 @if($isBreaking) text-gray-900 @else text-gray-900  @endif text-4xl" style="line-height: 56px;">{{$news->title ?? $news->short_title}}</p>
        </div>
        <div>
          <div class="ml-4 flex items-center" id="contentImage" style="background-color: #f45724;">
            <img src="/images/ogimagelogo.png" class="w-full" alt="">
          </div>
        </div>
      </div>
    </div>
    <script>
      var myDiv = document.getElementById('contentText'); //get #myDiv
      if (myDiv.clientHeight) {
        document.getElementById("contentImage").style.height = myDiv.clientHeight + "px";
        document.getElementById("contentImage").style.width = myDiv.clientHeight + "px";
      }

    </script>
</body>
</html>
