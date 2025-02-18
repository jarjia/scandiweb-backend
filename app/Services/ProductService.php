<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Get products based on the category.
     * 
     * @param string $category
     * @return array
     */
    public function getProductsByCategory(string $category): array
    {
        if ($category === 'all') {
            return Product::get();
        }

        return Product::where('category_name', $category);
    }
}
