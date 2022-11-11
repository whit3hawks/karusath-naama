@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center">
    <p class="w-full en-font font-semibold text-2xl">Permissions</p>
    <a href="{{route(config('app.admindomain').'.permissions.create')}}" class="">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
    </a>
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
            <a href="{{route(config('app.admindomain').'.permissions.edit',$permission->id)}}" class="bg-black text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
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
@endsection
