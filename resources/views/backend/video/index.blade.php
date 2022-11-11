@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center">
    <p class="w-full en-font font-semibold text-2xl">Videos</p>
    <a href="{{route(config('app.admindomain').'.videos.create')}}" class="">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
    </a>
  </div>
  <div class="w-full mt-6 rounded-lg overflow-scroll">
    <table class="table-auto w-full">
      <thead>
        <tr class="bg-gray-100">
          <th class="text-left en-font py-4 px-6">Heading</th>
          <th class="text-left en-font py-4 px-6">Published Date</th>
          <th class="text-left en-font py-4 px-6"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($videos as $video)
        <tr class="bg-gray-50">
          <td class="dv text-md dv-bold whitespace-nowrap py-4 px-6">{{$video->title}}</td>
          <td class="dv text-md en-font text-sm whitespace-nowrap py-4 px-6">{{Carbon\Carbon::parse($video->date)->format('d/m/Y H:i')}}</td>
          <td class="dv text-sm py-4 px-6 flex justify-end">
            <a href="{{route(config('app.admindomain').'.videos.edit',$video->id)}}" class="bg-black text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
            </a>
            @hasanyrole('admin|editor')
            @if($video->status == 1)
            <a href="{{route(config('app.admindomain').'.videos.status',$video->id)}}" class="bg-green-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @else
            <a href="{{route(config('app.admindomain').'.videos.status',$video->id)}}" class="bg-gray-400 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @endif
            @endhasanyrole
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-6">
    {{$videos->withQueryString()->links()}}
  </div>
</div>
@endsection
