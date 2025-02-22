<?php

namespace App\Models;

use App\GraphQL\Types\ProductsType;
use App\GraphQL\Types\ProductType;
use GraphQL\Type\Definition\Type;

class Product extends Base
{
    protected static string $table = 'products';

    public static function get(string $category = 'all'): array
    {
        return $category === 'all'
            ? parent::get()
            : self::where('category_name', $category);
    }

    public static function productsQuery(): array
    {
        return [
            'args' => [
                'category' => ['type' => Type::string()]
            ],
            'type' => Type::listOf(ProductsType::handle()),
            'resolve' => fn($root, $args) => Product::get($args['category']),
        ];
    }

    public static function productQuery(): array
    {
        return [
            'args' => [
                'product_id' => ['type' => Type::string()],
            ],
            'type' => ProductType::handle(true),
            'resolve' => fn($root, $args) => Product::firstWhere('id', $args['product_id']),
        ];
    }
}
