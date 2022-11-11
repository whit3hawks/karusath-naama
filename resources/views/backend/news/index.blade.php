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
      News ({{$news->total()}})
    </p>
    <a href="{{route(config('app.admindomain').'.news.create')}}" class="">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
    </a>
  </div>
  {{-- stats --}}
  @hasanyrole('admin|editor')
  <div class="py-6">
    <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
      <div class="bg-gray-50 rounded-lg overflow-hidden flex items-center">
        <div class="text-white bg-teal-400 flex items-center py-6 px-6 justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
          </svg>
        </div>
        <div class="px-6">
          <div class="font-semibold text-2xl">{{$total_news}}</div>
          <div class="opacity-50">articles</div>
        </div>
      </div>
      <div class="bg-gray-50 rounded-lg overflow-hidden flex items-center">
        <div class="text-white bg-cyan-400 flex items-center py-6 px-6 justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
          </svg>
        </div>
        <div class="px-6">
          <div class="font-semibold text-2xl">{{$total_comments}}</div>
          <div class="opacity-50">comments</div>
        </div>
      </div>
      <div class="bg-gray-50 rounded-lg overflow-hidden flex items-center">
        <div class="text-white bg-blue-400 flex items-center py-6 px-6 justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
        <div class="px-6">
          <div class="font-semibold text-2xl">{{$total_photos}}</div>
          <div class="opacity-50">photos</div>
        </div>
      </div>
    </div>
  </div>
  @endhasanyrole
  {{-- .stats --}}
  @hasanyrole('admin|editor')
  <form action="{{url()->current()}}">
    <div class="grid md:grid-cols-3 grid-cols-1 md:gap-6 gap-4">
      <div class="bg-gray-100 rounded-xl px-4 py-2 flex flex-wrap md:mt-0 mt-4">
        <p class="w-full en-font text-sm">Form</p>
        <input type="datetime-local" class="bg-gray-100 en-font w-full outline-none" @if(isset(request()->from)) value="{{Carbon\Carbon::parse(request()->from)->format('Y-m-d\TH:i')}}" @endif placeholder="Date" name="from" />
      </div>
      <div class="bg-gray-100 rounded-xl px-4 py-2 flex flex-wrap md:mt-0 mt-4">
        <p class="w-full en-font text-sm">To</p>
        <input type="datetime-local" class="bg-gray-100 w-full en-font outline-none" @if(isset(request()->to)) value="{{Carbon\Carbon::parse(request()->to)->format('Y-m-d\TH:i')}}" @endif placeholder="Date" name="to" />
      </div>
      <div class="bg-gray-100 rounded-xl px-4 py-2 flex flex-wrap md:mt-0 mt-4">
        <p class="w-full text-sm mb-2">Author</p>
        <select name="author_id" id="author_id" class="bg-gray-100 flex dv-bold w-full focus:outline-none">
          <option value="">Author</option>
          @foreach($authors as $author)
          <option value="{{$author->id}}" @if(isset(request()->author_id) && old('author_id',$author->id) == request()->author_id) selected @endif>{{$author->name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="flex justify-end">
      <button class="px-6 py-2 mt-6 rounded-lg text-white bg-black en-font">Filter</button>
      <a href="{{url()->current()}}" class="px-6 py-2 mt-6 rounded-lg text-black bg-gray-200 en-font ml-6">Clear</a>
    </div>
  </form>
  @endhasanyrole
  <div class="w-full mt-6 rounded-lg overflow-scroll">
    <table class="table-auto w-full">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="en-font py-4 px-6">#</th>
          <th class="en-font py-4 px-6">Heading</th>
          <th class="en-font py-4 px-6">Tags</th>
          <th class="en-font py-4 px-6">Author</th>
          <th class="en-font py-4 px-6">Published Date</th>
          @hasanyrole('admin|editor')
          <th class="en-font py-4 px-6">Visits</th>
          @endhasanyrole
          <th class="en-font py-4 px-6"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($news as $post)
        <tr class="bg-gray-50">
          <td class="dv text-md rtl text-left dv-bold py-4 px-6">{{$post->id}}</td>
          <td class="dv text-md text-left dv-bold py-4 px-6 whitespace-nowrap">
            <div class="rtl">
              {{$post->title}}
            </div>
            <div class="en-font w-1/2 ltr text-md opacity-50">
              {{substr($post->latin, 0,40)}}...
            </div>
          </td>
          <td class="dv text-md text-left dv-bold py-4 px-6 whitespace-nowrap">
            <div class="flex flex-wrap" style="width:250px;">
              @foreach($post->tags as $tag)
              <div class="flex items-center text-xs whitespace-none my-2 bg-gray-200 px-4 py-1 rounded-full mr-2"><span class="mr-1 text-orange-600">#</span>{{$tag->name}}</div>
              @endforeach
            </div>
          </td>
          <td class="dv text-md rtl text-left dv-bold py-4 px-6">{{isset($post->author) ? $post->author->name : ""}}</td>
          <td class="dv text-md en-font text-sm whitespace-nowrap py-4 px-6">{{Carbon\Carbon::parse($post->date)->format('d/m/Y H:i')}}</td>
          @hasanyrole('admin|editor')
          <td class="dv text-md en-font text-sm whitespace-nowrap py-4 px-6">{{$post->visits}}</td>
          @endhasanyrole
          <td class="dv text-sm py-4 px-4 flex justify-end">
            @if($post->status != 1)
            <a href="{{route(config('app.admindomain').'.news.edit',$post->id)}}" class="bg-black text-white mr-3 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
            </a>
            @endif
            @hasanyrole('admin|editor')
            @if($post->status == 1)
            <a href="{{route(config('app.admindomain').'.news.edit',$post->id)}}" class="bg-black text-white mr-3 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
            </a>
            @endif
            @endhasanyrole
            <a href="{{route(config('app.admindomain').'.news.live-blog.index',$post->id)}}" class="bg-black text-white mr-3 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
              </svg>
            </a>
            @hasanyrole('admin|editor')
            @if(request()->status == 2 || request()->status == 1 || $post->status == 1 || $post->status == 2)
            @if($post->status == 1)
            <a href="{{route(config('app.admindomain').'.news.status',$post->id)}}" class="bg-green-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @else
            <a href="{{route(config('app.admindomain').'.news.status',$post->id)}}" class="bg-gray-400 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @endif
            @endif
            @endhasanyrole
            @hasanyrole('admin|editor')
            @if($post->status == 0)
            <form method="POST" action="{{route(config('app.admindomain').'.news.destroy',$post->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button onclick="return confirm('Are you sure you want to delete this article')" class="bg-red-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
                <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 0 48 48" width="18">
                  <path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4V14H12v24zM38 8h-7l-2-2H19l-2 2h-7v4h28V8z" />
                  <path d="M0 0h48v48H0z" fill="none" /></svg>
              </button>
            </form>
            @endif
            @endhasanyrole
            {{-- @hasanyrole('admin|editor')
            @if($post->status == 1)
            <a href="{{route(config('app.admindomain').'.news.tweet',$post->id)}}" class="@if($post->twitter_notified == 1) bg-blue-400 @else bg-gray-200 @endif text-white mr-3 h-8 w-8 flex items-center justify-center rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="14" height="14" viewBox="0 0 24 24">
              <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" /></svg>
            </a>
            @endif
            @endhasanyrole --}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-6">
    {{$news->withQueryString()->links()}}
  </div>
  <div class="border-t border-gray-100 pt-6 mt-4">
    <a href="remove-breakings" class="flex items-center hover:underline text-sm">Click to Remove all Breakings</a>
  </div>
</div>
@endsection
