<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\UserPermission;
use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class hasPermission
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current user
        $user = $request->user();
        // Get the current route
        $currentRoute = $request->route()->getName();

        $permission = Permission::where('route_name', $currentRoute)->first();

        if(!$permission){
            return $next($request);
        }

        $roles_id = UserRole::where('user_id', $user->id)->pluck('role_id');

        $rolePermission = RolePermission::whereIn('role_id', $roles_id)
            ->where('permission_id', $permission->id)
            ->first();

        $usePermission = UserPermission::where('user_id', $user->id)
            ->where('permission_id', $permission->id)
            ->first();


        if(!$rolePermission && !$usePermission){
            return redirect()->route('dashboard');
        }



        return $next($request);
    }
}
