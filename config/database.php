<?php

return [
    'driver' => getenv('DB_DRIVER'),
    'host' => getenv('DB_HOST'),
    'db' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD')
];
