<?php

namespace App\GraphQL\Types;

use App\Helpers\TypeRegistry;
use App\Models\Attribute;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductsType
{
    public static function handle()
    {
        return new ObjectType([
            'name' => "Products",
            'fields' => [
                'id' => ['type' => Type::string()],
                'category_name' => ['type' => Type::string()],
                'name' => ['type' => Type::string()],
                'inStock' => ['type' => Type::boolean()],
                'description' => ['type' => Type::string()],
                'gallery' => [
                    'type' => Type::listOf(Type::string()),
                    'resolve' => fn($root) => json_decode($root['gallery'], true)
                ],
                'price' => [
                    'type' => Price::handle(),
                    'resolve' => fn($root) => json_decode($root['price'], true),
                ],
                'attributes' => [
                    'type' => Type::listOf(AttributeType::handle()),
                    'resolve' => fn($root) => Attribute::where('product_id', $root['id']),
                ],
                'brand' => ['type' => Type::string()],
            ],
        ]);
    }
}
