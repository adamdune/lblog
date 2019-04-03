<?php
$host = "localhost";
$username = "id9138251_admin";
$password = "password";
$db_name = "id9138251_temp";

// Create connection
$conn = new mysqli($host, $username, $password, "my_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>