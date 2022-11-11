<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLoginLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            return view('backend.users.index', [
                'users' => User::latest()->paginate(60)
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            return view('backend.users.form', [
                'user' => new User()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'title' => 'required',
                'slug' => 'required',
                'password' => 'required',
                'order' => 'required|integer',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->title = $request->title;
            $user->twitter = $request->twitter;
            $user->facebook = $request->facebook;
            $user->about = $request->about;
            $user->slug = $request->slug;
            $user->is_team_member = $request->is_team_member;
            $user->is_voice_writer = $request->is_voice_writer;
            $user->order = $request->order;

            if (isset($request->password)) {
                $user->password = bcrypt($request->password);
            }

            if (isset($request->image)) {
                $user->image = uploadFileToDO($request->file('image'), "images");
            }

            $user->save();

            return redirect()->route(config('app.admindomain') . '.users.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $user = User::findOrFail($id);
            return view('backend.users.form', [
                'user' => $user,
                'roles' => Role::all(),
                'userroles' => $user->roles,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'title' => 'required',
                'slug' => 'required',
                'order' => 'required|integer',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->title = $request->title;
            $user->twitter = $request->twitter;
            $user->facebook = $request->facebook;
            $user->about = $request->about;
            $user->slug = $request->slug;
            $user->is_team_member = $request->is_team_member;
            $user->is_voice_writer = $request->is_voice_writer;
            $user->order = $request->order;

            if (isset($request->password)) {
                $user->password = bcrypt($request->password);
            }

            if (isset($request->image)) {
                $user->image = uploadFileToDO($request->file('image'), "images");
            }

            $user->save();

            return redirect()->route(config('app.admindomain') . '.users.index');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function addRole($id, $role)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $user = User::findOrFail($id);
            $user->assignRole($role);

            return redirect()->route(config('app.admindomain') . '.users.edit', $id);
        }
    }

    public function removeRole($id, $role)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $user = User::findOrFail($id);
            $user->removeRole($role);

            return redirect()->route(config('app.admindomain') . '.users.edit', $id);
        }
    }

    public function loginLog($id)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {

            if (isset(request()->from) && isset(request()->to)) {
                $logs = UserLoginLog::where('user_id', $id)->whereBetween('created_at', [Carbon::parse(request()->from), Carbon::parse(request()->to)])->latest()->paginate(30);
            } else {
                $logs = UserLoginLog::where('user_id', $id)->latest()->paginate(30);
            }

            return view('backend.users.login-log', [
                'logs' => $logs,
                'user' => User::findOrFail($id),
            ]);
        }
    }
}
