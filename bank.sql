CREATE DATABASE atvpw_pdo;
USE atvpw_pdo;

CREATE TABLE users(
    cd INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200),
    email VARCHAR(200),
    pass CHAR(200)
);