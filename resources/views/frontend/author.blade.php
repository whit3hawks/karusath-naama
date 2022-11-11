@extends('frontend.layout')

@section('content')
@isset($user->image)
<div class="flex justify-center container mx-auto mt-16">
  <div>
    <div class="flex justify-center">
      <div class="w-32 border-4 border-white shadow mx-4 h-32 bg-gray-100 rounded-full" style="background-image: url('{{$user->image}}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="text-4xl mt-6 text-center dv-bold rtl pb-4 opacity-80">
      {{$user->name}}
    </div>
    <div class="flex justify-center">
      <div class="dv flex justify-center text-md mt-2 text-center leading-10 rtl mt-4 mx-6 opacity-60 md:w-2/3">{{$user->about}}</div>
    </div>
  </div>
</div>
@endisset
<div class="mt-24">
  @include('frontend.components.newsbox-sm',["heading"=>$user->name,"items"=>$news])
</div>
<div class="flex justify-center mt-12">
  {{$news->withQueryString()->links()}}
</div>
@endsection
