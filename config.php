<?php
// Database Configuration
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$database = "cyber_cafe_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS cyber_cafe_db";
if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully";
} else {
    // echo "Error creating database: " . $conn->error;
}

// Select database
$conn->select_db($database);

// Create tables if not exists
$sql = "CREATE TABLE IF NOT EXISTS persons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    address VARCHAR(255),
    joining_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS computers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    computer_name VARCHAR(50) NOT NULL UNIQUE,
    status ENUM('available', 'occupied', 'maintenance') DEFAULT 'available',
    hourly_rate DECIMAL(5,2) DEFAULT 50.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS bookings (
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
)";
$conn->query($sql);

?>
