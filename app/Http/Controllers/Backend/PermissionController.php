<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            return view('backend.permissions.index', [
                'permissions' => Permission::all()
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            return view('backend.permissions.form', [
                'permission' => new Permission()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            Permission::create(['name' => $request->name]);

            return redirect()->route(config('app.admindomain') . '.permissions.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            return view('backend.permissions.form', [
                'permission' => Permission::findOrFail($id)
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $permission = Permission::findOrFail($id);
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route(config('app.admindomain') . '.permissions.index');
        }
    }

    public function destroy($id)
    {
        //
    }
}
