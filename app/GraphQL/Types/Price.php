<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class Price
{
    static public function handle()
    {
        return new ObjectType([
            'name' => 'Price',
            'fields' => [
                'amount' => ['type' => Type::string()],
                'currency' => [
                    'type' => self::Currency()
                ],
            ]
        ]);
    }

    static public function Currency()
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
