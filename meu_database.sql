CREATE DATABASE meu_banco;
USE meu_banco;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    idade INT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);