@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex items-center">
    <div class="flex items-center">
      <a href="{{route(config('app.admindomain').'.tags.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      <p class="rtl w-full en-font font-semibold text-2xl">Tag</p>
    </div>
  </div>
  <div class="w-full mt-6">
    @if(Route::currentRouteName() == config('app.admindomain').".tags.create")
    <form action="{{route(config('app.admindomain').'.tags.store')}}" method="POST" enctype="multipart/form-data">
      @else
      <form action="{{route(config('app.admindomain').'.tags.update',$tag->id)}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @endif
        @csrf
        @if(Route::currentRouteName() == config('app.admindomain').".tags.edit")
        <div class="mb-20 mt-6 relative flex justify-center">
          <div class="bg-gray-50 rounded-xl h-60 top-0 w-full" style="background-image: url('{{$tag->cover}}'); background-size: cover; background-position: center;">
          </div>
          <div class="w-32 h-32 bg-gray-50 rounded-full overflow-hidden border-white border-4 absolute z-50" style="background-image: url('{{$tag->image}}'); background-size: cover; background-position: center;bottom: -50px;"></div>
        </div>
        @endif
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font rtl text-sm mb-2">Name</p>
            <input type="text" class="dv-bold rtl outline-none w-full" value="{{old('name',$tag->name)}}" placeholder="" name="name" />
            @if($errors->has('name'))
            <div class="text-xs text-red-600 flex w-full items-center justify-end mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('name') }}
            </div>
            @endif
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Slug</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('slug',$tag->slug)}}" placeholder="Slug" name="slug" />
            @if($errors->has('slug'))
            <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('slug') }}
            </div>
            @endif
          </div>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 md:mt-6">
          <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
            <p class="w-full en-font text-sm mb-2">Image</p>
            <div class="flex justify-end w-full mb-1">
              <input type="file" class="w-full outline-none text-right" name="image" />
            </div>
          </div>
          <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
            <p class="w-full en-font text-sm mb-2">Cover</p>
            <div class="flex justify-end w-full mb-1">
              <input type="file" class="w-full outline-none text-right" name="cover" />
            </div>
          </div>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-6">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
            <p class="w-full en-font text-sm mb-2">Type</p>
            <select name="type" id="type" class="flex w-full focus:outline-none">
              <option value="normal" @if(old('type',$tag->type) == 'normal') selected @endif>Normal</option>
              <option value="place" @if(old('type',$tag->type) == 'place') selected @endif>Place</option>
              <option value="person" @if(old('type',$tag->type) == 'person') selected @endif>Person</option>
              <option value="island" @if(old('type',$tag->type) == 'island') selected @endif>Island</option>
              <option value="atoll" @if(old('type',$tag->type) == 'atoll') selected @endif>Atoll</option>
            </select>
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
            <p class="w-full en-font text-sm mb-2">Show in Main Menu</p>
            <select name="is_main_menu" id="is_main_menu" class="flex w-full focus:outline-none">
              <option value="no" @if(old('is_main_menu',$tag->is_main_menu) == 'no') selected @endif>No</option>
              <option value="yes" @if(old('is_main_menu',$tag->is_main_menu) == 'yes') selected @endif>Yes</option>
            </select>
          </div>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-6">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
            <p class="w-full en-font text-sm mb-2">Order</p>
            <input type="number" class="outline-none w-full" value="{{old('order',$tag->order)}}" placeholder="Order" name="order" />
            @if($errors->has('order'))
            <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('order') }}
            </div>
            @endif
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
            <p class="w-full en-font text-sm mb-2">Hide From Article</p>
            <select name="hide_from_article" id="hide_from_article" class="flex w-full focus:outline-none">
              <option value="no" @if(old('hide_from_article',$tag->hide_from_article) == 'no') selected @endif>No</option>
              <option value="yes" @if(old('hide_from_article',$tag->hide_from_article) == 'yes') selected @endif>Yes</option>
            </select>
          </div>
        </div>
        <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mt-6">
          <p class="w-full en-font rtl text-sm">Summary</p>
          <textarea type="text" class="dv-bold rtl outline-none text-lg w-full h-40" placeholder="ތައާރަފް" name="summary">{{old('summary',$tag->summary)}}</textarea>
          @if($errors->has('summary'))
          <div class="text-xs text-red-600 flex items-center mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ $errors->first('summary') }}
          </div>
          @endif
        </div>
        <div class="flex">
          <button class="bg-black text-white mt-6 rounded-lg w-24 py-3 en-font font-semibold">Save</button>
        </div>
      </form>
  </div>
</div>
@if(Route::currentRouteName() == config('app.admindomain').".tags.edit")
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center">
    <p class="w-full en-font font-semibold text-2xl">Related Tags ({{count($tag->subTags)}})</p>
    <a href="{{route(config('app.admindomain').'.tags.create')}}" class="">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
    </a>
  </div>
  <div>
    <form action="{{route(config('app.admindomain').'.tags.add-sub-tag',$tag->id)}}" method="POST">
      @csrf
      <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mt-6">
        <p class="w-full en-font text-sm mb-2">Related Tag Slug</p>
        <input type="text" class="en-font outline-none w-full" placeholder="Slug" name="slug" />
        @if($errors->has('slug'))
        <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
          {{ $errors->first('slug') }}
        </div>
        @endif
      </div>
      <div class="flex">
        <button class="bg-black text-white mt-6 whitespace-nowrap px-6 rounded-lg py-3 en-font font-semibold">Attach Tag</button>
      </div>
    </form>
  </div>
  <div class="w-full mt-6">
    <table class="table-auto rounded-lg overflow-hidden w-full">
      <thead>
        <tr class="bg-gray-100">
          <th class="text-left en-font py-4 px-6">Name</th>
          <th class="text-left en-font py-4 px-6">Slug</th>
          <th class="text-left en-font py-4 px-6"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($tag->subTags as $subTag)
        <tr class="bg-gray-50">
          <td class="text-md dv-bold py-4 px-6">{{$subTag->tag->name}}</td>
          <td class="text-md py-4 px-6">{{$subTag->tag->slug}}</td>
          <td class="dv text-sm py-4 px-6 flex justify-end">
            <a href="{{route(config('app.admindomain').'.tags.remove-sub-tag',[$tag->id,$subTag->id])}}" class="bg-red-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
              </svg>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
@endsection
