<?php

namespace App\Interfaces;


interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function deleteCategory($category);
    public function createCategory(array $categoryDetails);
    public function updateCategory($category, array $newDetails);
}
