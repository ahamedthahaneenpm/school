<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleAddRequest;
use App\Http\Requests\Admin\Role\RoleCreateRequest;
use App\Http\Requests\Admin\Role\RoleDeleteRequest;
use App\Http\Requests\Admin\Role\RoleEditRequest;
use App\Http\Requests\Admin\Role\RoleListDataRequest;
use App\Http\Requests\Admin\Role\RoleListRequest;
use App\Http\Requests\Admin\Role\RoleStatusChangeRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Repositories\User\UserRepositoryInterface as UserRepository;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{

    public function listRoles(RoleListRequest $request)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['name' => "Roles"]
        ];
        return view('admin.roles.listRoles', compact('breadcrumbs'));
    }

    public function rolesListData(RoleListDataRequest $request, UserRepository $userRepo)
    {
        $roles = $userRepo->getAllRoles($request->all());
        $dataTableJSON = DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('status', function ($role) use ($request) {
                if ($request->user()->can('role_update')) {
                    $data['url'] = route('role_status_change');
                } else {
                    $data['url'] = "#";
                }
                $data['id'] = $role->id;
                $data['status'] = $role->status;
                return  view('admin.elements.listStatus', compact('data'));
            })->addColumn('action', function ($role) use ($request) {
                $data = [];
                if ($request->user()->can('role_update')) {
                    $data['edit_url'] = route('role_edit', ['id' => $role->id]);
                }
                if ($request->user()->can('role_delete')) {
                    $data['delete_url'] = route('role_delete', ['id' => $role->id]);
                }

                return  view('admin.elements.listAction', compact('data'));
            })->make();
        return $dataTableJSON;
    }

    public function addRole(RoleAddRequest $request, UserRepository $userRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'role_list', 'name' => "Roles", "permission" => 'role_read'],
            ['name' => "Add Role"]
        ];
        $permissions = $userRepo->getPermissionTemplate();
        return view('admin.roles.addRole', compact('permissions', 'breadcrumbs'));
    }

    public function createRole(RoleCreateRequest $request, UserRepository $userRepo)
    {
        $data = [
            'name' => $request->name,
            'status' => $request->status,
        ];
        $permissions = $request->permissions;
        $userRepo->createRole($data, $permissions);
        return redirect()
            ->route('role_list')
            ->with('success', 'Role added successfully');
    }

    public function editRole(RoleEditRequest $request, UserRepository $userRepo)
    {
        $breadcrumbs = [
            ['link' => 'dashboard', 'name' => "Dashboard"],
            ['link' => 'role_list', 'name' => "Roles", "permission" => 'role_read'],
            ['name' => "Edit Role"]
        ];
        $id = $request->id;
        $role = $userRepo->getRole($id);
        $activePermissions = $role->getPermissionNames();
        $permissions = $userRepo->getPermissionTemplate();
        return view('admin.roles.editRole', compact('permissions', 'activePermissions', 'role', 'breadcrumbs'));
    }

    public function updateRole(RoleUpdateRequest $request, UserRepository $userRepo)
    {
        $data = [
            'name' => $request->name,
            'status' => $request->status,
        ];
        $permissions = $request->permissions;
        $userRepo->updateRole($request->id, $data, $permissions);
        return redirect()
            ->route('role_list')
            ->with('success', 'Role updated successfully');
    }

    public function statusChange(RoleStatusChangeRequest $request, UserRepository $userRepo)
    {
        if ($userRepo->roleStatusUpdate($request->id)) {
            return response()->json(['status' => 1, 'message' => "success"]);
        }
        return response()->json(['status' => 0, 'message' => "failed"]);
    }

    public function deleteRole(RoleDeleteRequest $request, UserRepository $userRepo)
    {
        $roleUsers = $userRepo->roleUsers($request->id);
        $status = false;
        if (empty($roleUsers) || $roleUsers->count() <= 0) {
            $status = $userRepo->deleteRole($request->id);
        }
        if ($request->expectsJson()) {
            if ($status) {
                return response()->json(['status' => 1, 'message' => "Role deleted successfully"]);
            }
            return response()->json(['status' => 0, 'message' => "Role deleted failed"]);
        } else {
            if ($status) {
                return redirect()
                    ->route('role_list')
                    ->with('success', 'Role deleted successfully');
            } else {
                return redirect()
                    ->route('role_list')
                    ->with('error', 'Role deleted failed');
            }
        }
    }
}
