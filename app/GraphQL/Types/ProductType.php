<?php

namespace App\GraphQL\Types;

use App\GraphQL\TypeRegistry;
use App\Models\Attribute;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType
{
    public static function handle(bool $isProduct = false)
    {
        return TypeRegistry::get(
            "Product-$isProduct",
            fn() => new ObjectType([
                'name' => "Product-$isProduct",
                'fields' => [
                    'id' => ['type' => Type::string()],
                    'category_name' => ['type' => Type::string()],
                    'name' => ['type' => Type::string()],
                    'inStock' => ['type' => Type::boolean()],
                    'description' => ['type' => Type::string()],
                    'gallery' => [
                        'type' => $isProduct ? Type::listOf(Type::string()) : Type::string(),
                        'resolve' => function ($root) use ($isProduct) {
                            $gallery = json_decode($root['gallery'], true);
                            return $isProduct ? $gallery : ($gallery[0] ?? null);
                        }
                    ],
                    'price' => [
                        'type' => TypeRegistry::get('Price', fn() => self::Price()),
                        'resolve' => fn($root) => json_decode($root['price'], true),
                    ],
                    'attributes' => [
                        'type' => Type::listOf(TypeRegistry::get('Attribute', fn() => AttributeType::handle())),
                        'resolve' => fn($root) => Attribute::where('product_id', $root['id']),
                    ],
                    'brand' => ['type' => Type::string()],
                ],
            ])
        );
    }

    static public function Price()
    {
        return TypeRegistry::get("Price", fn() => new ObjectType([
            'name' => 'Price',
            'fields' => [
                'amount' => ['type' => Type::string()],
                'currency' => [
                    'type' => self::Currency()
                ],
            ]
        ]));
    }

    static public function Currency()
    {
        return TypeRegistry::get("Currency", fn() => new ObjectType([
            'name' => 'Currency',
            'fields' => [
                'symbol' => ['type' => Type::string()],
                'label' => ['type' => Type::string()],
            ]
        ]));
    }
}
