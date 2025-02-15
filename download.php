<?php
// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    $file_id = $_GET['id'];

    // Include your database connection
    include 'connection.php';

    // Fetch the file path and other details from the database
    $query = "SELECT file_path, subject FROM past_papers WHERE id = '$file_id'";
    $result = mysqli_query($conn, $query);

    // Check if the paper exists
    if (mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $file_path = $file['file_path'];
        $subject = $file['subject'];

        // Update the download count for this paper
        $update_query = "UPDATE past_papers SET download_count = download_count + 1 WHERE id = '$file_id'";
        mysqli_query($conn, $update_query);

        // Check if the file exists
        if (file_exists($file_path)) {
            // Set headers to force download
            header('Content-Type: application/pdf');  // Adjust MIME type based on file type
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Content-Length: ' . filesize($file_path));

            // Read the file and output to the browser
            readfile($file_path);
            exit();
        } else {
            echo "File not found.";
        }
    } else {
        echo "File not found in the database.";
    }
} else {
    echo "No file specified.";
}
?>
