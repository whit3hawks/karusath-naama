<div class="w-full mt-16">
  <div class="container mx-auto px-4 md:px-6">
    <div class="mb-6 justify-end flex border-b-4 border-gray-100">
      <div class="text-3xl dv-bold rtl border-b-4 -mb-1 border-jungle-green pb-4 opacity-80">
        {{$heading}}
      </div>
    </div>
    <div class="w-full grid md:grid-cols-4 grid-cols-2 rtl gap-6">
      @foreach ($items as $item)
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
</div>
