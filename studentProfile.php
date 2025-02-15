<?php
include('connection.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('location:loginstudent.php');
    exit();
}
$userId = $_SESSION['id'];


$sql = "
    SELECT users.*, class.classname
    FROM users
    LEFT JOIN class ON users.class_id = class.id
    WHERE users.id = $userId
";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard | Past Paper Finder</title>
    <link rel="stylesheet" href="studentProfile.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
  </head>
  <body>
    <div class="dashboard">
      <!-- Sidebar -->
      <aside class="sidebar">
        <h2>Past Paper Finder</h2>
        <nav>
          <a href="studentDashboard.php"><i class="fa fa-home"></i> Dashboard</a>
          <a href="studentfavorite.php"><i class="fa fa-heart"></i> Favorites</a>
          <a href="studentRequestpastpaper.php"><i class="fa fa-envelope"></i> Request Papers</a>
          <a href="studentlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
          <a href="studentsettings.php"><i class="fa fa-cogs" ></i> Settings</a>
          <a href="studentProfile.php" class="active"><i class="fa fa-user" ></i> Student(s) profile</a>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
        <!-- Search Bar -->
        <!-- <section class="search-bar">
          
          <h2>Search for Past Papers</h2>    
          <input type="text" id="searchInput" placeholder="Type here to search instantly" onkeyup="searchTable()" 
        style="width:19rem;height:2rem;padding-left:1rem;" class="searching_colors">
        </section> -->

        <!-- Papers Section -->
        <section class="papers">
          <div class="container">
            <h1>Student Profile</h1>
            <?php if ($student): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <td><?php echo $student['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $student['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $student['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td><?php echo $student['classname']; ?></td>
                    </tr>
                    
                </table>
            <?php else: ?>
                <p>Student not found.</p>
            <?php endif; ?>
        </div>
        </section>
      </main>
    </div>


  </body>
</html>
