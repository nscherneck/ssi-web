<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleController extends Controller
{
    public function store(Request $request, Role $role)
    {
        $permission = Permission::findOrFail($request->input('permission_id'));
        $role->givePermissionTo($permission->name);
        flash('Success!', 'Permission assigned to role');
        return back();
    }
}
