<?php
include('connection.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('location:loginstudent.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard | Past Paper Finder</title>
    <link rel="stylesheet" href="studentsettings.css" />
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
          <a href="studentsettings.php" class="active"><i class="fa fa-cogs" ></i> Settings</a>
          <a href="studentProfile.php" ><i class="fa fa-user" ></i> Student(s) profile</a>
        </nav>
      </aside>

   
      <main>
    
        <!-- Papers Section -->
        <section class="papers">
          <h2>Customise your Settings</h2>
          <div class="form-container">
                <h2>Account Settings</h2>

                <!-- Change Username -->
                <form action="connection.php" method="POST">
                    <label for="username">Change Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter new username"required>
                    <button type="submit" name="updateusername">Update Username</button>
                </form>

                <!-- Change Password -->
                <form action="connection.php" method="POST">
                    <label for="password">Change Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter new password" required>
                    <button type="submit"name="updatepassword">Update Password</button>
                </form>

                <!-- Change Email -->
                <form action="connection.php" method="POST">
                    <label for="email">Change Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter new email"required>
                    <button type="submit"name="updateemail">Update Email</button>
                </form>

                <!-- Select Theme -->
                <form action="connection.php" method="POST">
                    <label for="theme">Select Theme</label>
                    <select id="theme" name="theme">
                        <option value="light">Light Theme</option>
                        <option value="dark">Dark Theme</option>
                    </select>
                    <button type="submit">Update Theme</button>
                </form>

                <!-- Sign Out Button -->
                <a href="studentlogout.php" style="background-color: #f44336; display: inline-block; padding: 10px 20px; color: white; text-align: center; text-decoration: none;">Log Out</a>
                
            </div>
        </section>
      </main>
    </div>

  </body>
</html>
