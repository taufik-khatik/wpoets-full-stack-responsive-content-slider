<?php
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "wpoets_test");

$conn = new mysqli(HOST, USER, PASS, DB);

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

// Create the slides table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS slides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tab_name VARCHAR(20) NOT NULL,
    tab_icon VARCHAR(255),
    tag VARCHAR(255),
    title VARCHAR(255),
    link TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

return $conn;