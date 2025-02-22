<?php

namespace App\Models;

use App\GraphQL\Types\CategoryType;
use GraphQL\Type\Definition\Type;

class Category extends Base
{
    protected static string $table = 'categories';

    public static function categoriesQuery(): array
    {
        return [
            'type' => Type::listOf(CategoryType::handle()),
            'resolve' => fn() => self::get()
        ];
    }
}
