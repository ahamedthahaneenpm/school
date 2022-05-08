<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    public function createUser($details)
    {
        $user = new User;
        foreach ($details as $key => $value) {
            if (!empty($value)) {
                $user->$key = $value;
            }
        }
        $user->save();
        return $user;
    }

    public function updateUser($userId, $details)
    {
        $user = User::find($userId);
        foreach ($details as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        return $user;
    }

    public function getUser($userId)
    {
        return User::find($userId);
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function deleteUser($userId)
    {
        return User::find($userId)->delete();
    }

    public function createRole($data, $permissions)
    {
        $role = Role::create($data);
        $role->syncPermissions($permissions);
        return $role;
    }

    public function updateRole($roleId, $data, $permissions)
    {
        $role = Role::find($roleId);
        $role->name = $data['name'];
        $role->status = $data['status'];
        $role->save();
        $role->syncPermissions($permissions);
        return $role;
    }

    public function getRole($roleId)
    {
        return Role::find($roleId);
    }

    public function getAllRoles($data)
    {
        // return Role::all();
        return Role::select(app(Role::class)->getTable() . '.*')
            ->where(function (Builder $query) use ($data) {
                if ($data['status'] != "") {
                    $query->where('status', '=', $data['status']);
                }
            });
    }

    public function getAllRole()
    {
        return Role::all();
    }

    public function deleteRole($roleId)
    {
        return Role::find($roleId)->delete();
    }

    public function userStatusUpdate($userId)
    {
        $user = User::find($userId);
        $user->status = $user->status ? 0 : 1;
        $user->save();
        return $user;
    }

    public function roleStatusUpdate($roleId)
    {
        $role = Role::find($roleId);
        $role->status = $role->status ? 0 : 1;
        $role->save();
        return $role;
    }

    public function roleUsers($id)
    {
        $role = Role::find($id);
        return $role->users;
    }

    public function getPermissionTemplate()
    {
        return [
            // ["label" => "Crud", "key" => "crud"],
            ["label" => "Banner", "key" => "banner"],
            ["label" => "Cms", "key" => "cms"],
            ["label" => "Country", "key" => "country"],
            ["label" => "Enquiry", "key" => "enquiry"],
            ["label" => "Customer", "key" => "customer"],
            ["label" => "Users", "key" => "user"],
            ["label" => "Roles and permission", "key" => "role"],
            ["label" => "Settings", "key" => "settings"],
            ["label" => "Categories", "key" => "category"],
            ["label" => "Services", "key" => "service"],
            ["label" => "Packages", "key" => "package"],
        ];
    }

    public function getAllUsersexcepetSuperAdmin($data)
    {
        $query = User::where('email', '!=', 'web@gligx.com')->select(app(User::class)->getTable() . '.*');
        if ($data['status'] != "") {
            $query->where('status', $data['status']);
        }
        return $query;
    }

    public function deleteTokens(array $tokens = [])
    {
        return User::whereIn('fcm_token', $tokens)->update(['fcm_token' => '']);
    }
}