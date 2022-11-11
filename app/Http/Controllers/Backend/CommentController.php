<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            return view('backend.comment.index', [
                'comments' => Comment::latest()->paginate(60)
            ]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function status($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $comment = Comment::findOrFail($id);
            if ($comment->status == 0) {
                $comment->status = 1;
            } else {
                $comment->status = 0;
            }
            $comment->save();

            return redirect()->route(config('app.admindomain') . '.comments.index');
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasAnyRole(['admin', 'editor'])) {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return back();
        }
    }
}
