<div class="w-full">
  <div class="container mx-auto px-4 md:px-6">
    <div class="mb-6 justify-end flex border-b-2 border-gray-100">
      <div class="text-2xl dv-bold rtl border-b-2 -mb-[0.1rem] border-jungle-green pb-4 opacity-80">
        {{$heading}}
      </div>
    </div>
    <div class="w-full rtl gap-6">
      @foreach ($items as $item)
      <a href="/{{$item->id}}">
        <div class="flex -mx-3 mb-6">
          <div class="w-1/3 mx-3">
            <img class="w-full rounded-xl" src="{{$item->small_thumb}}" alt="" />
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
