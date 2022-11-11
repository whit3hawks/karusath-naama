<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MediaPhoto;
use Illuminate\Http\Request;

class MediaPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $photos = request()->keyword ? MediaPhoto::where('caption', 'LIKE', '%' . request()->keyword . '%')->latest()->paginate(60) : MediaPhoto::latest()->paginate(30);
            return view('backend.media-photo.index', [
                'photos' => $photos
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {

            $this->validate($request, [
                'file' => 'required',
                'caption' => 'required',
            ], [
                'caption.required' => 'Provide a valid caption for the image.',
            ]);

            $photo = new MediaPhoto();
            $photo->caption = $request->caption;
            $photo->user_id = auth()->user()->id;

            $imagePath = uploadFileToDO($request->file('file'), "images");
            uploadLargeThumbToDO($request->file('file'), "images", $imagePath);
            uploadSmallThumbToDO($request->file('file'), "images", $imagePath);

            $photo->image = $imagePath;
            $photo->save();

            return redirect()->route(config('app.admindomain') . '.media-photos.index', ['status' => 0])->with('successMessage', 'Photo added to media library.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = MediaPhoto::findOrFail($id);
        $photo->delete();

        return back();
    }

    public function searchPhotos($keyword)
    {
        $photos = MediaPhoto::where('caption', 'LIKE', '%' . request()->keyword . '%')->latest()->limit(60)->get();
        return response()->json($photos);
    }
}
