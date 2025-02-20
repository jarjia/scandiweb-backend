<?php

namespace App\Models;

class Product extends Base
{
    protected static string $table = 'products';

    public static function get(string $category = 'all'): array
    {
        return $category === 'all'
            ? parent::get()
            : self::where('category_name', $category);
    }
}
