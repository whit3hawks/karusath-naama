<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.news.index',['status'=>0])}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">News</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.media-photos.index',['status'=>0])}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Photos</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.galleries.index')}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Photos</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.videos.index')}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Videos</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.news-quotes.index')}}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Quotes</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
@hasanyrole('admin|editor')
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.tags.index')}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Tags</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
@endhasanyrole
@hasanyrole('admin|editor')
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.comments.index')}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Comments</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
@endhasanyrole
@hasanyrole('admin|editor')
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.advs.index')}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Advertisements</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
@endhasanyrole
@hasanyrole('admin')
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 border-b border-gray-200 @else px-4 py-8 @endif flex justify-between font-semibold items-center en-font text-md" href="{{route(config('app.admindomain').'.users.index')}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Settings</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
@endhasanyrole
<li>
  <a class="@if(isset($mobile) && $mobile) px-6 py-4 @else px-4 py-8 ml-4 @endif flex justify-between font-semibold items-center en-font text-md text-red-600" href="{{route(config('app.admindomain').'.logout')}}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
    </svg>
    <div class="pl-4 md:hidden block w-full text-left">Logout</div>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
    </svg>
  </a>
</li>
