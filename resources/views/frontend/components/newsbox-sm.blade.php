<div class="w-full mt-16">
  <div class="container mx-auto px-4 md:px-6">
    <div class="mb-6 justify-end flex border-b-4 border-gray-100">
      <div class="text-3xl dv-bold rtl border-b-4 -mb-1 border-teal-400 pb-4 opacity-80">
        {{$heading}}
      </div>
    </div>
    <div class="w-full grid md:grid-cols-4 grid-cols-2 rtl gap-6">
      @foreach ($items as $item)
      <a href="/{{$item->id}}">
        <div class="w-full">
          <div class="w-full">
            <img class="w-full" src="{{$item->small_thumb}}" alt="" />
          </div>
          <div class="ltr flex justify-end en-font text-sm mt-4 rtl opacity-50">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
          <div class="dv-bold md:text-lg text-base tracking-[.06em] rtl mt-2 rtl opacity-80" style="line-height:38px;">{{$item->short_title ?? $item->title}}</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
