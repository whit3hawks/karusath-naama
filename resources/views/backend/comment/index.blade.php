@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center">
    <p class="w-full en-font font-semibold text-2xl">Comments ({{$comments->total()}})</p>
  </div>
  <div class="w-full mt-6 overflow-scroll rounded-lg">
    <table class="table-auto w-full">
      <thead>
        <tr class="bg-gray-100">
          <th class="text-left en-font py-4 px-6">#</th>
          <th class="text-left en-font py-4 px-6">Name</th>
          <th class="text-left en-font py-4 px-6">Comment</th>
          <th class="text-left en-font py-4 px-6">Date</th>
          <th class="text-left en-font py-4 px-6"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($comments as $comment)
        <tr class="bg-gray-50">
          <td class="text-md rtl text-left dv-bold py-4 px-6">{{$comment->id}}</td>
          <td class="text-md rtl text-left dv-bold py-4 px-6">{{$comment->name}}</td>
          <td class="text-md text-left dv-bold rtl py-4 px-6">
            <a href="{{env('APP_URL')}}/{{$comment->news->id}}" class="hover:underline justify-end flex mb-2 text-md text-gray-600">{{$comment->news->title}}</a>
            <div class="whitespace-nowrap">{{$comment->comment}}</div>
          </td>
          <td class="text-md py-4 px-6 text-sm whitespace-nowrap">{{$comment->created_at->format('d-M-Y H:i')}}</td>
          <td class="dv text-sm py-4 px-6 flex justify-end">
            @if($comment->status == 1)
            <a href="{{route(config('app.admindomain').'.comments.status',$comment->id)}}" class="bg-green-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @else
            <a href="{{route(config('app.admindomain').'.comments.status',$comment->id)}}" class="bg-gray-400 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @endif
            @hasanyrole('admin|editor')
            <form method="POST" action="{{route(config('app.admindomain').'.comments.destroy',$comment->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button onclick="return confirm('Are you sure you want to delete this comment?')" class="bg-red-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
                <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 0 48 48" width="18">
                  <path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4V14H12v24zM38 8h-7l-2-2H19l-2 2h-7v4h28V8z" />
                  <path d="M0 0h48v48H0z" fill="none" /></svg>
              </button>
            </form>
            @endhasanyrole
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-6">
    {{$comments->withQueryString()->links()}}
  </div>
</div>
@endsection
