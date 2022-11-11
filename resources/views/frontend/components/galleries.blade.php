<div class="bg-blacked w-full lg:py-12 py-6 mt-16">
  <div class="container lg:px-0 mx-auto px-4 md:px-6">
    <div class="mb-6 justify-end flex border-b-4 border-gray-100 md:mx-6">
      <div class="text-3xl text-white dv-bold rtl border-b-4 -mb-1 border-white pb-4">
        {{$heading}}
      </div>
    </div>
    <div class="w-full grid md:grid-cols-4 grid-cols-2 rtl gap-6 md:px-6">
      @foreach ($items as $item)
      <a href="/galleries/{{$item->id}}">
        <div class="w-full">
          <div class="w-full">
            <img class="w-full" src="{{$item->image}}" alt="">
          </div>
          <div class="ltr flex text-white justify-end en-font text-xs mt-4 rtl opacity-50">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
          <div class="dv-bold md:text-xl text-lg tracking-[.06em] rtl mt-2 rtl opacity-80 text-white" style="line-height:40px;">{{$item->title}}</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
