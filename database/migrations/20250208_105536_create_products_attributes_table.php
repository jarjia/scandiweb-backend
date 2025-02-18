<?php

return "CREATE TABLE IF NOT EXISTS product_attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(255),
    name VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    items JSON,
    __typename VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);";
