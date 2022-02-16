<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\DepartmentRequest;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
//    constructor dependency injection
    public $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }


    public function index()
    {
        $departments = $this->departmentRepository->getAllDepartments();
        return response()->json($departments, 200);
    }

    public function store(DepartmentRequest $request)
    {
        $department = $this->departmentRepository->createDepartment($request->all());
        return response()->json($department, 201);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department = $this->departmentRepository->updateDepartment($department, $request->all());
        return response()->json($department, 201);
    }

    public function destroy(Department $department)
    {
        $this->departmentRepository->deleteDepartment($department->id);
        return response()->json(200);
    }
}
