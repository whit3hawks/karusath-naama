<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adv;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\News;
use App\Models\NewsQuote;
use App\Models\NewsTag;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use MetaTag;

class HomeController extends Controller
{
    public function index()
    {
        $cacheDuration = 120;
        $menus = Cache::remember('menu', $cacheDuration, function () {
            return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
        });
        $breaking = Cache::remember('breaking', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'breaking');
            })->where('status', 1)->orderBy('date', 'DESC')->first();
        });
        $breakingRelated = Cache::remember('breakingRelated', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'breaking-related');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(4)->get();
        });
        $featuredMain = Cache::remember('featuredMain', $cacheDuration, function () use ($breaking) {
            return News::whereNotIn('id', [$breaking->id ?? 0])->whereHas('tags', function ($query) {
                $query->where('slug', 1);
            })->where('status', 1)->orderBy('date', 'DESC')->first();
        });
        $specialReport = Cache::remember('specialReport', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'special-report');
            })->where('status', 1)->orderBy('date', 'DESC')->first();
        });
        $featuredMid = Cache::remember('featuredMid', $cacheDuration, function () use ($featuredMain) {
            return News::whereNotIn('id', [$featuredMain->id ?? 0])->whereHas('tags', function ($query) {
                $query->where('slug', 2);
            })->where('status', 1)->orderBy('date', 'DESC')->first();
        });
        $featured = Cache::remember('featured', $cacheDuration, function ()  use ($featuredMain, $featuredMid) {
            return News::whereNotIn('id', [$featuredMain->id ?? 0, $featuredMid->id ?? 0])->whereHas('tags', function ($query) {
                $query->where('slug', 3);
            })->where('status', 1)->orderBy('date', 'DESC')->limit(6)->get();
        });
        $editorsPick = Cache::remember('editorsPick', $cacheDuration, function ()  use ($featuredMain, $featuredMid) {
            return News::whereNotIn('id', [$featuredMain->id ?? 0, $featuredMid->id ?? 0])->whereHas('tags', function ($query) {
                $query->where('slug', 'editors-pick');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(4)->get();
        });
        $reports = Cache::remember('reports', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'report');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(7)->get();
        });
        $world = Cache::remember('world', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'world');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(8)->get();
        });
        $religion = Cache::remember('religion', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'religion');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(7)->get();
        });

        $sports = Cache::remember('sports', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'sport');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(8)->get();
        });
        $business = Cache::remember('business', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'business');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(7)->get();
        });
        $lifestyle = Cache::remember('lifestyle', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'lifestyle');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(8)->get();
        });
        $stories = Cache::remember('stories', $cacheDuration, function () {
            return News::whereHas('tags', function ($query) {
                $query->where('slug', 'story');
            })->where('status', 1)->orderBy('date', 'DESC')->limit(4)->get();
        });
        $galleries = Cache::remember('galleries', $cacheDuration, function () {
            return  Gallery::orderBy('date', 'DESC')->where('status', 1)->limit(8)->get();
        });
        $videos = Cache::remember('videos', $cacheDuration, function () {
            return  Video::orderBy('date', 'DESC')->where('status', 1)->limit(4)->get();
        });
        $latest = Cache::remember('latestnews', $cacheDuration, function () {
            return News::where('status', 1)->orderBy('date', 'DESC')->limit(8)->get();
        });
        $popular = Cache::remember('popularnews', $cacheDuration, function () {
            return News::where('status', 1)->whereBetween('date', [Carbon::now()->subDays(30), Carbon::now()])->orderBy('visits', 'DESC')->limit(8)->get();
        });

        $home_top_banner = Cache::remember('adv:home_top_banner', 5, function () {
            return  Adv::where('slot', 'home_top_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_featured_box_banner = Cache::remember('adv:home_featured_box_banner', 5, function () {
            return  Adv::where('slot', 'home_featured_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_latest_box_banner = Cache::remember('adv:home_latest_box_banner', 5, function () {
            return  Adv::where('slot', 'home_latest_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_report_box_banner = Cache::remember('adv:home_report_box_banner', 5, function () {
            return  Adv::where('slot', 'home_report_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_business_box_banner = Cache::remember('adv:home_business_box_banner', 5, function () {
            return  Adv::where('slot', 'home_business_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_bottom_banner = Cache::remember('adv:home_bottom_banner', 5, function () {
            return  Adv::where('slot', 'home_bottom_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
            return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
            return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
        });
        $home_religion_box_banner = Cache::remember('adv:home_religion_box_banner', 5, function () {
            return  Adv::where('slot', 'home_religion_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_latest_box_top_banner = Cache::remember('adv:home_latest_box_top_banner', 5, function () {
            return  Adv::where('slot', 'home_latest_box_top_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_sports_box_top_banner = Cache::remember('adv:home_sports_box_top_banner', 5, function () {
            return  Adv::where('slot', 'home_sports_box_top_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $home_gallery_box_top_banner = Cache::remember('adv:home_gallery_box_top_banner', 5, function () {
            return  Adv::where('slot', 'home_gallery_box_top_banner')->where('status', 1)->inRandomOrder()->first();
        });


        MetaTag::set('title', config('app.name'));
        MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
        MetaTag::set('image', asset('/images/ogimage.png'));

        return view('frontend.home', [
            'menus' => $menus,
            'breaking' => $breaking,
            'specialReport' => $specialReport,
            'reports' => $reports,
            'world' => $world,
            'religion' => $religion,
            'sports' => $sports,
            'latest' => $latest,
            'popular' => $popular,
            'business' => $business,
            'breakingRelated' => $breakingRelated,
            'lifestyle' => $lifestyle,
            'stories' => $stories,
            'featuredMain' => $featuredMain,
            'featuredMid' => $featuredMid,
            'featured' => $featured,
            'editorsPick' => $editorsPick,
            'galleries' => $galleries,
            'videos' => $videos,
            'home_top_banner' => $home_top_banner,
            'home_featured_box_banner' => $home_featured_box_banner,
            'home_latest_box_banner' => $home_latest_box_banner,
            'home_report_box_banner' => $home_report_box_banner,
            'home_bottom_banner' => $home_bottom_banner,
            'home_business_box_banner' => $home_business_box_banner,
            'search_box_banner' => $search_box_banner,
            'search_box_logo' => $search_box_logo,
            'home_religion_box_banner' => $home_religion_box_banner,
            'home_latest_box_top_banner' => $home_latest_box_top_banner,
            'home_sports_box_top_banner' => $home_sports_box_top_banner,
            'home_gallery_box_top_banner' => $home_gallery_box_top_banner,
        ]);
    }

    public function tag($slug)
    {
        $cacheDuration = 120;
        $menus = Cache::remember('users', $cacheDuration, function () {
            return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
        });
        if (is_numeric($slug)) {
            $tag = Cache::remember('tag:' . $slug, $cacheDuration, function () use ($slug) {
                return Tag::where('slug', $slug)->first();
            });

            $news = Cache::remember('news:' . $slug, $cacheDuration, function () use ($slug) {
                return News::with('publishedComments')->where('id', $slug)->where('status', 1)->first();
            });
            if (!isset($news)) {
                abort(404);
            }
            //hits increment
            News::where('id', $slug)->where('status', 1)->increment('visits');

            $related = News::where('status', 1)->orderBy('date', 'DESC')->limit(8)->get();
            $latest = Cache::remember('latestnewsInside', $cacheDuration, function () {
                return News::where('status', 1)->orderBy('date', 'DESC')->limit(6)->get();
            });

            $advertorial = Cache::remember('advertorial', $cacheDuration, function () {
                return News::whereHas('tags', function ($query) {
                    $query->where('slug', 'advertorial');
                })->where('status', 1)->orderBy('date', 'DESC')->limit(4)->get();
            });

            $article_top_banner = Cache::remember('adv:article_top_banner', 5, function () {
                return  Adv::where('slot', 'article_top_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $article_side_top = Cache::remember('adv:article_side_top', 5, function () {
                return  Adv::where('slot', 'article_side_top')->where('status', 1)->inRandomOrder()->first();
            });
            $article_side_bottom = Cache::remember('adv:article_side_bottom', 5, function () {
                return  Adv::where('slot', 'article_side_bottom')->where('status', 1)->inRandomOrder()->first();
            });
            $article_inside = Cache::remember('adv:article_inside', 5, function () {
                return  Adv::where('slot', 'article_inside')->where('status', 1)->inRandomOrder()->first();
            });
            $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
                return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
                return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
            });
            $comment_box_top_banner = Cache::remember('adv:comment_box_top_banner', 5, function () {
                return  Adv::where('slot', 'comment_box_top_banner')->where('status', 1)->inRandomOrder()->first();
            });

            MetaTag::set('title', $news->latin ?? 'Voice.mv');
            MetaTag::set('description', $news->summary ?? 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
            MetaTag::set('image',   $news->og_image ? $news->og_image : $news->thumb);

            if ($news->layout == 1) {
                return view('frontend.news-wide', [
                    'menus' => $menus,
                    'related' => $related,
                    'latest' => $latest,
                    'news' => $news,
                    'is_news' => true,
                    'article_top_banner' => $article_top_banner,
                    'article_side_top' => $article_side_top,
                    'article_side_bottom' => $article_side_bottom,
                    'article_inside' => $article_inside,
                    'search_box_banner' => $search_box_banner,
                    'search_box_logo' => $search_box_logo,
                    'comment_box_top_banner' => $comment_box_top_banner
                ]);
            } else {
                return view('frontend.news', [
                    'menus' => $menus,
                    'related' => $related,
                    'latest' => $latest,
                    'news' => $news,
                    'is_news' => true,
                    'advertorial' => $advertorial,
                    'article_top_banner' => $article_top_banner,
                    'article_side_top' => $article_side_top,
                    'article_side_bottom' => $article_side_bottom,
                    'article_inside' => $article_inside,
                    'search_box_banner' => $search_box_banner,
                    'search_box_logo' => $search_box_logo,
                    'comment_box_top_banner' => $comment_box_top_banner
                ]);
            }
        } else {
            $tag = Cache::remember('tag:' . $slug, $cacheDuration, function () use ($slug) {
                return Tag::where('slug', $slug)->first();
            });
            if (!isset($tag)) {
                abort(404);
            }

            $news = News::whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->orderBy('date', 'DESC')->where('status', 1)->paginate(12);

            $tag_top_banner = Cache::remember('adv:tag_top_banner', 5, function () {
                return  Adv::where('slot', 'tag_top_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $tag_bottom_banner = Cache::remember('adv:tag_bottom_banner', 5, function () {
                return  Adv::where('slot', 'tag_bottom_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
                return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
                return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
            });
            $tag_specific_top_banner = Cache::remember('adv:tag_specific_top_banner:' . $tag->id, 5, function () use ($tag) {
                return  Adv::where('slot', 'tag_specific_top_banner')->where('tag_id', $tag->id)->where('status', 1)->inRandomOrder()->first();
            });

            MetaTag::set('title', config('app.name') . " - " . $tag->name);
            MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
            MetaTag::set('image', asset('/images/ogimage.png'));

            return view('frontend.tag', [
                'menus' => $menus,
                'news' => $news,
                'tag' => $tag,
                'tag_top_banner' => $tag_top_banner,
                'tag_bottom_banner' => $tag_bottom_banner,
                'search_box_banner' => $search_box_banner,
                'search_box_logo' => $search_box_logo,
                'tag_specific_top_banner' => $tag_specific_top_banner
            ]);
        }
    }

    public function search(Request $request)
    {
        if (isset($request->keyword)) {
            $cacheDuration = 120;
            $menus = Cache::remember('users', $cacheDuration, function () {
                return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
            });
            $news = News::where('title', 'LIKE', '%' . $request->keyword . '%')->orderBy('date', 'DESC')->where('status', 1)->paginate(12);

            $tag_top_banner = Cache::remember('adv:tag_top_banner', 5, function () {
                return  Adv::where('slot', 'tag_top_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $tag_bottom_banner = Cache::remember('adv:tag_bottom_banner', 5, function () {
                return  Adv::where('slot', 'tag_bottom_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
                return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
            });
            $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
                return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
            });

            MetaTag::set('title', config('app.name') . " - " . $request->keywrod);
            MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
            MetaTag::set('image', asset('/images/ogimage.png'));

            return view('frontend.search', [
                'menus' => $menus,
                'news' => $news,
                'tag_top_banner' => $tag_top_banner,
                'tag_bottom_banner' => $tag_bottom_banner,
                'search_box_banner' => $search_box_banner,
                'search_box_logo' => $search_box_logo,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function authors($id)
    {
        $cacheDuration = 120;
        $menus = Cache::remember('users', $cacheDuration, function () {
            return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
        });
        $news = News::orderBy('date', 'DESC')->where('status', 1)->where('author_id', $id)->paginate(30);
        $user = User::findOrFail($id);
        $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
            return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
            return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
        });

        MetaTag::set('title', config('app.name') . " - " . $user->name);
        MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
        MetaTag::set('image', asset('/images/ogimage.png'));

        return view('frontend.author', [
            'menus' => $menus,
            'news' => $news,
            'user' => $user,
            'search_box_banner' => $search_box_banner,
            'search_box_logo' => $search_box_logo,
        ]);
    }

    public function galleries($id)
    {
        $cacheDuration = 120;
        $menus = Cache::remember('users', $cacheDuration, function () {
            return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
        });
        $related = News::orderBy('date', 'DESC')->where('status', 1)->limit(4)->get();
        $gallery = Gallery::where('id', $id)->where('status', 1)->first();

        $tag_top_banner = Cache::remember('adv:tag_top_banner', 5, function () {
            return  Adv::where('slot', 'tag_top_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
            return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
            return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
        });

        MetaTag::set('title', config('app.name') . " - " . $gallery->latin);
        MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
        MetaTag::set('image', $gallery->image);

        return view('frontend.gallery', [
            'menus' => $menus,
            'related' => $related,
            'gallery' => $gallery,
            'tag_top_banner' => $tag_top_banner,
            'search_box_banner' => $search_box_banner,
            'search_box_logo' => $search_box_logo,
        ]);
    }

    public function videos($id)
    {
        $cacheDuration = 120;
        $menus = Cache::remember('users', $cacheDuration, function () {
            return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
        });
        $related = News::orderBy('date', 'DESC')->where('status', 1)->limit(4)->get();
        $video = Video::where('id', $id)->where('status', 1)->first();

        $tag_top_banner = Cache::remember('adv:tag_top_banner', 5, function () {
            return  Adv::where('slot', 'tag_top_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
            return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
            return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
        });

        MetaTag::set('title', config('app.name') . " - " . $video->latin);
        MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
        MetaTag::set('image', $video->image);

        return view('frontend.video', [
            'menus' => $menus,
            'related' => $related,
            'video' => $video,
            'tag_top_banner' => $tag_top_banner,
            'search_box_banner' => $search_box_banner,
            'search_box_logo' => $search_box_logo,
        ]);
    }

    public function quotes($id)
    {
        $cacheDuration = 120;
        $menus = Cache::remember('users', $cacheDuration, function () {
            return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
        });
        $related = News::orderBy('date', 'DESC')->where('status', 1)->limit(4)->get();
        $quote = NewsQuote::where('id', $id)->where('status', 1)->first();

        $tag_top_banner = Cache::remember('adv:tag_top_banner', 5, function () {
            return  Adv::where('slot', 'tag_top_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
            return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
            return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
        });

        MetaTag::set('title', config('app.name') . " - " . $quote->latin);
        MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
        MetaTag::set('image', $quote->image);

        return view('frontend.quote', [
            'menus' => $menus,
            'related' => $related,
            'quote' => $quote,
            'tag_top_banner' => $tag_top_banner,
            'search_box_banner' => $search_box_banner,
            'search_box_logo' => $search_box_logo,
        ]);
    }

    public function comment(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            "name" => "required",
            "comment" => "required|max:225",
            "news_id" => "required",
            recaptchaFieldName() => recaptchaRuleName()
        ], [
            'name.required' => "please provide a valid Name",
            'comment.required' => "please provide a valid Comment",
            'news_id.required' => "something went wrong!",
        ]);

        // check if validator fails
        if ($validator->fails()) {
            return redirect('/' . $request->news_id . '#commentslist')->with('errorMessage', 'Sorry, ' . $validator->errors()->first() . '!')->withInput();
        }

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->comment = $request->comment;
        $comment->news_id = $request->news_id;
        $comment->save();

        return redirect('/' . $comment->news_id . '#commentslist')->with('success', 'Your comment has been sent successfully!');
    }

    public function ourTeam(Request $request)
    {
        $cacheDuration = 120;
        $menus = Cache::remember('users', $cacheDuration, function () {
            return Tag::orderBy('order', "DESC")->where('is_main_menu', 'yes')->limit(8)->get();
        });
        $members = User::orderBy('order', 'DESC')->where('is_team_member', 'yes')->get();

        $home_top_banner = Cache::remember('adv:home_top_banner', 5, function () {
            return  Adv::where('slot', 'home_top_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_banner = Cache::remember('adv:search_box_banner', 5, function () {
            return  Adv::where('slot', 'search_box_banner')->where('status', 1)->inRandomOrder()->first();
        });
        $search_box_logo = Cache::remember('adv:search_box_logo', 5, function () {
            return  Adv::where('slot', 'search_box_logo')->where('status', 1)->inRandomOrder()->first();
        });

        MetaTag::set('title', config('app.name') . " - Our Team");
        MetaTag::set('description', 'Voice is a media startup looking forward to disrupting the media landscape in the Maldives with the aim of being the voice of the political, sports, business and social community of the Maldives.');
        MetaTag::set('image', asset('/images/ogimage.png'));

        return view('frontend.our-team', [
            'menus' => $menus,
            'members' => $members,
            'home_top_banner' => $home_top_banner,
            'search_box_banner' => $search_box_banner,
            'search_box_logo' => $search_box_logo,
        ]);
    }

    public function latest()
    {
        $news = Cache::remember('news:rssfeed', 120, function () {
            return News::orderBy('date', 'DESC')->where('status', 1)->limit(10)->get();
        });

        return response()->view('frontend.latest', [
            'news' => $news
        ])->header('Content-Type', 'text/xml');
    }
}
