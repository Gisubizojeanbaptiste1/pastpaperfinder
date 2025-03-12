<?php
// session_start();
// include 'connection.php';

// if (!isset($_SESSION['user_id'])) {
//     die("User not logged in!");
// }
include('connection.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('location:loginteacher.php');
    exit();
}


if (isset($_GET['success'])) {
  echo "<p style='color:green;'>{$_GET['success']}</p>";
}
if (isset($_GET['error'])) {
  echo "<p style='color:red;'>{$_GET['error']}</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard | Past Paper Finder</title>
  <link rel="stylesheet" href="StudentRequest.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="teacher-dashboard">
  <aside class="sidebar">
      <h2>Past Paper Finder</h2>
      <nav>
        <a href="teacherDashboard.php" class="active"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="uploadsteacher.php"><i class="fa fa-upload"></i> Upload Past Papers</a>
        <a href="managepastpaperteacher.php"><i class="fa fa-folder"></i> Manage Papers</a>
        <a href="analyticspageteacher.php"><i class="fa fa-chart-line"></i> Analytics</a>
        <!-- <a href="addNewTeacher.php" onclick=addTeacher()><i class="fa fa-user"></i> Add New Teacher</a> -->
        <a onclick="addTeacher()" style="cursor:pointer;">
            <i class="fa fa-user"></i> Add New Teacher
        </a>

        <a href="StudentRequest.php"><i class="fa fa-comments"></i> Student Requests</a>
        <a href="teacherlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main>
      <!-- Upload Past Papers -->
       <h2 style="font-size:1.2rem;">Student's Request for past papers</h2>
      <section id="requests" class="request">
    <table id="papersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Other Subject</th>
                <th>Grade</th>
                <th>Date</th>
                <th>Category</th>
                <th>Other Category</th>
                <th>Class Name</th>
                <th>Details</th>
                <th>Submitted At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'connection.php';

            $sql = "
                SELECT 
                    r.id, 
                    r.subject, 
                    r.otherSubject, 
                    r.grade, 
                    r.date, 
                    r.category, 
                    r.otherCategory, 
                    r.class_id, 
                    r.details, 
                    r.created_at, 
                    r.solved, 
                    c.classname
                FROM requests r
                LEFT JOIN class c ON r.class_id = c.id
            ";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['subject']}</td>
                            <td>{$row['otherSubject']}</td>
                            <td>{$row['grade']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['category']}</td>
                            <td>{$row['otherCategory']}</td>
                            <td>{$row['classname']}</td>
                            <td>{$row['details']}</td>
                            <td>{$row['created_at']}</td>
                            <td class='" . ($row['solved'] == 'Yes' ? 'status-solved' : 'status-pending') . "'>
                                " . ($row['solved'] == 'Yes' ? '✅ Solved' : '❌ Pending') . "
                            </td>
                            <td>";

                    if ($row['solved'] == 'No') {
                        echo "<a href='mark_solved.php?id={$row['id']}'>Solved</a>";
                    } else {
                        echo "Already Solved";
                    }

                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No request has been found. Please refresh or try again.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>


    </main>
  </div>

</body>
</html>
