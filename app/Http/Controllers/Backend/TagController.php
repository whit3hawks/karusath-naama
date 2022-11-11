<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.tags.index', [
                'tags' => request()->keyword  ? Tag::where('slug', 'LIKE', '%' . request()->keyword . '%')->orderBy('order', "DESC")->latest()->paginate(60) : Tag::orderBy('order', "DESC")->latest()->paginate(60)
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.tags.form', [
                'tag' => new Tag()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $this->validate($request, [
                'name' => 'required',
                'slug' => 'required',
                'order' => 'required'
            ]);

            $tag = new Tag();
            $tag->name = $request->name;
            $tag->slug = $request->slug;
            $tag->is_main_menu = $request->is_main_menu;
            $tag->type = $request->type;
            $tag->order = $request->order;
            $tag->summary = $request->summary;
            $tag->hide_from_article = $request->hide_from_article;

            if (isset($request->image)) {
                $tag->image = uploadFileToDO($request->file('image'), "images");
            }

            if (isset($request->cover)) {
                $tag->cover = uploadFileToDO($request->file('cover'), "images");
            }

            $tag->save();

            return redirect()->route(config('app.admindomain') . '.tags.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function search($slug)
    {
        return response()->json([
            'tags' => Tag::where('slug', 'LIKE', '%' . $slug . '%')->limit(10)->get()
        ]);
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.tags.form', [
                'tag' => Tag::findOrFail($id),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $this->validate($request, [
                'name' => 'required',
                'slug' => 'required',
                'order' => 'required'
            ]);

            $tag = Tag::findOrFail($id);
            $tag->name = $request->name;
            $tag->slug = $request->slug;
            $tag->is_main_menu = $request->is_main_menu;
            $tag->type = $request->type;
            $tag->order = $request->order;
            $tag->summary = $request->summary;
            $tag->hide_from_article = $request->hide_from_article;

            if (isset($request->image)) {
                $tag->image = uploadFileToDO($request->file('image'), "images");
            }

            if (isset($request->cover)) {
                $tag->cover = uploadFileToDO($request->file('cover'), "images");
            }

            $tag->save();

            return redirect()->route(config('app.admindomain') . '.tags.index');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function addSubTag($id, Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $tag = Tag::where('slug', $request->slug)->first();
            if (isset($tag)) {
                $subTag = new SubTag();
                $subTag->parent_tag_id = $id;
                $subTag->tag_id = $tag->id;
                $subTag->save();
            }

            return back();
        }
    }

    public function removeSubTag($id, $sub_tag_id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $subTag = SubTag::findOrFail($sub_tag_id);
            $subTag->delete();

            return back();
        }
    }
}
