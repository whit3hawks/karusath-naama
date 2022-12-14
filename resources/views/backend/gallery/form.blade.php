@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex items-center justify-between">
    <div class="flex items-center">
      <a href="{{route(config('app.admindomain').'.galleries.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      <p class="rtl w-full en-font font-semibold text-2xl">Gallery</p>
    </div>
    @isset($gallery)
    <div>
      @switch($gallery->status)
      @case(0)
      <div class="pl-2 pr-3 flex items-center rounded-full py-1 bg-gray-100 text-gray-600 uppercase font-semibold text-xs">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        Draft
      </div>
      @break
      @case(1)
      <div class="pl-2 pr-3 flex items-center rounded-full py-1 bg-green-100 text-green-600 uppercase font-semibold text-xs">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        Published
      </div>
      @break
      @default

      @endswitch
    </div>
    @endisset
  </div>
  <div class="w-full mt-6">
    @if(Route::currentRouteName() == config('app.admindomain').".galleries.create")
    <form action="{{route(config('app.admindomain').'.galleries.store')}}" method="POST" enctype="multipart/form-data">
      @else
      <form action="{{route(config('app.admindomain').'.galleries.update',$gallery->id)}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @endif
        @csrf
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap md:mt-0 mt-4">
            <p class="w-full en-font text-sm">Published Date</p>
            <input type="datetime-local" class="en-font outline-none" value="{{old('date',Carbon\Carbon::parse($gallery->date)->format('Y-m-d\TH:i'))}}" placeholder="????????????" name="date" />
          </div>
          <div class="border border-black rounded-xl px-4 py-2">
            <p class="w-full en-font rtl text-sm">Heading</p>
            <input type="text" class="dv-bold rtl w-full outline-none" value="{{old('title',$gallery->title)}}" placeholder="????????????????" name="title" />
            @if($errors->has('title'))
            <div class="text-xs text-red-600 flex w-full items-center justify-end mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('title') }}
            </div>
            @endif
          </div>
        </div>
        <div class="mt-6 border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6">
          <p class="w-full en-font text-sm">Latin Heading</p>
          <input type="text" class="en-font w-full outline-none" value="{{old('latin',$gallery->latin)}}" placeholder="Latin" name="latin" />
          @if($errors->has('latin'))
          <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ $errors->first('latin') }}
          </div>
          @endif
        </div>
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4 mt-4">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font rtl text-sm">Summary</p>
            <textarea type="text" class="dv-bold w-full rtl outline-none h-60" placeholder="????????????????" name="description">{{old('description',$gallery->description)}}</textarea>
            @if($errors->has('description'))
            <div class="text-xs text-red-600 flex w-full items-center justify-end mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('description') }}
            </div>
            @endif
          </div>
        </div>
        @isset($gallery->image)
        <div class="flex items-center py-8 justify-center overflow-hidden">
          <img class="mt-4 h-60" src="{{$gallery->image}}" alt="" />
        </div>
        @endisset
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4 md:mt-6">
          <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
            <p class="w-full en-font text-sm mb-2">Cover</p>
            <div class="flex justify-end w-full mb-1">
              <input type="file" class="w-full outline-none text-right" name="file" />
            </div>
          </div>
        </div>
        <div class="flex flex-wrap">
          <button class="bg-black text-white mt-6 rounded-lg w-24 py-3 en-font font-semibold">Save</button>
        </div>
      </form>
  </div>
</div>
{{-- images --}}
@if(Route::currentRouteName() == config('app.admindomain').".galleries.edit")
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center">
    <p class="w-full en-font text-xl font-semibold">Images</p>
  </div>
  <div>
    <form action="{{route(config('app.admindomain').'.galleries.images.store',$gallery->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid md:grid-cols-1 grid-cols-1 gap-4 md:mt-6">
        <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
          <p class="w-full en-font text-sm mb-2">Photo</p>
          <div class="flex justify-end w-full pb-1">
            <input type="file" class="w-full outline-none text-right" name="files[]" multiple />
          </div>
          @if($errors->has('files'))
          <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ $errors->first('files') }}
          </div>
          @endif
        </div>
        <div class="flex">
          <button onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" class="bg-black text-white mt-6 rounded-lg w-24 py-3 en-font font-semibold">Add</button>
        </div>
      </div>
    </form>
  </div>
  <div class="w-full mt-6">
    <div class="grid rtl grid-cols-4 gap-6">
      @foreach($images as $image)
      <div class="relative">
        <a href="{{route(config('app.admindomain').'.galleries.images.delete',[$gallery->id,$image->id])}}" class="p-2 rounded-lg text-white bg-red-600 absolute top-0 right-0 m-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </a>
        <img src="{{$image->image}}" alt="">
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif
@endsection
@push('scripts')
<script>
  $("body").on("submit", "form", function() {
    $(this).submit(function() {
      return false;
    });
    return true;
  });

</script>
@endpush
