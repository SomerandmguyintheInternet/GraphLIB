<?php
// api-endpoint.php

// Set headers for JSON output and CORS policy
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin (for development)
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle OPTIONS request (pre-flight for CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Database Configuration (REPLACE WITH YOUR ACTUAL DATABASE CREDENTIALS)
$servername = "localhost"; // e.g., 'localhost' or your MariaDB host
$username = "your_db_username"; // e.g., 'root'
$password = "your_db_password"; // e.g., 'password'
$dbname = "your_database_name"; // e.g., 'graph_data'

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error (do not expose sensitive details in production)
    error_log("Connection failed: " . $conn->connect_error);
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Database connection failed.']);
    exit();
}

// Get requested data type from query parameter
$dataType = isset($_GET['data_type']) ? $_GET['data_type'] : 'products'; // Default to 'products'

$data = [];
$sql = "";

switch ($dataType) {
    case 'products':
        // SQL query to fetch product/sales data
        // Ensure your table and column names match your MariaDB schema
        $sql = "SELECT id, transaction_date, product_category, amount, quantity, customer_rating, product_price FROM sales_transactions ORDER BY transaction_date ASC";
        break;
    case 'financial':
        // SQL query to fetch financial data (e.g., stock prices)
        // This assumes a 'financial_data' table with 'date', 'open', 'high', 'low', 'close' columns
        $sql = "SELECT date, open_price as `open`, high_price as high, low_price as low, close_price as `close` FROM financial_data ORDER BY date ASC";
        break;
    default:
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid data_type specified.']);
        exit();
}

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Convert numeric strings to actual numbers if necessary (PHP's fetch_assoc often returns strings)
            foreach ($row as $key => $value) {
                if (is_numeric($value) && !is_float($value)) { // Check if it's a numeric string that's not already a float
                    $row[$key] = (float) $value; // Convert to float for Chart.js
                }
            }
            $data[] = $row;
        }
    }
    echo json_encode($data);
} else {
    // Log the error
    error_log("SQL Error: " . $conn->error);
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Failed to retrieve data from database.']);
}

// Close database connection
$conn->close();
?>
