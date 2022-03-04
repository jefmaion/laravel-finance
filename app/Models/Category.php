<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    public function categories()
    {
        return $this->hasMany(Category::class)->orderBy('name');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class)->with('categories')->orderBy('name');
    }
}
