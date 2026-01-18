CREATE DATABASE vuln_db;
USE vuln_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100),
    username VARCHAR(50),
    password VARCHAR(50),
    role VARCHAR(20),
    balance INT
);

INSERT INTO users (username, password, role, balance) VALUES
('agus', '12345', 'user', 100000),
('admin', 'admin123', 'admin', 999999);
