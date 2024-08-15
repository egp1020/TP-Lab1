CREATE DATABASE olimpicos_db;

USE olimpicos_db;

CREATE TABLE medallas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pais VARCHAR(100) NOT NULL,
    oro INT DEFAULT 0,
    plata INT DEFAULT 0,
    bronce INT DEFAULT 0,
    total INT AS (oro + plata + bronce)
);
