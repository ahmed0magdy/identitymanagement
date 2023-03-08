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
        $role->givePermissionTo($request->permissions);
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


    public function update(Request $request,$id)
    {
        //edit role permissions
        $role = Role::find($id);
        $role->syncPermissions($request->permissions); // replace all old permissions with new ones
        return $role;
    }


    public function destroy($id)
    {
        //delete role
       return DB::table("roles")->where('id', $id)->delete();
    }

    public function assignPermissionsToRole(Request $request, $id)
    {
        $role = Role::find($id);
        $role->givePermissionTo($request->permissions);
        return $role;
    }

    public function assignPermissionsToUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->givePermissionTo($request->permissions);
        // $user->syncPermissions($request->Permissions);
        return $user;
    }

    public function assignRolesToUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->assignRole($request->roles);
        return $user;
    }


    public function getUserPermissions($id)
    {
        //show user permissions getUserPermissions()
        $userPermissions = Permission::join("model_has_permissions", "model_has_permissions.permission_id", "=", "permissions.id")
            ->where("model_has_permissions.model_id", $id)
            ->get();
        return $userPermissions;
    }

    public function getAllPermissions()
    {
        $permissions = Permission::all();
        return $permissions;
    }

    /////
    public function removeUserRole(Request $request, $id)
    {
        $user = User::find($id);
        // $user->removeRole($request->role); // removing only one role
        return $user->syncRoles($request->roles); // replace old roles with new ones or none if roles array empty
    }

    public function removeUserPermissions(Request $request, $id)
    {
        $user = User::find($id);
        $user->revokePermissionTo($request->permissions);
        return $user;
    }

    public function removeRolePermissions(Request $request, $id)
    {
        $role = Role::find($id);
        $role->revokePermissionTo($request->permissions);
        return $role;
    }
}
