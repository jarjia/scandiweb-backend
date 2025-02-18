<?php

namespace Database\Seed;

use App\Core\Database;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Exception;

class Seeder
{
    public static function handle(string $api_url): void
    {
        $response = file_get_contents($api_url);

        $data = json_decode($response, true)['data'];

        $conn = Database::getConnection();

        $conn->beginTransaction();

        try {
            Category::createAll($data['categories']);

            $products = array_map(function ($product) {
                return [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'inStock' => strlen($product['inStock']) === 0 ? 0 : $product['inStock'],
                    'category_name' => $product['category'],
                    'gallery' => json_encode($product['gallery']),
                    'price' => json_encode($product['prices'][0]),
                    'brand' => $product['brand']
                ];
            }, $data['products']);

            Product::createAll($products);

            $attributes = array_reduce($data['products'], function ($carry, $product) {
                foreach ($product['attributes'] as $attr) {
                    $carry[] = [
                        'product_id' => $product['id'],
                        'name' => $attr['name'],
                        'type' => $attr['type'],
                        'items' => json_encode($attr['items'])
                    ];
                }
                return $carry;
            }, []);

            Attribute::createAll($attributes);

            $conn->commit();
        } catch (Exception $err) {
            $conn->rollBack();
            echo $err->getMessage();
        }
    }
}
