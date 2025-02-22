<?php

namespace App\GraphQL\Types;

use App\Helpers\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class Price
{
    public static function handle(): ObjectType
    {
        return TypeRegistry::get('Price', fn() => new ObjectType([
            'name' => 'Price',
            'fields' => [
                'amount' => ['type' => Type::string()],
                'currency' => ['type' => self::Currency()],
            ]
        ]));
    }

    public static function Currency()
    {
        return new ObjectType([
            'name' => 'Currency',
            'fields' => [
                'symbol' => ['type' => Type::string()],
                'label' => ['type' => Type::string()],
            ]
        ]);
    }
}
