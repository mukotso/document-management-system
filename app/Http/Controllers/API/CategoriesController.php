<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    //    constructor dependency injection
    public $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }


    public function index()
    {
        $categories = $this->categoryRepo->getAllCategories();
        return response()->json($categories, 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepo->createCategory($request->all());
        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category = $this->categoryRepo->updateCategory($category, $request->all());
        return response()->json($category, 201);
    }

    public function destroy(Category $category)
    {
        $this->categoryRepo->deleteCategory($category->id);
        return response()->json(200);
    }
}
