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
  @if(Session::has('errorMessage'))
  <div class="mb-6 bg-red-100 flex text-sm font-semibold  px-6 py-4 rounded-lg items-center text-red-600">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
    </svg>
    {{Session::get('errorMessage') }}
  </div>
  @endif

  @if($errors->any())
  <div class="mb-6 bg-red-100 flex text-sm font-semibold  px-6 py-4 rounded-lg items-start text-red-600">
    <div class="flex mt-1">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 mr-3">
        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
      </svg>
    </div>
    {{ Session::get('errorMessage') }}
    {!! implode('', $errors->all(':message<br>')) !!}
  </div>
  @endif
  <div class="flex items-center">
    <div class="flex items-center justify-between w-full">
      <div class="flex items-center">
        <a href="@if(isset($news) && $news->status == 2){{route(config('app.admindomain').'.news.editorbox-news')}}@elseif(isset($news) && $news->status == 1){{route(config('app.admindomain').'.news.published-news')}}@else{{route(config('app.admindomain').'.news.index')}}@endif">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-4 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
          </svg>
        </a>
        <p class="rtl w-full en-font font-semibold text-2xl"> News</p>
      </div>
      @isset($news)
      <div>
        @switch($news->status)
        @case(0)
        <div class="pl-2 pr-3 flex items-center rounded-full py-1 bg-gray-100 text-gray-600 uppercase font-semibold text-xs">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          Draft
        </div>
        @break
        @case(1)
        <div class="pl-2 pr-3 flex items-center rounded-full py-1 bg-green-100 text-green-600 uppercase font-semibold text-xs">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          Published
        </div>
        @break
        @case(2)
        <div class="pl-2 pr-3 flex items-center rounded-full py-1 bg-gray-100 text-gray-600 uppercase font-semibold text-xs">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          Waiting for Review
        </div>
        @break
        @default

        @endswitch
      </div>
      @endisset
    </div>
  </div>
  <div class="w-full mt-6">
    @if(Route::currentRouteName() == config('app.admindomain').".news.create")
    <form action="{{route(config('app.admindomain').'.news.store')}}" method="POST" enctype="multipart/form-data" id="submitform">
      @else
      <form action="{{route(config('app.admindomain').'.news.update',$news->id)}}" method="POST" enctype="multipart/form-data" id="submitform">
        @method('put')
        @endif
        @csrf
        <div class="md:flex">
          <div class="w-full md:mb-0 mb-6">
            <div id="editorjs"></div>
          </div>
          <div class="w-full md:w-2/5">
            @if($news->body)
            <input type="hidden" value="{{old('body',$news->body)}}" name="body" />
            @else
            <input type="hidden" value="" name="body" />
            @endif
            @if(Route::currentRouteName() == config('app.admindomain').".news.edit")
            @if(isset($news->og_image))
            <div class="flex items-center pb-6 justify-center overflow-hidden">
              <img class="mt-4" src="{{$news->og_image}}" alt="" />
            </div>
            @else
            <div class="flex items-center pb-6 justify-center overflow-hidden">
              <img class="mt-4" src="{{$news->thumb}}" alt="" />
            </div>
            @endif
            @endif
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6">
              <p class="w-full en-font rtl text-sm">Heading</p>
              <input type="text" class="dv-bold rtl outline-none w-full" value="{{old('title',$news->title)}}" placeholder="ތައާރަފް" name="title" />
              @if($errors->has('title'))
              <div class="text-xs text-red-600 flex items-center mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $errors->first('title') }}
              </div>
              @endif
            </div>
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6">
              <p class="w-full en-font rtl text-sm">Short Heading</p>
              <input type="text" class="dv-bold rtl outline-none w-full" value="{{old('short_title',$news->short_title)}}" placeholder="ތައާރަފް" name="short_title" />
              @if($errors->has('short_title'))
              <div class="text-xs text-red-600 flex items-center mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $errors->first('short_title') }}
              </div>
              @endif
            </div>
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6">
              <p class="w-full en-font text-sm">Latin Heading</p>
              <input type="text" class="en-font w-full outline-none" value="{{old('latin',$news->latin)}}" placeholder="Latin" name="latin" />
              @if($errors->has('latin'))
              <div class="text-xs text-red-600 flex text-right w-full items-center mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $errors->first('latin') }}
              </div>
              @endif
            </div>
            <div class="grid md:grid-cols-1 grid-cols-1 gap-4 mb-6">
              <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start">
                <p class="w-full en-font text-sm mb-2">Layout</p>
                <select name="layout" id="layout" class="flex w-full focus:outline-none">
                  <option value="0" @if(old('layout',$news->layout) == 0) selected @endif>Default</option>
                  <option value="1" @if(old('layout',$news->layout) == 1) selected @endif>Wide</option>
                </select>
              </div>
            </div>
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6">
              <p class="w-full en-font rtl text-sm">Summary</p>
              <textarea type="text" class="dv-bold rtl outline-none text-lg w-full h-40" placeholder="ތައާރަފް" name="summary">{{old('summary',$news->summary)}}</textarea>
              @if($errors->has('summary'))
              <div class="text-xs text-red-600 flex items-center mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $errors->first('summary') }}
              </div>
              @endif
            </div>
            @if(Route::currentRouteName() == config('app.admindomain').".news.edit")
            <tag-picker url="/api/news-tag/" id="{{$news->id}}"></tag-picker>
            @endif
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap md:mt-0 mt-4">
              <p class="w-full en-font text-sm">Published Date</p>
              <input type="datetime-local" class="en-font outline-none" value="{{old('date',Carbon\Carbon::parse($news->date)->format('Y-m-d\TH:i'))}}" placeholder="Date" name="date" />
            </div>
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-start mt-6">
              <p class="w-full text-sm mb-2">Author</p>
              @if(Route::currentRouteName() == config('app.admindomain').".news.create")
              <select name="author_id" id="author_id" class="flex dv-bold w-full focus:outline-none" @hasanyrole('writer') disabled="true" @endhasanyrole>
                <option value="">Author</option>
                @foreach($authors as $author)
                <option value="{{$author->id}}" @if(old('author_id',$author->id) == auth()->user()->id) selected @endif>{{$author->name}}</option>
                @endforeach
              </select>
              @else
              <select name="author_id" id="author_id" class="flex dv-bold w-full focus:outline-none" @hasanyrole('writer') disabled="true" @endhasanyrole>
                <option value="">Author</option>
                @foreach($authors as $author)
                <option value="{{$author->id}}" @if(old('author_id',$author->id) == $news->author_id) selected @endif>{{$author->name}}</option>
                @endforeach
              </select>
              @endif
            </div>
            @isset($news->image)
            <div class="flex items-center justify-center overflow-hidden">
              <img class="mt-6" src="{{$news->thumb}}" alt="" />
            </div>
            @endisset
            <p class="w-full en-font text-md font-semibold mt-6">News Image Settings</p>
            <p class="w-full en-font text-sm border-b border-gray-200 pb-2 text-gray-600">Select a photo from Voice media or upload a new image</p>
            <div class="grid md:grid-cols-1 grid-cols-1 gap-4 md:mt-6">
              <div class="w-full border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end md:mt-0 mt-4">
                <p class="w-full en-font text-sm mb-2">Upload Photo</p>
                <div class="flex justify-end w-full mb-1">
                  <input type="file" class="w-full outline-none text-right" name="file" />
                </div>
                @if($errors->has('file'))
                <div class="text-xs text-red-600 flex items-center justify-start w-full mt-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                  </svg>
                  {{ $errors->first('file') }}
                </div>
                @endif
              </div>
            </div>
            <div>
              <div class="border-b flex justify-center mt-6 relative border-gray-200">
                <div class="flex px-2 bg-white absolute" style="top: -12px;">or</div>
              </div>
            </div>
            <div class="border border-black mt-6 rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6">
              <p class="w-full en-font text-sm">Voice Media Photo</p>
              <div class="flex w-full justify-between items-center">
                <input id="image" type="text" class="en-font text-left w-full bg-white outline-none" placeholder="image.png" name="image" editable="false" />
                <div class="cursor-pointer bg-black text-xs text-white px-4 py-1 rounded" id="open-media-photo-button">Select</div>
              </div>
            </div>
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6 mt-6">
              <p class="w-full en-font text-sm">Youtube Video ID (Optional)</p>
              <input type="text" class="en-font w-full outline-none" value="{{old('video',$news->video)}}" placeholder="Youtube Video ID" name="video" />
            </div>
            <div class="border border-black rounded-xl px-4 py-2 flex flex-wrap justify-end mt-6">
              <p class="w-full en-font rtl text-sm">Image Caption</p>
              <textarea type="text" class="dv-bold rtl outline-none text-lg w-full h-30" placeholder="ތައާރަފް" name="image_caption">{{old('image_caption',$news->image_caption)}}</textarea>
            </div>
            @hasanyrole('admin|editor')
            <div class="border border-black mt-6 rounded-xl px-4 py-2 flex flex-wrap justify-end mb-6">
              <p class="w-full en-font rtl text-sm">Editor Note</p>
              <textarea type="text" class="dv-bold rtl outline-none text-lg w-full h-40" placeholder="ނޯޓް" name="editor_note">{{old('editor_note',$news->editor_note)}}</textarea>
              @if($errors->has('editor_note'))
              <div class="text-xs text-red-600 flex items-center mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $errors->first('editor_note') }}
              </div>
              @endif
            </div>
            @endhasanyrole
            <input type="hidden" id="actionbutton" name="actionbutton">
            <div id="save" class="cursor-pointer bg-black hidden en-font flex text-center justify-center text-white font-semibold w-full mt-6 w-full rounded-xl py-3">Save</div>
            @if(Route::currentRouteName() == config('app.admindomain').".news.edit" && isset($news) && $news->status == 0)
            <input id="saveandreview" type="submit" name="sfr" class="w-full cursor-pointer hidden justify-center flex px-4 py-3 bg-gray-200 mt-6 rounded-lg text-gray-800 font-semibold" value="Save & Review">
            @endif
            @hasanyrole('admin|editor')
            @if(Route::currentRouteName() == config('app.admindomain').".news.edit" && isset($news) && $news->status == 2)
            <input id="saveandpublish" type="submit" name="sap" class="w-full cursor-pointer hidden justify-center flex px-4 py-3 bg-gray-200 mt-6 rounded-lg text-gray-800 font-semibold" value="Save & Publish">
            <a href="{{route(config('app.admindomain').'.news.send-to-draft',$news->id)}}" class="w-full justify-center flex px-4 py-3 bg-gray-200 mt-6 rounded-lg text-gray-800 font-semibold">Send to Draft</a>
            @endif
            @endhasanyrole
          </div>
        </div>
      </form>
  </div>
