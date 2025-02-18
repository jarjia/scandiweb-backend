<?php

return "CREATE TABLE IF NOT EXISTS products (
    id VARCHAR(255) PRIMARY KEY,
    category_name VARCHAR(255),
    name VARCHAR(255) NOT NULL,
    inStock TINYINT(1),
    description TEXT,
    gallery JSON,
    price JSON,
    brand VARCHAR(255),
    __typename VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_name) REFERENCES categories(name) ON DELETE CASCADE
);";
