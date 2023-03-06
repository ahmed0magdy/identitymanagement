<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        //get all roles
        $roles = Role::all();
        return $roles;

    }

    public function store(Request $request)
    {
        //create new role with permissions
        $role = Role::create(['name'=>$request->role]);
        $role->syncPermissions($request->permissions);
        return $role;
    }


    public function show($id)
    {
        //show role permissions getRolePermissions()
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return $rolePermissions;
    }


    public function update(Request $request, $id)
    {
        //edit role permissions
        $role = Role::find($id);
        $role->syncPermissions($request->permissions);
        return $role;
    }


    public function destroy($id)
    {
        //delete role
        DB::table("roles")->where('id', $id)->delete();
    }

    public function assginPermissionsToRole(Request $request, $id)
    {
        //
        $role = Role::find($id);
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function assginPermissionsToUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncPermissions($request->permissions);
        // $user->givePermissionTo($request->Permissions);
        return $user;
    }

    public function assginRolesToUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->assignRole($request->roles);
        return $user;
    }


    public function getUserPermisions($id)
    {
        //show role permissions getRolePermissions()
        $userPermissions = Permission::join("model_has_permissions", "model_has_permissions.permission_id", "=", "permissions.id")
            ->where("model_has_permissions.model_id", $id)
            ->get();
        return $userPermissions;
    }

    public function getallPermissions()
    {
        $permissions = Permission::all();
        return $permissions;
    }

}
