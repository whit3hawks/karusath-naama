@extends('frontend.layout')

@section('content')
@isset($article_top_banner)
<div>
  <div class="container mx-auto px-4 md:px-6 mt-4 md:mt-6">
    <div>
      <a target="_blank" href="{{$article_top_banner->url}}">
        <img class="w-full" src="{{$article_top_banner->image}}" alt="">
      </a>
      <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
    </div>
  </div>
</div>
@endisset
<div class="lg:mt-12 mt-4 md:mt-6 w-full">
  <div class="container mx-auto flex">
    <div class="lg:-mx-3 w-full lg:flex flex-row-reverse">
      <div class="lg:w-4/6 lg:mx-2 mx-4">
        <div class="w-full">
          <p class="dv-bold rtl lg:text-4xl text-3xl opacity-80 tracking-[.06em]" style="line-height: 60px;">{{$news->title}}</p>
          <div class="text-xl pt-4 flex items-center mt-2 dv-bold rtl pb-6 flex items-center">
            @isset($news->author)
            <div class="flex items-center">
              <a class="flex items-center" href="/authors/{{$news->author->id}}">
                <div class="w-10 ml-4 h-10 bg-gray-100 rounded-full" style="background-image: url('{{$news->author->image}}'); background-size: cover; background-position: center;"></div>
                <div>
                  <div class="opacity-75 waheed">{{$news->author->name}}@if($news->author->is_voice_writer == 'yes'), ކަރުސަތުނާމާ@endif</div>
                </div>
              </a>
              <span class="opacity-50 mx-3">&#xb7;</span>
            </div>
            @endisset
            <div class="opacity-50 text-sm en-font ltr">
              {{Carbon\Carbon::parse($news->date)->format('d M Y')}} | {{Carbon\Carbon::parse($news->date)->format('H:i')}}
            </div>
          </div>
        </div>
        <div>
          @if(isset($news->video))
          <div class="video-container">
            <iframe src="https://www.youtube.com/embed/{{$news->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>
          </div>
          @else
          <img class="w-full rounded-2xl" src="{{$news->image}}" alt="" />
          @endif
          @isset($news->image_caption)
          <div class="dv text-sm rtl opacity-50 py-3" style="line-height: 30px;">{{$news->image_caption}}</div>
          @endisset
        </div>
        <div class="flex justify-center mt-8 md:hidden">
          {!!
          Share::page(config('app.url').'/'.$news->id, $news->latin,['class' => 'opacity-40 flex mb-2 mx-4 justify-center items-center text-2xl', 'id' => $news->id, 'title' => $news->latin, 'rel' => 'nofollow noopener noreferrer'],'<ul class="flex">', '</ul>')
          ->facebook()
          ->twitter()
          ->telegram()
          ->whatsapp()
          !!}
        </div>
        <div class="md:flex md:mt-6 mt-6">
          <div class="md:border-r w-full md:border-gray-100 md:pr-6 md:mr-6">
            @isset($news->liveBlogs)
            @foreach($news->liveBlogs as $liveBlog)
            <div class="pb-6">
              <div class="text-right flex justify-end font-semibold text-lg">
                <div class="flex">
                  <div class="flex bg-jungle-green text-white text-sm rounded-lg px-3 items-center justify-end border-b border-gray-100">
                    <span class="py-2">{{Carbon\Carbon::parse($liveBlog->datetime)->format('d M - H:i')}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </div>
                </div>
              </div>
              @include('frontend.components.newsblocks',['body' =>$liveBlog->body])
            </div>
            @endforeach
            @endisset
            @isset($news->old_body)
            <style>
              #oldnewsbox p {
                margin-top: 28px;
                margin-bottom: 28px;
                line-height: 40px;
              }

            </style>
            <div class="mt-2 dv rtl leading-10 text-md md:text-lg" id="oldnewsbox">
              {!!$news->old_body!!}
            </div>
            @endisset
            @isset($news->body)
            <div>
              @include('frontend.components.newsblocks',['body' => $news->body,'adv'=> $article_side_bottom])
            </div>
            @endisset
            @isset($news->editor_note)
            <div class="bg-gray-100 p-6 rounded-2xl">
              <div class="w-full">
                <div class="text-lg rtl dv-bold border-jungle-green mb-4 border-b border-gray-200 pb-4">އެޑިޓަރުގެ ނޯޓް</div>
                <div class="text-sm rtl dv opacity-60" style="line-height: 36px;">{{$news->editor_note}}</div>
              </div>
            </div>
            @endisset
            <div class="mt-12 flex flex-wrap justify-end mb-6">
              @foreach($news->articleTags as $tag)
              <div class="bg-gray-50 rtl mb-4 ml-4 text-md rounded-full flex px-6 py-2 items-center text-gray-600 dv-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 border-jungle-green" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                </svg>
                <a class="hover:underline" href="/{{$tag->slug}}">{{$tag->name}}</a>
              </div>
              @endforeach
            </div>
          </div>
          <div class="md:w-14 w-full md:border-white border-t border-gray-200 md:pt-0 pt-6">
            <div class="flex justify-end">
              {!!
              Share::page(config('app.url').'/'.$news->id, $news->latin,['class' => 'border opacity-40 w-12 h-12 flex mb-2 justify-center items-center border-gray-400 rounded', 'id' => $news->id, 'title' => $news->latin, 'rel' => 'nofollow noopener noreferrer'],'<ul class="grid md:grid-cols-1 grid-cols-4 gap-4">', '</ul>')
              ->facebook()
              ->twitter()
              ->telegram()
              ->whatsapp()
              !!}
            </div>
          </div>
        </div>
        @isset($comment_box_top_banner)
        <div class="mt-6">
          <div>
            <a target="_blank" href="{{$comment_box_top_banner->url}}">
              <img class="w-full" src="{{$comment_box_top_banner->image}}" alt="">
            </a>
            <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
          </div>
        </div>
        @endisset
        {{-- comments --}}
        <div class="mt-12" id="commentslist">
          <div class="mb-6 justify-end flex border-b-2 border-gray-100 md:mx-0">
            <div class="text-3xl dv-bold rtl border-b-2 -mb-[0.1rem] border-jungle-green pb-4 opacity-80 font-semibold mb-6">
              ކޮމެންޓް
            </div>
          </div>
          @if (Session::get('errorMessage'))
          <div>
            <div class="bg-red-100 text-red-600 text-sm font-semibold en-font text-left px-6 py-4 rounded-lg mb-6">
              {{Session::get('errorMessage')}}
            </div>
          </div>
          @endif
          @if (Session::get('success'))
          <div>
            <div class="bg-green-100 text-green-600 text-sm font-semibold en-font text-left px-6 py-4 rounded-lg mb-6">
              {{Session::get('success')}}
            </div>
          </div>
          @endif
          <form action="/comment" method="POST" class="block">
            @csrf
            <div class="md:px-0 w-full grid-cols-1 grid">
              <input type="hidden" name="news_id" value="{{$news->id}}" />
              <input class="flex px-6 py-4 focus:outline-none dv-bold rtl text-lg w-full border border-gray-200 rounded-lg" type="text" value="{{old('name','')}}" name="name" placeholder="ނަން" />
              <textarea style="line-height: 40px;" class="flex px-6 py-4 focus:outline-none dv rtl text-lg w-full border border-gray-200 rounded-lg mt-6 h-40" type="text" name="comment" placeholder="ކޮމެންޓް">{{old('comment','')}}</textarea>
              <div class="flex justify-end mt-6">
                {!! htmlFormSnippet() !!}
              </div>
              <div class="flex justify-end mt-6">
                <input class="cursor-pointer bg-jungle-green text-white font-semibold rounded-lg px-6 py-3 hover:underline" type="submit" value="Submit" />
              </div>
            </div>
          </form>
          <div class="md:px-0 mt-12">
            @foreach($news->publishedComments as $comment)
            <div class="border-b mb-6 mt-6 pb-6 border-gray-200">
              <div class="dv-bold rtl text-gray-800 text-xl mb-4">
                {{$comment->name}}
              </div>
              <div class="dv rtl text-gray-600 text-lg" style="line-height: 40px;">
                {{$comment->comment}}
              </div>
              <div class="text-sm text-right text-gray-400 mt-4">
                {{$comment->created_at->format('d M Y')}}
              </div>
            </div>
            @endforeach
          </div>
        </div>
        {{-- .comments --}}
      </div>
      <div class="lg:w-2/6 lg:mx-3 lg:mt-0 mt-6">
        @isset($article_side_top)
        <div class="mb-6 px-4 md:px-6">
          <div class="w-full">
            <a target="_blank" href="{{$article_side_top->url}}">
              <img class="w-full" src="{{$article_side_top->image}}" alt="">
            </a>
            <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
          </div>
        </div>
        @endisset
        @include('frontend.components.newsbox-side',["heading"=>"އެންމެ ފަސް","items"=>$latest])
        @isset($article_side_bottom)
        <div class="mb-6 px-4 md:px-6 md:flex hidden">
          <div class="w-full">
            <a target="_blank" href="{{$article_side_bottom->url}}">
              <img class="w-full" src="{{$article_side_bottom->image}}" alt="">
            </a>
            <p class="text-xs opacity-40 mt-1 text-right">Advertisement</p>
          </div>
        </div>
        @endisset
      </div>
    </div>
  </div>
</div>
<div class="md:px-6">
  @include('frontend.components.newsbox-sm',["heading"=>"ގުޅޭ ލިޔުންތައް","items"=>$related])
</div>
<script>
  $('.dv').thaana({
    keyboard: 'phonetic'
  });
  $('.dv-bold').thaana({
    keyboard: 'phonetic'
  });

</script>
@endsection
