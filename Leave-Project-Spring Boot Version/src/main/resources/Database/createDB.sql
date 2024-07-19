DROP DATABASE IF EXISTS leavesystem;

CREATE DATABASE leavesystem;

-- Use the database
USE leavesystem;

-- Create the users table
CREATE TABLE users (
                       id BIGINT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       password VARCHAR(100) NOT NULL,
                       role VARCHAR(20) NOT NULL
);

-- Create the leave_requests table
CREATE TABLE leave_requests (
                                id BIGINT AUTO_INCREMENT PRIMARY KEY,
                                start_date DATE,
                                end_date DATE,
                                status VARCHAR(255),
                                user_id BIGINT,
                                CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id)
);