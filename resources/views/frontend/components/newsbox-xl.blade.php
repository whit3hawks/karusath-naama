<div class="container lg:px-0 px-4 md:px-6 mx-auto mt-16">
  <div class="mb-6 justify-end flex border-b-4 border-gray-100 md:mx-6">
    <div class="text-3xl dv-bold rtl border-b-4 -mb-1 border-orange-600 pb-4 opacity-80">
      {{$heading}}
    </div>
  </div>
  <div class="w-full rtl lg:flex lg:-mx-3">
    @isset($items[0])
    <div class="lg:w-2/5 w-full lg:mx-3">
      <a href="/{{$items[0]->id}}">
        <div class="w-full bg-gray-50">
          <img class="w-full" src="{{$items[0]->thumb}}" alt="" />
        </div>
        <div class="en-font ltr text-right text-sm mt-4 opacity-50">{{Carbon\Carbon::parse($items[0]->date)->format('d M Y')}}</div>
        <div class="dv-bold lg:text-4xl text-3xl mt-2 rtl opacity-80 tracking-[.06em]" style="line-height: 58px;">{{$items[0]->title}}</div>
        <div class="dv text-md mt-2 leading-8 rtl mt-4 opacity-60 tracking-[.06em]">{{$items[0]->summary}}</div>
        @isset($items[0]->author)
        <div class="flex items-center mt-4">
          <a href="/authors/{{$items[0]->author->id}}" class="flex items-center">
            <div class="w-8 ml-2 h-8 bg-gray-100 rounded-full" style="background-image: url('{{$items[0]->author->image}}'); background-size: cover; background-position: center;"></div>
            <div>
              <div class="opacity-75 waheed">{{$items[0]->author->name}}@if($items[0]->author->is_voice_writer == 'yes'), ވޮއިސް@endif</div>
            </div>
          </a>
        </div>
        @endisset
      </a>
    </div>
    @endisset
    @php
    unset($items[0]);
    @endphp
    <div class="lg:w-3/5 w-full lg:mx-3 lg:mt-0 mt-6">
      <div>
        <div class="grid lg:grid-cols-2 grid-cols-1 gap-6 lg:mt-0 mt-6">
          @foreach ($items as $item)
          <a href="/{{$item->id}}">
            <div class="flex -mx-3">
              <div class="w-1/3 mx-3">
                <img class="w-full" src="{{$item->small_thumb}}" alt="" />
              </div>
              <div class="w-2/3 mx-3">
                <div class="text-xs en-font ltr text-right opacity-50">{{Carbon\Carbon::parse($item->date)->format('d M Y')}}</div>
                <div class="dv-bold text-base mt-2 rtl leading-8 opacity-80 tracking-[.06em]">{{$item->short_title ?? $item->title}}</div>
              </div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      <div class="mt-6">
        @isset($adv)
        <div>
          <a target="_blank" href="{{$adv->url}}">
            <img class="w-full" src="{{$adv->image}}" alt="">
          </a>
          <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
        </div>
        @endisset
      </div>
    </div>
  </div>
</div>
