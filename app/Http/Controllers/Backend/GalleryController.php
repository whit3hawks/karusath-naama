<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.gallery.index', [
                'galleries' => request()->keyword ? Gallery::where('latin', 'LIKE', '%' . request()->keyword . '%')->orderBy('date', 'DESC')->paginate(60) : Gallery::orderBy('date', 'DESC')->paginate(60)
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.gallery.form', [
                'gallery' => new Gallery()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'latin' => 'required',
            ]);

            $gallery = new Gallery();
            $gallery->title = $request->title;
            $gallery->date = $request->date;
            $gallery->latin = $request->latin;
            $gallery->description = $request->description;

            if (isset($request->file)) {
                $gallery->image = uploadFileToDO($request->file('file'), "images");
            }

            $gallery->save();

            return redirect()->route(config('app.admindomain') . '.galleries.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.gallery.form', [
                'gallery' => Gallery::findOrFail($id),
                'images' => GalleryImage::where('gallery_id', $id)->get()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'latin' => 'required',
            ]);

            $gallery = Gallery::findOrFail($id);
            $gallery->title = $request->title;
            $gallery->date = $request->date;
            $gallery->latin = $request->latin;
            $gallery->description = $request->description;

            if (isset($request->file)) {
                $gallery->image = uploadFileToDO($request->file('file'), "images");
            }

            $gallery->save();

            return redirect()->route(config('app.admindomain') . '.galleries.index');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function image(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'files' => 'required'
            ]);

            if (isset($request->files)) {
                $files = $request->file('files');
                foreach ($files as $file) {
                    $image = new GalleryImage();
                    $image->gallery_id = $id;
                    $image->image = uploadFileToDO($file, "images");
                    $image->save();
                }
            }

            return redirect()->route(config('app.admindomain') . '.galleries.edit', $id);
        }
    }

    public function imageDelete($id, $imageid)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $image = GalleryImage::findOrFail($imageid);
            $image->delete();
            return redirect()->route(config('app.admindomain') . '.galleries.edit', $id);
        }
    }

    public function status($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $gallery = Gallery::findOrFail($id);
            if ($gallery->status == 0) {
                $gallery->status = 1;
            } else {
                $gallery->status = 0;
            }
            $gallery->save();

            return redirect()->route(config('app.admindomain') . '.galleries.index');
        }
    }
}
