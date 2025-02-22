<?php

namespace App\Models;

use App\GraphQL\Types\OrderType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class Order extends Base
{
    protected static string $table = 'orders';

    public static function orderMutation(): array
    {
        return [
            'type' => new ObjectType([
                'name' => 'OrderMutationResponse',
                'fields' => [
                    'success' => ['type' => Type::boolean()]
                ],
            ]),
            'args' => [
                'data' => Type::listOf(OrderType::OrderInput())
            ],
            'resolve' => function ($root, array $args) {
                $order = Order::createAll($args['data']);

                return [
                    'success' => (bool) $order,
                ];
            }
        ];
    }
}
