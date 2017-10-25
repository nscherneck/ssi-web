<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    public function store(Request $request, Role $role)
    {
        $user = User::findOrFail($request->input('user_id'));
        $user->assignRole($role->name);
        flash('Success!', 'Role assigned to user');
        return back();
    }
}
