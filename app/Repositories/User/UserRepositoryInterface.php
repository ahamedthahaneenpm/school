<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Role;

interface UserRepositoryInterface
{

    /**
     * Create user.
     *
     * @param Array $details
     * @return User $user|false
     */
    public function createUser($details);

    /**
     * Update user.
     *
     * @param User $user, Array $details
     * @return User $user|false
     */
    public function updateUser(User $user, $details);

    /**
     * Retrive User
     * @param String $userId
     * @return User $user;
     */
    public function getUser($userId);

    /**
     * Retrive All Users
     * @return Colection $user;
     */
    public function getAllUsers();

    /**
     * Delete User
     * @param String $userId
     * @return User $user;
     */
    public function deleteUser($userId);

    /**
     * Create Role.
     *
     * @param Array $data, 
     * @param Array $permission,
     * @return Role $role|false
     */
    public function createRole($data, $permission);

    /**
     * Update Role.
     *
     * @param int $roleId, 
     * @param Array $data, 
     * @param Array $permission,
     * @return Role $role|false
     */
    public function updateRole($roleId, $data, $permissions);

    /**
     * change role status accordingly
     *
     * @param int $roleId
     * @return void
     */
    public function roleStatusUpdate($roleId);

    /**
     * change user status accordingly
     *
     * @param int $userId
     * @return void
     */
    public function userStatusUpdate($userId);

    /**
     * Retrive Role
     * @param String $roleId
     * @return Role $role;
     */
    public function getRole($roleId);

    /**
     * Retrive All Role
     * @return Colection $role;
     */
    public function getAllRoles($data);
    /**
     * Retrive All Role
     * @return Colection $role;
     */
    public function getAllRole();

    /**
     * Delete Role
     * @param String $roleId
     * @return Role $role;
     */
    public function deleteRole($roleId);

    /**
     * All users of Role
     * @param int|String $roleId
     * @return Collection $roles;
     */
    public function roleUsers($id);

    /**
     * Retrive All Permission Template
     */
    public function getPermissionTemplate();

    public function getAllUsersexcepetSuperAdmin($data);
}