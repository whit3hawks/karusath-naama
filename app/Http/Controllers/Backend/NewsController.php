<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\LiveBlog;
use App\Models\News;
use App\Models\NewsTag;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\NewsPublished;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Browsershot\Browsershot;
use Telegram\Bot\Api;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {

            $status = 0;
            if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
                if (request()->from && request()->to && request()->author_id) {
                    $news =  News::where('status', $status)->where('author_id', request()->author_id)->whereBetween('date', [Carbon::parse(request()->from), Carbon::parse(request()->to)])->orderBy('date', 'DESC')->paginate(30);
                } else {
                    $news = request()->keyword ? News::where('status', $status)->where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(30) : News::where('status', $status)->orderBy('date', 'DESC')->paginate(30);
                }
            } else {
                $news = request()->keyword ? News::where('status', $status)->where('author_id', auth()->user()->id)->where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(30) : News::where('status', $status)->where('author_id', auth()->user()->id)->orderBy('date', 'DESC')->paginate(30);
            }

            $total_news = News::count();
            $total_comments = Comment::count();
            $total_photos = Gallery::count();
            return view('backend.news.index', [
                'news' => $news,
                'authors' => User::all(),
                'total_news' => $total_news,
                'total_comments' => $total_comments,
                'total_photos' => $total_photos
            ]);
        }
    }

    public function editorBoxNews(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $status = 2;
            if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
                if (request()->from && request()->to && request()->author_id) {
                    $news =  News::where('status', $status)->where('author_id', request()->author_id)->whereBetween('date', [Carbon::parse(request()->from), Carbon::parse(request()->to)])->orderBy('date', 'DESC')->paginate(30);
                } else {
                    $news = request()->keyword ? News::where('status', $status)->where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(30) : News::where('status', $status)->orderBy('date', 'DESC')->paginate(30);
                }
            } else {
                $news = request()->keyword ? News::where('status', $status)->where('author_id', auth()->user()->id)->where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(30) : News::where('status', $status)->where('author_id', auth()->user()->id)->orderBy('date', 'DESC')->paginate(30);
            }

            $total_news = News::count();
            $total_comments = Comment::count();
            $total_photos = Gallery::count();
            return view('backend.news.index', [
                'news' => $news,
                'authors' => User::all(),
                'total_news' => $total_news,
                'total_comments' => $total_comments,
                'total_photos' => $total_photos
            ]);
        }
    }

    public function publishedNews(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $status = 1;
            if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
                if (request()->from && request()->to && request()->author_id) {
                    $news =  News::where('status', $status)->where('author_id', request()->author_id)->whereBetween('date', [Carbon::parse(request()->from), Carbon::parse(request()->to)])->orderBy('date', 'DESC')->paginate(30);
                } else {
                    $news = request()->keyword ? News::where('status', $status)->where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(30) : News::where('status', $status)->orderBy('date', 'DESC')->paginate(30);
                }
            } else {
                $news = request()->keyword ? News::where('status', $status)->where('author_id', auth()->user()->id)->where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(30) : News::where('status', $status)->where('author_id', auth()->user()->id)->orderBy('date', 'DESC')->paginate(30);
            }

            $total_news = News::count();
            $total_comments = Comment::count();
            $total_photos = Gallery::count();
            return view('backend.news.index', [
                'news' => $news,
                'authors' => User::all(),
                'total_news' => $total_news,
                'total_comments' => $total_comments,
                'total_photos' => $total_photos
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view(
                'backend.news.form',
                [
                    'news' => new News,
                    'authors' => User::all()
                ]
            );
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {

            $this->validate($request, [
                'title' => 'required',
                'file' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            ], [
                'file.image' => 'The cover photo must be an image.',
                'file.mimes' => 'The cover photo must be a file of type: jpeg, jpg, png.',
                'file.max' => 'The cover photo must not be greater than 10MB.',
            ]);

            $news = new News();
            $news->title = $request->title;
            $news->short_title = $request->short_title;
            $news->layout = $request->layout;
            $news->editor_note = $request->editor_note;
            $news->latin = $request->latin;
            $news->date = $request->date;
            $news->video = $request->video;
            $news->body = $request->body;
            $news->summary = $request->summary;
            $news->description = $request->description;
            $news->image_caption = $request->image_caption;

            if (isset($request->actionbutton) && $request->actionbutton == "sfr") {
                if ($this->checkSendForReview($request->short_title, $request->image_caption, $request->latin)) {
                    $news->status = 2;
                } else {
                    return redirect()->route(config('app.admindomain') . '.news.edit', ['news' => $news])->with('errorMessage', 'Sorry, you need to fill all the required fields (Short Heading, Image Caption & Latin Heading) to send the news for review!');
                }
            }

            if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
                $news->author_id = $request->author_id;
            } else {
                $news->author_id = auth()->user()->id;
            }

            if (isset($request->image)) {
                $news->image = $request->image;
            } else {
                if (isset($request->file)) {
                    $imagePath = uploadFileToDO($request->file('file'), "images");
                    uploadLargeThumbToDO($request->file('file'), "images", $imagePath);
                    uploadSmallThumbToDO($request->file('file'), "images", $imagePath);
                    $news->image = $imagePath;
                }
            }
            $news->save();

            return redirect()->route(config('app.admindomain') . '.news.edit', ['news' => $news])->with('successMessage', 'News saved successfully!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.news.form', [
                'news' => $news,
                'authors' => User::all()
            ]);
        } else {
            if ($news->author_id == auth()->user()->id) {
                return view('backend.news.form', [
                    'news' => $news,
                    'authors' => User::all()
                ]);
            } else {
                return back();
            }
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'title' => 'required',
                'file' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            ], [
                'file.image' => 'The cover photo must be an image.',
                'file.mimes' => 'The cover photo must be a file of type: jpeg, jpg, png.',
                'file.max' => 'The cover photo must not be greater than 10MB.',
            ]);

            $news = News::findOrFail($id);
            $prevTitle = $news->title;
            $news->title = $request->title;
            $news->short_title = $request->short_title;
            $news->layout = $request->layout;
            $news->editor_note = $request->editor_note;
            $news->latin = $request->latin;
            $news->date = $request->date;
            $news->body = $request->body;
            $news->video = $request->video;
            $news->summary = $request->summary;
            $news->description = $request->description;
            $news->image_caption = $request->image_caption;

            if (isset($request->actionbutton) && $request->actionbutton == "sfr") {
                if ($this->checkSendForReview($request->short_title, $request->image_caption, $request->latin)) {
                    $news->status = 2;
                    $this->sendToTelegram(auth()->user()->id, $request->latin);
                } else {
                    return redirect()->route(config('app.admindomain') . '.news.edit', ['news' => $news])->with('errorMessage', 'Sorry, you need to fill all the required fields (Short Heading, Image Caption & Latin Heading) to send the news for review!');
                }
            }

            if (isset($request->actionbutton) && $request->actionbutton == "sap") {
                if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
                    $news->status = 1;
                }
            }

            if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
                $news->author_id = $request->author_id;
            } else {
                $news->author_id = auth()->user()->id;
            }

            if (isset($request->image)) {
                $news->image = str_replace(config('filesystems.disks.do.url') . '/', '', $request->image);
            } else {
                if (isset($request->file)) {
                    $imagePath = uploadFileToDO($request->file('file'), "images");
                    uploadLargeThumbToDO($request->file('file'), "images", $imagePath);
                    uploadSmallThumbToDO($request->file('file'), "images", $imagePath);
                    $news->image = $imagePath;
                }
            }
            $news->save();

            //og image
            if (isset($request->actionbutton) && $request->actionbutton == "sap") {
                $this->generateShareImage($news->id);
            }
            //.og image

            //clear cache
            Cache::forget('news:' . $news->id);

            if (isset($request->actionbutton) && $request->actionbutton == "sfr") {
                return redirect()->route(config('app.admindomain') . '.news.index')->with('successMessage', 'News updated and sent for review successfully!');
            } else if (isset($request->actionbutton) && $request->actionbutton == "sap") {
                return redirect()->route(config('app.admindomain') . '.news.editorbox-news')->with('successMessage', 'News updated and published successfully!');
            } else {
                return redirect()->route(config('app.admindomain') . '.news.edit', ['news' => $news])->with('successMessage', 'News updated successfully!');
            }
        }
    }

    public function checkSendForReview($short_title, $image_caption, $latin)
    {
        if (isset($short_title) && isset($image_caption) && isset($latin)) {
            return true;
        }
        return false;
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        Comment::where('news_id', $id)->delete();

        return back();
    }

    public function status($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $news = News::findOrFail($id);
            if ($news->status == 0 || $news->status == 2) {
                $this->generateShareImage($news->id);
                $news->status = 1;
                $news->save();

                return redirect()->route(config('app.admindomain') . '.news.editorbox-news')->with('successMessage', 'News published successfully!');
            } else {
                $news->status = 0;
                $news->save();

                return redirect()->route(config('app.admindomain') . '.news.published-news')->with('dangerMessage', 'News unpublished successfully!');
            }
        }
    }

    public function tweet($id)
    {
        $news = News::findOrFail($id);
        $news->twitter_notified = 1;
        $news->save();

        $news->notify(new NewsPublished($news));

        return redirect()->route(config('app.admindomain') . '.news.published-news')->with('successMessage', 'News sent to Twitter successfully!');
    }

    public function sendToTelegram($user_id, $latin)
    {
        $user = User::find($user_id);
        if (isset($user)) {
            $telegram = new Api('626967427:AAEi-KT89LMBcHF9rdFW8l15IPGudgPIOG8');
            $telegram->sendMessage([
                'chat_id' => "-266670974",
                'text' => $user->email . " has sent a new article for review, please review and publish. (" . $latin . ")"
            ]);

            return true;
        }
    }

    public function sendToDraft($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $news = News::findOrFail($id);
            $news->status = 0;
            $news->save();

            return redirect()->route(config('app.admindomain') . '.news.editorbox-news');
        }
    }

    public function uploadImage(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            if (isset($request->image)) {
                $filePath = uploadFileToDO($request->file('image'), "images");

                return response()->json([
                    "success" => 1,
                    "file" => [
                        "url" => config('filesystems.disks.do.url')  . "/" . $filePath
                    ]
                ]);
            } else {
                return response()->json([
                    "success" => 0
                ]);
            }
        }
    }

    public function storeTag($id, Request $request)
    {
        $tag = NewsTag::firstOrCreate(
            ['news_id' => $id, 'tag_id' => $request->tag_id],
            ['news_id' => $id, 'tag_id' => $request->tag_id]
        );
        $tag = NewsTag::where('id', $tag->id)->with('news', 'tag')->first();
        return response()->json([
            'tags' => NewsTag::where('news_id', $id)->with('news', 'tag')->latest()->get()
        ]);
    }

    public function getTags($id)
    {
        return response()->json([
            'tags' => NewsTag::where('news_id', $id)->with('news', 'tag')->latest()->get()
        ]);
    }

    public function deleteTag($id)
    {
        $tag = NewsTag::findOrFail($id);
        $tag->delete();
        return response()->json([
            'tags' => NewsTag::where('news_id', $tag->news_id)->with('news', 'tag')->latest()->get()
        ]);
    }

    public function generateShareImage($id)
    {
        $news = News::findOrFail($id);

        if (isset($news->image)) {
            $imagePath = str_replace(config('filesystems.disks.do.url') . '/', '', $news->image);
            $imagePath = str_replace("original_", "ogimage_" . time() . "_", $imagePath);
            $screenshot = Browsershot::url(config('app.url') . '/shot/news/' . $news->id)
                ->setScreenshotType('png')
                ->windowSize(1024, 512)
                ->screenshot();

            Storage::disk('do')->put($imagePath, $screenshot, 'public');
            $news->og_image =  $imagePath;
            $news->save();
            return $imagePath;
        } else {
            return true;
        }
    }

    public function shot($id)
    {
        $news = News::findOrFail($id);
        $isBreaking = News::where('id', $id)->whereHas('tags', function ($query) {
            $query->where('slug', 'breaking');
        })->exists();
        return view('frontend.shot.news', [
            'isBreaking' => $isBreaking,
            'news' => $news
        ]);
    }

    public function liveBlogIndex($id, Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $liveBlogs = LiveBlog::where('news_id', $id)->orderBy('datetime', 'DESC')->get();
            $news = News::findOrFail($id);

            return view('backend.news.live-blog', [
                'liveBlogs' => $liveBlogs,
                'news' => $news
            ]);
        }
    }

    public function liveBlogStore($id, Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'datetime' => 'required',
            ], [
                'datetime.required' => "Please provide a valid date."
            ]);

            $liveBlog = new LiveBlog();
            $liveBlog->news_id = $id;
            $liveBlog->author_id = auth()->user()->id;
            $liveBlog->datetime = $request->datetime;
            $liveBlog->body = $request->body;
            $liveBlog->latin = $request->latin;
            $liveBlog->save();

            return redirect()->route(config('app.admindomain') . '.news.live-blog.index', $id);
        }
    }

    public function liveBlogDelete($id, $blogid, Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $liveBlog = LiveBlog::where('news_id', $id)->where('id', $blogid)->first();
            $liveBlog->delete();

            return redirect()->route(config('app.admindomain') . '.news.live-blog.index', $id);
        }
    }

    public function removeBreakings()
    {
        $breakingTag = Tag::where('slug', 'breaking')->first();
        $breakingIds = News::whereHas('tags', function ($query) {
            $query->where('slug', 'breaking');
        })->where('status', 1)->pluck('id');
        NewsTag::whereIn('news_id', $breakingIds)->where('tag_id', $breakingTag->id)->delete();

        $breakingRelatedTag = Tag::where('slug', 'breaking-related')->first();
        $breakingRelatedIds = News::whereHas('tags', function ($query) {
            $query->where('slug', 'breaking-related');
        })->where('status', 1)->pluck('id');
        NewsTag::whereIn('news_id', $breakingRelatedIds)->where('tag_id', $breakingRelatedTag->id)->delete();

        return back();
    }

    public function oldMigration()
    {
        // $oldNews = DB::connection('mysql2')->table('posts')->select('id', 'image', 'dv_heading', 'heading', 'status', 'post', 'summary', 'updated_at', 'created_at')->get();

        // foreach ($oldNews as $value) {
        //     $news = new News();
        //     $news->id = $value->id;
        //     $news->title = $value->dv_heading;
        //     $news->latin = $value->heading;
        //     $news->date = $value->updated_at;
        //     $news->old_body = $value->post;
        //     $news->summary = $value->summary;
        //     $news->image = $value->image;
        //     $news->status = $value->status == 'on' ? 1 : 0;
        //     $news->save();
        // }


        // return true;
    }

    public function autoSave($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false
            ]);
        }

        $news = News::findOrFail($id);
        $news->body = $request->body;
        $news->save();

        return response()->json([
            'status' => true
        ]);
    }
}
