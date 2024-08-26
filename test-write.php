<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$testData = [
    ["name" => "Test Product", "price" => 999],
    ["name" => "Another Product", "price" => 1999]
];

$testJson = json_encode($testData, JSON_PRETTY_PRINT);

if (file_put_contents('test-store.json', $testJson)) {
    echo "File written successfully!";
} else {
    echo "Failed to write file.";
}
?>
