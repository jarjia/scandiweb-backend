<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Types\CategoryType;
use App\Models\Category;
use GraphQL\Type\Definition\Type;

class CategoryQuery
{
    public static function Categories(): array
    {
        return [
            'type' => Type::listOf(CategoryType::handle()),
            'resolve' => fn() => Category::get()
        ];
    }
}
