@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center">
    <p class="w-full en-font font-semibold text-2xl">Advertisements</p>
    <a href="{{route(config('app.admindomain').'.advs.create')}}" class="">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
    </a>
  </div>
  <div class="w-full mt-6">
    <table class="table-auto rounded-lg overflow-hidden w-full">
      <thead>
        <tr class="bg-gray-100">
          <th class="text-left en-font py-4 px-6">Slot</th>
          <th class="text-left en-font py-4 px-6">URL</th>
          <th class="text-left en-font py-4 px-6"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($advs as $adv)
        <tr class="bg-gray-50">
          <td class="text-md en-font py-4 px-6">{{$adv->slot}}</td>
          <td class="text-md en-font py-4 px-6">{{$adv->url}}</td>
          <td class="dv text-sm py-4 px-6 flex justify-end">
            <a href="{{route(config('app.admindomain').'.advs.edit',$adv->id)}}" class="bg-black text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
            </a>
            @if($adv->status == 1)
            <a href="{{route(config('app.admindomain').'.advs.status',$adv->id)}}" class="bg-green-600 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @else
            <a href="{{route(config('app.admindomain').'.advs.status',$adv->id)}}" class="bg-gray-400 text-white mr-4 h-8 w-8 flex items-center justify-center rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-6">
    {{$advs->withQueryString()->links()}}
  </div>
</div>
@endsection
