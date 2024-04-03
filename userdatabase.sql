CREATE DATABASE userdatabase;
USE userdatabase;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    student_id VARCHAR(20) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);
INSERT INTO users (first_name, last_name, student_id, phone_number, email, password)
VALUES ('John', 'Doe', '123456789', '555-123-4567', 'john@example.com', 'hashed_password');
