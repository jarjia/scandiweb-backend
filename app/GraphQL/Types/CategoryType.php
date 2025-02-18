<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType
{
    public static function handle(): ObjectType
    {
        return new ObjectType([
            'name' => 'Category',
            'fields' => [
                'id' => ['type' => Type::int()],
                'name' => ['type' => Type::string()]
            ]
        ]);
    }
}
