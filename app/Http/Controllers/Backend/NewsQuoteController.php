<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NewsQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class NewsQuoteController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.news-quotes.index', [
                'quotes' => request()->keyword ? NewsQuote::where('latin', 'LIKE', '%' . request()->keyword . '%')->latest()->paginate(60) : NewsQuote::latest()->paginate(60)
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.news-quotes.form', [
                'quote' => new NewsQuote()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'quote' => 'required',
                'by' => 'required',
                'latin' => 'required',
            ]);

            $quote = new NewsQuote();
            $quote->quote = $request->quote;
            $quote->by = $request->by;
            $quote->latin = $request->latin;
            $quote->created_by = auth()->user()->id;

            if (isset($request->file)) {
                $quote->image = uploadFileToDO($request->file('file'), "images");
            }

            $quote->save();


            if (isset($quote->image)) {
                $ogImagePath = str_replace(config('filesystems.disks.do.url') . '/', '', $quote->image);
                $this->generateShot($quote->id, str_replace("original_", "quote_", $ogImagePath));
            }

            return redirect()->route(config('app.admindomain') . '.news-quotes.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            return view('backend.news-quotes.form', [
                'quote' => NewsQuote::findOrFail($id),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor', 'writer'])) {
            $this->validate($request, [
                'quote' => 'required',
                'by' => 'required',
                'latin' => 'required',
            ]);

            $quote = NewsQuote::findOrFail($id);
            $quote->quote = $request->quote;
            $quote->by = $request->by;
            $quote->latin = $request->latin;

            if (isset($request->file)) {
                $quote->image = uploadFileToDO($request->file('file'), "images");
            }

            $quote->save();

            if (isset($quote->image)) {
                $ogImagePath = str_replace(config('filesystems.disks.do.url') . '/', '', $quote->image);
                $this->generateShot($quote->id, str_replace("original_", "quote_", $ogImagePath));
            }

            return redirect()->route(config('app.admindomain') . '.news-quotes.index');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function status($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $video = NewsQuote::findOrFail($id);
            if ($video->status == 0) {
                $video->status = 1;
            } else {
                $video->status = 0;
            }
            $video->save();

            return redirect()->route(config('app.admindomain') . '.news-quotes.index');
        }
    }

    public function generateShot($id, $path)
    {
        $quote = NewsQuote::findOrFail($id);
        $screenshot = Browsershot::url(config('app.url') . '/shot/quote/' . $quote->id)
            ->setScreenshotType('png')
            ->windowSize(1024, 1024)
            ->screenshot();

        $image_path = Storage::disk('do')->put($path, $screenshot, 'public');
        return $image_path;
    }

    public function shot($id)
    {
        $quote = NewsQuote::findOrFail($id);
        return view('frontend.shot.quote', [
            'quote' => $quote
        ]);
    }
}
