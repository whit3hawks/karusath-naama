@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  @if(Session::has('successMessage'))
  <div class="mb-6 bg-green-100 flex text-sm font-semibold  px-6 py-4 rounded-lg items-center text-green-600">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
    </svg>
    {{ Session::get('successMessage') }}
  </div>
  @endif
  @if(Session::has('dangerMessage'))
  <div class="mb-6 bg-gray-100 flex text-sm font-semibold  px-6 py-4 rounded-lg items-center text-gray-600">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
    </svg>
    {{ Session::get('dangerMessage') }}
  </div>
  @endif
  <div class="flex justify-between items-center">
    <p class="w-full en-font font-semibold text-2xl">
      Photos ({{$photos->total()}})
    </p>
  </div>
  <div class="w-full">
    <form action="{{route(config('app.admindomain').'.media-photos.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid md:grid-cols-1 grid-cols-1 gap-4 md:mt-6">
        <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
          <p class="w-full en-font text-sm mb-2">Photo</p>
          <div class="flex justify-end w-full mb-1">
            <input type="file" class="w-full outline-none text-right" name="file" />
          </div>
        </div>
      </div>
      <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mt-6">
        <p class="w-full en-font text-sm">Image Caption</p>
        <textarea class="en outline-none text-lg w-full h-30 mt-2" placeholder="Caption" name="caption"></textarea>
        @if($errors->has('caption'))
        <div class="text-xs text-red-600 flex text-right w-full items-center mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
          {{ $errors->first('caption') }}
        </div>
        @endif
      </div>
      <div class="mt-6 flex justify-end">
        <button class="flex px-6 py-2 rounded-lg w-auto justify-center items-center bg-black text-white font-semibold">Add</button>
      </div>
    </form>
  </div>
  <div class="w-full mt-6 rounded-lg overflow-scroll">
    <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mt-12">
      @foreach($photos as $photo)
      <div class="overflow-hidden border border-gray-200 rounded-lg">
        <div class="relative">
          <img src="{{$photo->small_thumb}}" alt="">
        </div>
        <div class="en text-md ltr text-sm mt-2 px-3">
          {{$photo->caption}}
        </div>
        <div class="en-font text-xs opacity-50 ltr text-md px-3 pb-3">
          {{$photo->created_at->format('d M Y')}}
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="mt-6">
    {{$photos->withQueryString()->links()}}
  </div>
</div>
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
