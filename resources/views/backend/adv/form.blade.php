@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex items-center">
    <div class="flex items-center">
      <a href="{{route(config('app.admindomain').'.advs.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      <p class="rtl w-full en-font font-semibold text-2xl">Advertisement</p>
    </div>
  </div>
  <div class="w-full mt-6">
    @if(Route::currentRouteName() == config('app.admindomain').".advs.create")
    <form action="{{route(config('app.admindomain').'.advs.store')}}" method="POST" enctype="multipart/form-data">
      @else
      <form action="{{route(config('app.admindomain').'.advs.update',$adv->id)}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @endif
        @csrf
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
            <p class="w-full en-font text-sm mb-2">Type</p>
            <select name="slot" id="slot" class="flex w-full focus:outline-none">
              <option value="home_top_banner" @if(old('slot',$adv->slot) == 'home_top_banner') selected @endif>Home top Banner</option>
              <option value="home_featured_box_banner" @if(old('slot',$adv->slot) == 'home_featured_box_banner') selected @endif>Home Featured Box Banner</option>
              <option value="home_latest_box_banner" @if(old('slot',$adv->slot) == 'home_latest_box_banner') selected @endif>Home Latest Box Banner</option>
              <option value="home_report_box_banner" @if(old('slot',$adv->slot) == 'home_report_box_banner') selected @endif>Home Report Box Banner</option>
              <option value="home_religion_box_banner" @if(old('slot',$adv->slot) == 'home_religion_box_banner') selected @endif>Home Religion Box Banner</option>
              <option value="home_latest_box_top_banner" @if(old('slot',$adv->slot) == 'home_latest_box_top_banner') selected @endif>Home Latest Top Banner</option>
              <option value="home_sports_box_top_banner" @if(old('slot',$adv->slot) == 'home_sports_box_top_banner') selected @endif>Home Sports Top Banner</option>
              <option value="home_gallery_box_top_banner" @if(old('slot',$adv->slot) == 'home_gallery_box_top_banner') selected @endif>Home Gallery Top Banner</option>
              <option value="home_business_box_banner" @if(old('slot',$adv->slot) == 'home_business_box_banner') selected @endif>Home Business Box Banner</option>
              <option value="home_bottom_banner" @if(old('slot',$adv->slot) == 'home_bottom_banner') selected @endif>Home Bottom Banner</option>
              <option value="tag_top_banner" @if(old('slot',$adv->slot) == 'tag_top_banner') selected @endif>Tag Top Banner</option>
              <option value="tag_bottom_banner" @if(old('slot',$adv->slot) == 'tag_bottom_banner') selected @endif>Tag Bottom Banner</option>
              <option value="article_top_banner" @if(old('slot',$adv->slot) == 'article_top_banner') selected @endif>Article Top Banner</option>
              <option value="article_side_top" @if(old('slot',$adv->slot) == 'article_side_top') selected @endif>Article Side Top</option>
              <option value="article_side_bottom" @if(old('slot',$adv->slot) == 'article_side_bottom') selected @endif>Article Side Bottom</option>
              <option value="article_inside" @if(old('slot',$adv->slot) == 'article_inside') selected @endif>Article Inside</option>
              <option value="comment_box_top_banner" @if(old('slot',$adv->slot) == 'comment_box_top_banner') selected @endif>Comment Box Top Banner</option>
              <option value="search_box_banner" @if(old('slot',$adv->slot) == 'search_box_banner') selected @endif>Search Box Banner</option>
              <option value="search_box_logo" @if(old('slot',$adv->slot) == 'search_box_logo') selected @endif>Search Box Logo</option>
              <option value="tag_specific_top_banner" @if(old('slot',$adv->slot) == 'tag_specific_top_banner') selected @endif>Tag Specific Top Banner</option>
            </select>
          </div>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-6">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">URL</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('url',$adv->url)}}" placeholder="http://advimagepath.com" name="url" />
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Tag ID (Optional)</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('tag_id',$adv->tag_id)}}" placeholder="eg. 1" name="tag_id" />
          </div>
        </div>
        @isset($adv->image)
        <div class="mb-6 mt-6 relative flex justify-center">
          <img src="{{$adv->image}}" class="w-full" alt="">
        </div>
        @endisset
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4 md:mt-6">
          <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
            <p class="w-full en-font text-sm mb-2">Image</p>
            <div class="flex justify-end w-full mb-1">
              <input type="file" class="w-full outline-none text-right" name="file" />
            </div>
          </div>
        </div>
        <div class="flex">
          <button class="bg-black text-white mt-6 rounded-lg w-24 py-3 en-font font-semibold">Save</button>
        </div>
      </form>
  </div>
</div>
@endsection
