<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

#### roles crud ####
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
        $role = Role::find($id);
        $rolePermissions =$role->getAllPermissions();
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
       return DB::table("roles")->where('id', $id)->delete();
    }

####Assigning endpoints####
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

####Getting endpoints####
    public function getAllPermissions()
    {
        $permissions = Permission::all();
        return $permissions;
    }

    public function getUserPermissions($id)
    {
        $user = User::find($id);
        $userPermissions = $user->getAllPermissions();
        return$userPermissions;
    }


    public function getUserRoles($id)
    {
         $user = User::find($id);
         // get the names of the user's roles
         $roles = $user->getRoleNames(); // Returns a collection
         return $roles;
    }

    public function getUsersWithGivenRole($id)
    {
         $role = Role::find($id);
         $users = User::role($role->name)->get(); // Returns only users with the role 'writer'
         return $users;
    }
    public function getUsersWithGivenPermission($id)
    {
         $permission = Permission::find($id);
         $users = User::permission($permission->name)->get(); // Returns only users with the permission 'edit articles' (inherited or directly)
         return $users;
    }
####Check if endpoints####
    public function UserHasPermission($user,$permission)
    {
         $user = user::find($user);
         $permission = Permission::find($permission);
        //  $x= ($user->hasPermissionTo($request->permission))? 'true': 'false';
        return ($user->hasPermissionTo($permission->name))? 'true': 'false';

    }

    public function UserHasRole($user,$role)
    {
         $user = user::find($user);
         $role = Role::find($role);
        return ($user->hasRole($role->name))? 'true': 'false';

    }

    public function RoleHasPermission($role,$permission)
    {
        $role = Role::find($role);
        $permission = Permission::find($permission);

        return ($role->hasPermissionTo($permission->name))? 'true': 'false';

    }
####Removing endpoints####
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
