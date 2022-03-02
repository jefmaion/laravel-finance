<?php

namespace App\Repository;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function all() : Collection 
    {
        return Category::with('subcategory')->whereNull('category_id')->orderBy('name')->get();
    }

    public function listWithCategories() {
        return Category::whereNull('category_id')->with('subcategory')->get();
    }

}