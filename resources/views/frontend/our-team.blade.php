@extends('frontend.layout')

@section('content')
<div class="mt-16">
  <div class="container mx-auto md:px-6 px-4">
    <div class="mb-6 justify-end flex border-b-4 border-gray-100">
      <div class="text-3xl dv-bold rtl border-b-4 -mb-1 border-jungle-green pb-4 opacity-80">
        ކަރުސަތުނާމާ ޓީމް
      </div>
    </div>
    <div class="grid md:grid-cols-4 grid-cols-2 md:gap-6 gap-4 rtl mt-8">
      @foreach($members as $member)
      <a href="/authors/{{$member->id}}">
        <div>
          <div class="flex justify-center items-center py-8">
            <div class="h-32 w-32 rounded-full" style="background-image: url('{{$member->image}}'); background-size: cover; background-position: center;"></div>
          </div>
          <div class="text-xl dv-bold w-full rtl text-center -mb-1 opacity-80">
            {{$member->name}}
          </div>
          <div class="text-md en-bold opacity-50 w-full rtl text-center -mb-1 opacity-80 mt-4">
            {{$member->title}}
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
@endsection
