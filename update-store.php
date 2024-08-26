<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $jsonData = file_get_contents('php://input');
    
    // Debug: Check if data is being received
    if ($jsonData === false || empty($jsonData)) {
        echo json_encode(["status" => "error", "message" => "No data received or failed to read input data"]);
        exit;
    }

    // Decode the JSON data
    $products = json_decode($jsonData, true);
    
    // Debug: Check if JSON was decoded properly
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["status" => "error", "message" => "JSON decode error: " . json_last_error_msg()]);
        exit;
    }

    // Encode the data back into JSON format with pretty print
    $newJsonData = json_encode($products, JSON_PRETTY_PRINT);
    
    // Debug: Check if JSON was encoded properly
    if ($newJsonData === false) {
        echo json_encode(["status" => "error", "message" => "Failed to encode JSON data"]);
        exit;
    }

    // Write the JSON data to the store.json file
    if (file_put_contents('store.json', $newJsonData)) {
        echo json_encode(["status" => "success", "data" => $products]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to write to store.json"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>