CREATE DATABASE crudphp;

USE crudphp;

CREATE TABLE pessoas (
     id INT AUTO_INCREMENT PRIMARY KEY,
     no_pessoa VARCHAR(150) NOT NULL,
     nu_telefone VARCHAR(15) NOT NULL,
     co_cep CHAR(10),
     sg_uf  CHAR(2),
     no_municipio VARCHAR(50),
     no_bairro VARCHAR(50),
     no_logradouro VARCHAR(100),
     nu_logradouro VARCHAR(10),
     de_complemento VARCHAR(100),
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
