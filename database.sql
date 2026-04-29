CREATE DATABASE copa_db;
USE copa_db;

CREATE TABLE selecoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    grupo CHAR(1) NOT NULL,
    titulos INT DEFAULT 0,
    bandeira TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jogadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    posicao VARCHAR(50) NOT NULL,
    numero INT NOT NULL,
    selecao_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT jogadores_ibfk_1
        FOREIGN KEY (selecao_id)
        REFERENCES selecoes(id)
        ON DELETE CASCADE
);