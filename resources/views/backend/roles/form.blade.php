@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex items-center">
    <div class="flex items-center">
      <a href="{{route(config('app.admindomain').'.roles.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      <p class="rtl w-full en-font font-semibold text-2xl">Role</p>
    </div>
  </div>
  <div class="w-full mt-6">
    @if(Route::currentRouteName() == config('app.admindomain').".roles.create")
    <form action="{{route(config('app.admindomain').'.roles.store')}}" method="POST" enctype="multipart/form-data">
      @else
      <form action="{{route(config('app.admindomain').'.roles.update',$role->id)}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @endif
        @csrf
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-1">Name</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('name',$role->name)}}" placeholder="User" name="name" />
          </div>
        </div>
        <div class="flex">
          <button class="bg-black text-white mt-6 rounded-lg w-24 py-3 en-font font-semibold">Save</button>
        </div>
      </form>
  </div>
</div>
@if(Route::currentRouteName() == config('app.admindomain').".roles.edit")

<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center mb-6">
    <p class="w-full en-font font-semibold text-xl">Add Permissions</p>
  </div>
  <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 gap-4">
    @foreach($allpermissions as $p)
    <a href="/roles/{{$role->id}}/permission/{{$p->name}}" class="whitespace-nowrap justify-between flex mr-4 items-center py-2 bg-gray-100 rounded-lg font-semibold text-sm en-bold px-4">
      {{$p->name}}
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
    </a>
    @endforeach
  </div>
  <div class="w-full mt-6">
    <table class="table-auto rounded-lg overflow-hidden w-full">
      <thead>
        <tr class="bg-gray-100">
          <th class="text-left en-font py-4 px-6">Name</th>
          <th class="text-left en-font py-4 px-6"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($permissions as $permission)
        <tr class="bg-gray-50">
          <td class="dv text-md en-font py-4 px-6">{{$permission->name}}</td>
          <td class="dv text-sm py-4 px-6 flex justify-end">
            <a href="{{route(config('app.admindomain').'.roles.remove.permission',[$role->id,$permission->name])}}" class="bg-red-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
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
