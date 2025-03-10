<?php
include 'connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Update the view count for the past paper
    $sql = "UPDATE past_papers SET views_count = views_count + 1 WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "View count updated!";
    } else {
        echo "Error updating view count: " . mysqli_error($conn);
    }
}
?>