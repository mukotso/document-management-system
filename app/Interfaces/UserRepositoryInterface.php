<?php

namespace App\Interfaces;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function deleteUser($userId);
    public function getUserPermissions($roleId);
    public function createUser(array $userDetails);
    public function updateUser($user, $newDetails);
}
