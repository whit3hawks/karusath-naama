<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Adv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.adv.index', [
                'advs' => request()->keyword ? Adv::where('slot', 'LIKE', '%' . request()->keyword . '%')->latest()->paginate(30) : Adv::latest()->paginate(30)
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.adv.form', [
                'adv' => new Adv()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $adv = new Adv();
            $adv->slot = $request->slot;
            $adv->url = $request->url;
            $adv->tag_id = $request->tag_id;

            if (isset($request->file)) {
                $adv->image = uploadFileToDO($request->file('file'), "advs");
            }

            $adv->save();

            return redirect()->route(config('app.admindomain') . '.advs.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.adv.form', [
                'adv' => Adv::findOrFail($id),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $adv = Adv::findOrFail($id);
            $adv->slot = $request->slot;
            $adv->url = $request->url;
            $adv->tag_id = $request->tag_id;

            if (isset($request->file)) {
                $adv->image = uploadFileToDO($request->file('file'), "advs");
            }

            $adv->save();

            return redirect()->route(config('app.admindomain') . '.advs.index');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function status($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $adv = Adv::findOrFail($id);
            if ($adv->status == 0) {
                $adv->status = 1;
            } else {
                $adv->status = 0;
            }
            $adv->save();

            return redirect()->route(config('app.admindomain') . '.advs.index');
        }
    }
}
