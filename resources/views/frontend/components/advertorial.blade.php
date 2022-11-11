<div class="w-full flex mb-6">
  <div class="container mx-auto mx-4 md:mx-6 bg-gray-50 py-4 px-4">
    <div class="mb-6 justify-end flex border-b-4 border-gray-200">
      <div class="rtl -mb-1 pb-4 opacity-80">
        <p class="dv-bold text-xl text-left font-semibold mb-1">Advertisement</p>
        <p class="text-xs text-left opacity-50">This content is created and paid for by advertisers and does not involve Voice Journalists</p>
      </div>
    </div>
    <div class="w-full rtl gap-6">
      @foreach ($items as $item)
      <a href="/{{$item->id}}">
        <div class="flex -mx-3 mb-6">
          <div class="w-1/3 mx-3">
            <img class="w-full" src="{{$item->small_thumb}}" alt="" />
          </div>
          <div class="w-2/3 mx-3">
            <div class="ltr flex justify-end text-xs en-font text-sm rtl opacity-50">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
            <div class="dv-bold text-base mt-2 rtl tracking-[.06em] leading-8 opacity-80">{{$item->short_title ?? $item->title}}</div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
