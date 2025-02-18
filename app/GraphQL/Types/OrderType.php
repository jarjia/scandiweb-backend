<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class OrderType
{
    private static ?InputObjectType $orderInstance = null;

    public static function OrderInput(): InputObjectType
    {
        if (self::$orderInstance === null) {
            self::$orderInstance = new InputObjectType([
                'name' => 'OrderInput',
                'fields' => [
                    'product_id' => ['type' => Type::string()],
                    'quantity' => ['type' => Type::int()],
                    'attributes' => ['type' => Type::string()]
                ]
            ]);
        }
        return self::$orderInstance;
    }
}
