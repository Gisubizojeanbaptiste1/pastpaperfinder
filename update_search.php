<?php 
// update_search.php
include 'connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Update the search count for the past paper
    $sql = "UPDATE past_papers SET searches_count = searches_count + 1 WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Search count updated!";
    } else {
        echo "Error updating search count: " . mysqli_error($conn);
    }
}
?>