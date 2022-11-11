<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.video.index', [
                'videos' => request()->keyword ? Video::where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(60) : Video::orderBy('date', 'DESC')->paginate(60)
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.video.form', [
                'video' => new Video()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'title' => 'required',
                'url' => 'required',
                'latin' => 'required',
                'description' => 'required',
            ]);

            $video = new Video();
            $video->title = $request->title;
            $video->date = $request->date;
            $video->url = $request->url;
            $video->latin = $request->latin;
            $video->description = $request->description;

            if (isset($request->file)) {
                $video->image = uploadFileToDO($request->file('file'), "images");
            }

            $video->save();

            return redirect()->route(config('app.admindomain') . '.videos.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.video.form', [
                'video' => Video::findOrFail($id),
                'images' => GalleryImage::where('gallery_id', $id)->get()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'title' => 'required',
                'url' => 'required',
                'latin' => 'required',
                'description' => 'required',
            ]);

            $video = Video::findOrFail($id);
            $video->title = $request->title;
            $video->date = $request->date;
            $video->url = $request->url;
            $video->latin = $request->latin;
            $video->description = $request->description;

            if (isset($request->file)) {
                $video->image = uploadFileToDO($request->file('file'), "images");
            }

            $video->save();

            return redirect()->route(config('app.admindomain') . '.videos.index');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function status($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $video = Video::findOrFail($id);
            if ($video->status == 0) {
                $video->status = 1;
            } else {
                $video->status = 0;
            }
            $video->save();

            return redirect()->route(config('app.admindomain') . '.videos.index');
        }
    }
}
