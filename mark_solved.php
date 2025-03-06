<?php
// mark_solved.php
include 'connection.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Update the request to mark it as solved
    $updateQuery = "UPDATE requests SET solved = 'Yes' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: StudentRequest.php?success=Request marked as solved");
        exit();
    } else {
        header("Location: StudentRequest.php?error=Failed to update");
        exit();
    }
}
?>
