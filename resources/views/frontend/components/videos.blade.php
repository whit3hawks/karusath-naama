<div class="bg-blacked w-full lg:py-12 py-6 mt-16">
  <div class="container lg:px-0 mx-auto px-4 md:px-6">
    <div class="mb-6 justify-end flex border-b-2 border-white md:mx-6">
      <div class="text-3xl text-white dv-bold rtl pb-4">
        {{$heading}}
      </div>
    </div>
    <div class="w-full grid md:grid-cols-4 rtl grid-cols-2 gap-6 md:px-6">
      @foreach ($items as $item)
      <a href="/videos/{{$item->id}}">
        <div class="w-full">
          <div class="w-full bg-gray-50 relative">
            <img class="w-full" src="{{$item->image}}" alt="">
            @if(isset($item->url))
            <div class="flex w-full h-full absolute top-0 bg-black bg-opacity-25 text-white justify-center items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 md:h-16 md:w-16" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
              </svg>
            </div>
            @endif
          </div>
          <div class="ltr flex justify-end en-font text-xs mt-4 rtl opacity-50 text-white">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
          <div class="dv-bold md:text-xl text-lg tracking-[.06em] rtl mt-2 rtl text-white opacity-80" style="line-height:40px;">{{$item->title}}</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
