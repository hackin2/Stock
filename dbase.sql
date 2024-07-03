CREATE DATABASE exam;

USE exam;

CREATE TABLE Mark (
    roll INT PRIMARY KEY,
    name VARCHAR(100),
    phy INT,
    chem INT,
    math INT
);

CREATE TABLE User (
    userid VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255)
);
