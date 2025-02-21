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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard | Past Paper Finder</title>
  <link rel="stylesheet" href="communicate.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="teacher-dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Past Paper Finder</h2>
      <nav>
        <a href="teacherDashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="uploadsteacher.php"><i class="fa fa-upload"></i> Upload Past Papers</a>
        <a href="managepastpaperteacher.php"><i class="fa fa-folder"></i> Manage Papers</a>
        <a href="analyticspageteacher.php"><i class="fa fa-chart-line"></i> Analytics</a>
        <a href="StudentRequest.php" class="active"><i class="fa fa-comments"></i> Student Requests</a>
        <a href="teacherlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main>
      <!-- Upload Past Papers -->
      <section id="requests" class="request">
      <table id="papersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>otherSubject</th>
            <th>grade</th>
            <th>date</th>
            <th>category</th>
            <th>otherCategory</th>
            <th>className</th>
            <th>details</th>
            <th>Submited_at</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
            include 'connection.php';
            //this query is used to join two tables requests and class to get the class name
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
                            <td>{$row['classname']}</td> <!-- This is the class name fetched from the class table -->
                            <td>{$row['details']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a href='#'>Solved</a> |
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No request has been found. Please refresh or try again.</td></tr>";
            }
            ?>
        </tbody>
      </table>

      </section>
    </main>
  </div>

</body>
</html>
