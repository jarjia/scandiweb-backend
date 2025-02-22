<?php

namespace App\GraphQL\Types;

use App\Helpers\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class AttributeType
{
    public static function handle(): ObjectType
    {
        return TypeRegistry::get('Attribute', fn() => new ObjectType([
            'name' => 'Attribute',
            'fields' => [
                'id' => ['type' => Type::int()],
                'type' => ['type' => Type::string()],
                'name' => ['type' => Type::string()],
                'items' => [
                    'type' => Type::listOf(self::AttributeItem()),
                    'resolve' => fn($root) => json_decode($root['items'])
                ]
            ]
        ]));
    }

    public static function AttributeItem(): ObjectType
    {
        return new ObjectType([
            'name' => 'AttributeItem',
            'fields' => [
                'id' => ['type' => Type::string()],
                'displayValue' => ['type' => Type::string()],
                'value' => ['type' => Type::string()],
            ]
        ]);
    }
}
