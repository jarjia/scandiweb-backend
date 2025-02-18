<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\OrderType;
use App\Models\Order;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class OrderMutation
{
    public static function Order(): array
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
            'resolve' => function ($rootValue, array $args) {
                $order = Order::createAll($args['data']);

                return [
                    'success' => (bool) $order,
                ];
            }
        ];
    }
}
