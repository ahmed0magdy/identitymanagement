<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    ####Getting endpoints####
    public function index()
    {
        //get all roles
        $roles = Role::all();
        return $roles;
    }

    public function show(Role $role)
    {
        // get all permissions for given role
        $rolePermissions = $role->getAllPermissions();
        return $rolePermissions;
    }
    public function getAllPermissions()
    {
        $permissions = Permission::all();
        return $permissions;
    }

    public function getUserPermissions(User $user)
    {
        $userPermissions = $user->getAllPermissions();
        return $userPermissions;
    }

    public function getUserRoles(User $user)
    {
        // get the names of the user's roles
        $roles = $user->getRoleNames(); // Returns a collection
        return $roles;
    }

    public function getUsersWithGivenRole(Role $role)
    {
        $users = User::role($role->name)->get(); // Returns only users with the role 'x'
        return $users;
    }
    public function getUsersWithGivenPermission(Permission $permission)
    {
        $users = User::permission($permission->name)->get(); // Returns only users with the permission 'y'
        return $users;
    }

    ####Assigning endpoints####
    public function store(Request $request)
    {
        //create new role with permissions
        $role = Role::create(['name' => $request->role]);
        $role->givePermissionTo($request->permissions);
        return $role;
    }

    public function update(Request $request)
    {
        //edit role permissions
        $role = Role::find($request->role); // role id
        $role->syncPermissions($request->permissions); // replace all old permissions with new ones
        return $role;
    }
    public function assignPermissionsToRole(Request $request)
    {
        $role = Role::find($request->role); // role id
        $role->givePermissionTo($request->permissions);
        return $role;
    }

    public function assignPermissionsToUser(Request $request)
    {
        $user = User::find($request->user);
        $user->givePermissionTo($request->permissions);
        // $user->syncPermissions($request->Permissions);
        return $user;
    }

    public function assignRolesToUser(Request $request)
    {
        $user = User::find($request->user);
        $user->assignRole($request->roles);
        return $user;
    }


    ####Check if endpoints####
    public function userHasPermission(User $user, Permission $permission)
    {
        //  $x= ($user->hasPermissionTo($request->permission))? 'true': 'false';
        return ($user->hasPermissionTo($permission->name)) ? 'true' : 'false';
    }

    public function userHasRole(User $user, Role $role)
    {
        return ($user->hasRole($role->name)) ? 'true' : 'false';
    }

    public function roleHasPermission(Role $role, Permission $permission)
    {
        return ($role->hasPermissionTo($permission->name)) ? 'true' : 'false';
    }
    ####Removing endpoints####
    public function destroy(Role $role)
    {
        // removing role
        return $role->delete();
    }
    public function removeUserRole(Request $request)
    {
        $user = User::find($request->user);
        // $user->removeRole($request->role); // removing only one role
        return $user->syncRoles($request->roles); // replace old roles with new ones or none if roles array empty
    }

    public function removeUserPermissions(Request $request)
    {
        $user = User::find($request->user);
        $user->revokePermissionTo($request->permissions);
        return $user;
    }

    public function removeRolePermissions(Request $request)
    {
        $role = Role::find($request->role);
        $role->revokePermissionTo($request->permissions);
        return $role;
    }
}
