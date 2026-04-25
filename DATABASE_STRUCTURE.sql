-- Cyber Cafe Management System - Database Structure
-- This is auto-created by config.php, but here's the structure:

CREATE DATABASE IF NOT EXISTS cyber_cafe_db;

USE cyber_cafe_db;

-- Persons/Customers Table
CREATE TABLE IF NOT EXISTS persons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    address VARCHAR(255),
    joining_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Computers Table
CREATE TABLE IF NOT EXISTS computers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    computer_name VARCHAR(50) NOT NULL UNIQUE,
    status ENUM('available', 'occupied', 'maintenance') DEFAULT 'available',
    hourly_rate DECIMAL(5,2) DEFAULT 50.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bookings Table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    person_id INT NOT NULL,
    computer_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME,
    hours_used DECIMAL(5,2),
    amount_paid DECIMAL(8,2),
    status ENUM('active', 'completed') DEFAULT 'active',
    FOREIGN KEY (person_id) REFERENCES persons(id),
    FOREIGN KEY (computer_id) REFERENCES computers(id)
);

-- Sample Data (Optional)
INSERT INTO computers (computer_name, status, hourly_rate) VALUES
('PC-01', 'available', 50.00),
('PC-02', 'available', 50.00),
('PC-03', 'available', 60.00),
('PC-04', 'available', 60.00),
('PC-05', 'available', 50.00);
