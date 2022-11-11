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
  </div>
</body>
</html>
