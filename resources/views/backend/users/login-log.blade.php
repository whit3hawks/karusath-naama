@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex justify-between items-center">
    <div>
      <p class="w-full en-font font-semibold text-2xl">Login Log ({{$logs->total()}})</p>
      <p class="w-full en-font opacity-50 text-lg">{{$user->email}}</p>
    </div>
  </div>
  <form action="{{url()->current()}}" class="mt-6">
    <div class="grid md:grid-cols-2 grid-cols-1 md:gap-6 gap-4">
      <div class="bg-gray-100 rounded-xl px-4 py-2 flex flex-wrap md:mt-0 mt-4">
        <p class="w-full en-font text-sm">Form</p>
        <input type="datetime-local" class="bg-gray-100 en-font w-full outline-none" @if(isset(request()->from)) value="{{Carbon\Carbon::parse(request()->from)->format('Y-m-d\TH:i')}}" @endif placeholder="Date" name="from" />
      </div>
      <div class="bg-gray-100 rounded-xl px-4 py-2 flex flex-wrap md:mt-0 mt-4">
        <p class="w-full en-font text-sm">To</p>
        <input type="datetime-local" class="bg-gray-100 w-full en-font outline-none" @if(isset(request()->to)) value="{{Carbon\Carbon::parse(request()->to)->format('Y-m-d\TH:i')}}" @endif placeholder="Date" name="to" />
      </div>
    </div>
    <div class="flex justify-end">
      <button class="px-6 py-2 mt-6 rounded-lg text-white bg-black en-font">Filter</button>
      <a href="{{url()->current()}}" class="px-6 py-2 mt-6 rounded-lg text-black bg-gray-200 en-font ml-6">Clear</a>
    </div>
  </form>
  <div class="w-full mt-6">
    <table class="table-auto rounded-lg overflow-hidden w-full">
      <thead>
        <tr class="bg-gray-100">
          <th class="text-left en-font py-4 px-6">Name</th>
          <th class="text-left en-font py-4 px-6">Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach($logs as $log)
        <tr class="bg-gray-50">
          <td class="dv-bold text-md py-4 px-6">{{$log->user->name}}</td>
          <td class="en-font text-md py-4 px-6">{{$log->created_at->format('d/m/Y H:i')}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
