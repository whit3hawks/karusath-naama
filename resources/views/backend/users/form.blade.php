@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex items-center">
    <div class="flex items-center">
      <a href="{{route(config('app.admindomain').'.users.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
        </svg>
      </a>
      <p class="rtl w-full en-font font-semibold text-2xl">User</p>
    </div>
  </div>
  <div class="w-full mt-6">
    @if(Route::currentRouteName() == config('app.admindomain').".users.create")
    <form action="{{route(config('app.admindomain').'.users.store')}}" method="POST" enctype="multipart/form-data">
      @else
      <form action="{{route(config('app.admindomain').'.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @endif
        @csrf
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font rlt text-sm mb-2">Name</p>
            <input type="text" class="dv-bold rtl en-font outline-none w-full" value="{{old('name',$user->name)}}" placeholder="" name="name" />
            @if($errors->has('name'))
            <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('name') }}
            </div>
            @endif
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Email</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('email',$user->email)}}" placeholder="Email" name="email" />
            @if($errors->has('email'))
            <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('email') }}
            </div>
            @endif
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Slug</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('slug',$user->slug)}}" placeholder="Slug" name="slug" />
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
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mt-6">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Facebook</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('name',$user->facebook)}}" placeholder="https://facebook.com/[username]" name="facebook" />
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Twitter</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('twitter',$user->twitter)}}" placeholder="https://twitter.com/[username]" name="twitter" />
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Title</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('title',$user->title)}}" placeholder="Title" name="title" />
            @if($errors->has('title'))
            <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('title') }}
            </div>
            @endif
          </div>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-6">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
            <p class="w-full en-font text-sm mb-2">Team Memeber</p>
            <select name="is_team_member" id="is_team_member" class="flex w-full focus:outline-none">
              <option value="no" @if(old('is_team_member',$user->is_team_member) == 'no') selected @endif>No</option>
              <option value="yes" @if(old('is_team_member',$user->is_team_member) == 'yes') selected @endif>Yes</option>
            </select>
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
            <p class="w-full en-font text-sm mb-2">Our Employee</p>
            <select name="is_voice_writer" id="is_voice_writer" class="flex w-full focus:outline-none">
              <option value="no" @if(old('is_voice_writer',$user->is_voice_writer) == 'no') selected @endif>No</option>
              <option value="yes" @if(old('is_voice_writer',$user->is_voice_writer) == 'yes') selected @endif>Yes</option>
            </select>
          </div>
        </div>
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4 mt-6">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm mb-2">Team Page Order</p>
            <input type="text" class="en-font outline-none w-full" value="{{old('order',$user->order)}}" placeholder="0" name="order" />
            @if($errors->has('order'))
            <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('order') }}
            </div>
            @endif
          </div>
        </div>
        <div class="border border-black mt-6 rounded-xl px-4 py-2 flex flex-wrap justify-end">
          <p class="w-full en-font rtl text-sm">About</p>
          <textarea type="text" class="dv-bold rtl outline-none text-lg w-full h-40" placeholder="ތައާރަފް" name="about">{{old('about',$user->about)}}</textarea>
        </div>
        @isset($user->image)
        <div class="flex items-center py-8 justify-center overflow-hidden">
          <img class="mt-4 h-60 bg-gray-100" src="{{$user->image}}" alt="" />
        </div>
        @endisset
        <div class="grid md:grid-cols-1 grid-cols-1 gap-4 md:mt-6">
          <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
            <p class="w-full en-font text-sm mb-2">Image</p>
            <div class="flex justify-end w-full mb-1">
              <input type="file" class="w-full outline-none text-right" name="image" />
            </div>
          </div>
        </div>
        <div class="border border-black mt-6 rounded-xl px-4 py-2 flex flex-wrap justify-end">
          <p class="w-full en-font text-sm mb-2">New Password</p>
          <input type="text" class="en-font outline-none w-full" placeholder="Password" name="password" />
          @if($errors->has('password'))
          <div class="text-xs text-red-600 flex w-full items-center justify-start mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ $errors->first('password') }}
          </div>
          @endif
        </div>
        <div class="flex">
          <button class="bg-black text-white mt-6 rounded-lg w-24 py-3 en-font font-semibold">Save</button>
        </div>
      </form>
  </div>
</div>
@if(Route::currentRouteName() == config('app.admindomain').".users.edit")
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center mb-6">
    <p class="w-full en-font font-semibold text-xl">Add Role</p>
  </div>
  <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 gap-4">
    @foreach($roles as $role)
    <a href="/users/{{$user->id}}/role/{{$role->name}}" class="whitespace-nowrap justify-between flex mr-4 items-center py-2 bg-gray-100 rounded-lg font-semibold text-sm en-bold px-4">
      {{$role->name}}
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
        @foreach($userroles as $userrole)
        <tr class="bg-gray-50">
          <td class="dv text-md en-font py-4 px-6">{{$userrole->name}}</td>
          <td class="dv text-sm py-4 px-6 flex justify-end">
            <a href="{{route(config('app.admindomain').'.users.remove.role',[$user->id,$userrole->name])}}" class="bg-red-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
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
