<?php

namespace App\GraphQL\Types;

use App\Helpers\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType
{
    public static function handle(): ObjectType
    {
        return TypeRegistry::get('Category', fn() => new ObjectType([
            'name' => 'Category',
            'fields' => [
                'id' => ['type' => Type::int()],
                'name' => ['type' => Type::string()]
            ]
        ]));
    }
}