</div>
<div class="fixed overflow-scroll z-50 flex justify-center items-center top-0 hidden w-full h-screen bg-black bg-opacity-20" id="media-photo-box">
  <div class="bg-white rounded-xl md:m-12 m-6 px-6 py-6">
    <div class="flex justify-between items-center">
      <div class="w-full flex items-center rounded-full border border-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input type="text" id="photo-box-caption" name="caption" class="px-4 py-3 border-gray-200 focus:outline-none w-full" placeholder="Caption...">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-4 cursor-pointer rounded-full" id="search-photo-button" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
      </div>
      <div class="cursor-pointer ml-6 bg-white rounded-full flex items-center justify-center" id="open-media-photo-close-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
    </div>
    <div class="flex w-full mt-6">
      <div id="photo-list-loading" class="hidden text-sm text-gray-800">Loading...</div>
      <div class="w-full grid gap-4 grid-cols-2 md:grid-cols-6" id="media-photos">
      </div>
    </div>
  </div>
</div>
<script src="/js/editorjs/editor.js"></script>
<script src="/js/editorjs/tools/header/bundle.js"></script>
<script src="/js/editorjs/tools/embed/bundle.js"></script>
<script src="/js/editorjs/tools/list/bundle.js"></script>
<script src="/js/editorjs/tools/image/bundle.js"></script>
<script src="/js/editorjs/tools/quote/bundle.js"></script>
<script>
  $(document).ready(function() {
    const editor = new EditorJS({
      holder: 'editorjs'
      , tools: {
        header: Header
        , embed: Embed
        , quote: Quote
        , image: {
          class: ImageTool
          , config: {
            endpoints: {
              byFile: @if(env('APP_ENV') == 'local')
              'https://boli.karusathnaama.test/upload-news-image'
              @else 'https://boli.karusathnaama.com/upload-news-image'
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

    $('#saveandreview').click(() => {
      editor.save().then((outputData) => {
        $('#actionbutton').val('sfr');
        $('input[name=body]').val(JSON.stringify(outputData));
        $("#submitform").submit();
      }).catch((error) => {
        console.log('Saving failed: ', error)
      });
    });

    $('#saveandpublish').click(() => {
      editor.save().then((outputData) => {
        $('#actionbutton').val('sap');
        $('input[name=body]').val(JSON.stringify(outputData));
        $("#submitform").submit();
      }).catch((error) => {
        console.log('Saving failed: ', error)
      });
    });

    editor.isReady
      .then(() => {
        $("#save").show();
        $('#saveandreview').show();
        $('#saveandpublish').show();
        $('input[name=body]').val().indexOf('"blocks": []') == -1 && editor.render(JSON.parse($('input[name=body]').val()));
      })
      .catch((reason) => {
        console.log(`Editor.js initialization failed because of ${reason}`)
      });

    $('#open-media-photo-button').click(() => {
      $('#media-photo-box').toggle();
    });

    $('#open-media-photo-close-button').click(() => {
      $('#media-photo-box').toggle();
    });

    $('#search-photo-button').click(() => {
      $('#photo-list-loading').show();
      $.ajax({
        url: "/api/search-photos/" + $('#photo-box-caption').val()
        , success: function(result) {
          $("#media-photos").empty();
          $.each(result, function(key, value) {
            $('#media-photos').append("<div class='rounded-lg overflow-hidden cursor-pointer'><img class='media-photo-click' src=" + value.image + " /></div>");
          });
          $('#photo-list-loading').hide();
        }
        , error: function(xhr, ajaxOptions, thrownError) {
          $("#media-photos").empty();
          $('#photo-list-loading').hide();
        }
      });
    });

    $('#media-photos').on('click', '.media-photo-click', function() {
      $('#media-photo-box').toggle();
      $('#image').val(this.getAttribute('src'));
    });

    $("body").on("submit", "form", function() {
      $(this).submit(function() {
        return false;
      });
      return true;
    });

    @if(Route::currentRouteName() == config('app.admindomain').
      ".news.edit")

    function autoSave() {
      // do whatever you like here
      editor.save().then((outputData) => {
        $.post("/api/news/{{$news->id}}/auto-save", {
          body: JSON.stringify(outputData)
        }).done(function() {
          return true;
        });
      }).catch((error) => {
        console.log('Saving failed: ', error)
      });
      setTimeout(autoSave, 60000);
    }
    setTimeout(autoSave, 60000);

    @endif

  });

</script>

@endsection
