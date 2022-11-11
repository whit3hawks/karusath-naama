<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            return view('backend.roles.index', [
                'roles' => Role::all()
            ]);
        }
    }

    public function create()
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            return view('backend.roles.form', [
                'role' => new Role()
            ]);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            Role::create(['name' => $request->name]);
            return redirect()->route(config('app.admindomain') . '.roles.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $role = Role::findOrFail($id);
            return view('backend.roles.form', [
                'role' => $role,
                'permissions' => $role->permissions,
                'allpermissions' => Permission::all()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->save();

            return redirect()->route(config('app.admindomain') . '.roles.index');
        }
    }

    public function destroy($id)
    {
        //
    }


    public function addPermission($id, $permission)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $role = Role::findOrFail($id);
            $role->givePermissionTo($permission);

            return redirect()->route(config('app.admindomain') . '.roles.edit', $id);
        }
    }

    public function removePermission($id, $permission)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $role = Role::findOrFail($id);
            $role->revokePermissionTo($permission);

            return redirect()->route(config('app.admindomain') . '.roles.edit', $id);
        }
    }
}
