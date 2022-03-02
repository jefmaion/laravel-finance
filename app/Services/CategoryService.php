<?php

namespace App\Services;

use App\Repository\CategoryRepository;

class CategoryService {

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategory(int $id) {
        return $this->categoryRepository->getById($id);
    }

    public function addCategory(array $request) {
        return $this->categoryRepository->create($request);
    }

    public function updateCategory(array $request, int $id) {
        return $this->categoryRepository->update($request, $id);
    }

    public function deleteCategory(int $id) {
        return $this->categoryRepository->destroy($id);
    }

    public function listCategories() {
        return $this->categoryRepository->all();
    }

    public function listWithCategories() {
        return $this->categoryRepository->listWithCategories();
    }

}