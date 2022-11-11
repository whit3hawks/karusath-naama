@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex items-center">
    <div class="flex items-center">
      <a href="{{route(config('app.admindomain').'.permissions.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      <p class="rtl w-full en-font font-semibold text-2xl">Permission</p>
    </div>
  </div>
  <div class="w-full mt-6">
    @if(Route::currentRouteName() == config('app.admindomain').".permissions.create")
    <form action="{{route(config('app.admindomain').'.permissions.store')}}" method="POST" enctype="multipart/form-data">
      @else
      <form action="{{route(config('app.admindomain').'.permissions.update',$permission->id)}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @endif
        @csrf
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-1">Name</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('name',$permission->name)}}" placeholder="User" name="name" />
          </div>
        </div>
        <div class="flex">
          <button class="bg-black text-white mt-6 rounded-lg w-24 py-3 en-font font-semibold">Save</button>
        </div>
      </form>
  </div>
</div>
@endsection
