<?php
include 'connection.php';

// Retrieve filter parameters from the AJAX request
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';
$classSelection = isset($_GET['class']) ? $_GET['class'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Build the SQL query based on the filters
$sql = "SELECT * FROM past_papers WHERE 1=1";

// Add conditions for filters if they are set
if ($subject != '') {
    $sql .= " AND subject = '$subject'";
}
if ($classSelection != '') {
    $sql .= " AND class_selection = '$classSelection'";
}
if ($category != '') {
    $sql .= " AND category = '$category'";
}
if ($date != '') {
    $sql .= " AND year = '$date'";
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if results are found
if (mysqli_num_rows($result) > 0) {
    // Loop through the results and display them
    while ($row = mysqli_fetch_assoc($result)) {
        $coverPath = str_replace('C:/xampp/htdocs', '', $row['cover_page']);
        $filePath = str_replace('C:/xampp/htdocs', '', $row['file_path']);
        $answerPath = str_replace('C:/xampp/htdocs', '', $row['answers']);

        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['Term']}</td>
                <td>{$row['weeks']}</td>
                <td>{$row['subject']}</td>
                <td>{$row['class_selection']}</td>
                <td>{$row['year']}</td>
                <td>{$row['category']}</td>
                <td><img src='{$coverPath}' alt='Cover' width='50'></td>
                <td>{$row['uploaded_by']}</td>
                <td><a href='{$filePath}' target='_blank'>Qns</a></td>
                <td><a href='{$answerPath}' target='_blank'>Ans</a></td>
                <td><a href='teacherdownload.php?id={$row['file_path']}'>Download</a></td>
                <td>
                    <a href='#' class='edit-btn' data-id='{$row['id']}' data-subject='{$row['subject']}' data-class='{$row['class_selection']}' data-year='{$row['year']}' data-category='{$row['category']}' data-uploaded_by='{$row['uploaded_by']}' data-cover_path='{$coverPath}' data-file_path='{$filePath}'>Edit</a> |
                    <a href='delete_paper.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
    }
} else {
    // If no results found, return a message
    echo "<tr><td colspan='13'>No past papers found.</td></tr>";
}
?>
