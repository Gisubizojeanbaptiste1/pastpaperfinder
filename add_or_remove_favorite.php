<?php
session_start();

include "connection.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "error: user not logged in";
    exit;
}

$action = $_GET['action']; 
$paperId = $_GET['paper_id'];
$userId = $_SESSION['id']; 


if ($action == 'add') {
   
    $query = "INSERT INTO favourite (user_id, paper_id, added_at) VALUES ($userId, $paperId, NOW())";
    if (mysqli_query($conn, $query)) {
        echo "added successfully";
    } else {
        echo "error please ty again later";
    }
} elseif ($action == 'remove') {
    // Remove from the favourite table
    $query = "DELETE FROM favourite WHERE user_id = $userId AND paper_id = $paperId";
    if (mysqli_query($conn, $query)) {
        echo "removed";
    } else {
        echo "error";
    }
}

?>