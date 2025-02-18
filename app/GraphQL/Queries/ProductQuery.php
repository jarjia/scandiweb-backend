<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Types\ProductType;
use App\Models\Product;
use App\Services\ProductService;
use GraphQL\Type\Definition\Type;

class ProductQuery
{
    public static function Products(): array
    {
        return [
            'args' => [
                'category' => ['type' => Type::string()]
            ],
            'type' => Type::listOf(ProductType::handle()),
            'resolve' => function ($root, $args) {
                $productService = new ProductService();
                return $productService->getProductsByCategory($args['category']);
            }
        ];
    }

    public static function Product(): array
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
