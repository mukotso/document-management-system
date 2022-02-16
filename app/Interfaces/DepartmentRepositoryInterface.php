<?php

namespace App\Interfaces;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;

interface DepartmentRepositoryInterface
{
    public function getAllDepartments();
    public function deleteDepartment($departmentId);
    public function createDepartment(array $departmentDetails);
    public function updateDepartment(DepartmentRequest $request, Department $department);
}

