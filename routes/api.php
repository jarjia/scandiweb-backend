<?php

use App\Controllers\GraphQL;
use App\Core\Router;

Router::get('/graphql', [GraphQL::class, 'handle']);
