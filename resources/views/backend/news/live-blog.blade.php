@extends('backend.layout')

@section('content')
<div class="container mx-auto px-6 py-6">
  <div class="flex items-center">
    <div class="flex items-center justify-between w-full">
      <div class="flex items-center">
        <a href="{{route(config('app.admindomain').'.news.published-news')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
          </svg>
        </a>
        <div>
          <p class="w-full en-font font-semibold text-2xl">Live Blog</p>
          <p class="w-full en-font opacity-50 text-md">{{$news->latin}}</p>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full mt-6">
    <form action="{{route(config('app.admindomain').'.news.live-blog.store',$news->id)}}" method="POST" enctype="multipart/form-data" id="submitform">
      @csrf
      <div class="">
        <input type="hidden" value="" name="body" required />
        <div class="grid md:grid-cols-2 grid-cols-1 gap-6 mb-6">
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end">
            <p class="w-full en-font text-sm">Latin</p>
            <input type="text" class="en-bold outline-none w-full" placeholder="Heading..." name="latin" />
          </div>
          <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap md:mt-0">
            <p class="w-full en-font text-sm">Date</p>
            <input type="datetime-local" class="w-full en-font outline-none" value="{{ Carbon\Carbon::now()->format('Y-m-d h:i') }}" placeholder="Date" name="datetime" />
            @if($errors->has('datetime'))
            <div class="text-xs text-red-600 flex items-center mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              {{ $errors->first('datetime') }}
            </div>
            @endif
          </div>
        </div>
        <div class="w-full md:mb-0 mb-6">
          <div id="editorjs"></div>
          <div class="md:justify-center justify-start flex mb-6">
            <div id="save" class="md:w-1/6 cursor-pointer bg-black hidden en-font flex text-center justify-center text-white font-semibold w-full mt-6 w-full rounded-xl py-3">Save</div>
          </div>
        </div>
      </div>
    </form>
    <div>
      <p class="w-full en-font font-semibold text-2xl mb-6 text-center border-t border-gray-100 mt-6 pt-6">Latest Updates</p>
      @foreach($liveBlogs as $liveBlog)
      <div class="border-b mb-6 border-gray-100">
        @isset($liveBlog->datetime)
        <div class="flex items-center justify-between">
          <p class="w-full text-right en-font font-semibold text-md mb-2">{{Carbon\Carbon::parse($liveBlog->datetime)->format('d/m/y h:i')}}</p>
        </div>
        <p class="w-full text-right en-font opacity-50 text-md mb-2">{{$liveBlog->latin}}</p>
        @endisset
        <div>
          @include('frontend.components.newsblocks',['body' => $liveBlog->body])
        </div>
        <a class="flex pb-6 justify-end text-red-500" href="{{route(config('app.admindomain').'.news.live-blog.delete',[$news->id,$liveBlog->id])}}">Remove</a>
      </div>
      @endforeach
    </div>
  </div>
</div>
<script src="/js/editorjs/editor.js"></script>
<script src="/js/editorjs/tools/header/bundle.js"></script>
<script src="/js/editorjs/tools/embed/bundle.js"></script>
<script src="/js/editorjs/tools/list/bundle.js"></script>
<script src="/js/editorjs/tools/image/bundle.js"></script>
<script>
  $(document).ready(function() {
    const editor = new EditorJS({
      placeholder: 'ހަބަރު'
      , holder: 'editorjs'
      , tools: {
        header: Header
        , embed: Embed
        , image: {
          class: ImageTool
          , config: {
            endpoints: {
              byFile: @if(env('APP_ENV') == 'local')
              'https://boli.boli.test/upload-news-image'
              @else 'https://boli.voice.mv/upload-news-image'
              @endif
            , }
          }
        }
      , }
    });

    $('#save').click(() => {
      editor.save().then((outputData) => {
        $('input[name=body]').val(JSON.stringify(outputData));
        $("#submitform").submit();
      }).catch((error) => {
        console.log('Saving failed: ', error)
      });
    });

    editor.isReady
      .then(() => {
        $("#save").show();
        $('input[name=body]').val().indexOf('"blocks": []') == -1 && editor.render(JSON.parse($('input[name=body]').val()));
      })
      .catch((reason) => {
        console.log(`Editor.js initialization failed because of ${reason}`)
      });
  });

</script>
@endsection
