<?php
// Include the database connection file
include 'connection.php';

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    $filePath = $_GET['id'];  // Get the file path from the query string

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set the headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Pragma: no-cache');
        header('Expires: 0');
        flush(); // Flush system output buffer

        // Read the file and output it to the browser
        readfile($filePath);
        exit;
    } else {
        // If the file doesn't exist, show an error message
        echo "Error: File not found.";
    }
} else {
    // If 'id' is not provided, redirect or show an error
    echo "Error: Invalid request.";
}
?>
