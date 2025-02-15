
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Past Papers</title>
  <link rel="stylesheet" href="communicate.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Past Paper Finder</h2>
      <nav>
        <a href="teacherDashboard.php" class="active"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="uploadsteacher.php"><i class="fa fa-upload"></i> Upload Past Papers</a>
        <a href="managepastpaperteacher.php"><i class="fa fa-folder"></i> Manage Papers</a>
        <a href="#analytics"><i class="fa fa-chart-line"></i> Analytics</a>
        <a href="communicate.php"><i class="fa fa-comments"></i> Communicate</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    
    <main>
      <!-- Analytics -->
      <section>
        <h2>Communicate</h2>
        <form action="communicate.php" method="post">
          <label for="subject">Subject</label>
          <input type="text" name="subject" id="subject">
          <label for="email">Email</label>
          <input type="email" name="email" id="email">
          <label for="cc">CC</label>
          <input type="email" name="cc" id="cc">
          <label for="message">Message</label>
          <textarea name="message" id="message" cols="30" rows="10"></textarea>
          <button type="submit" name="send">Send</button>
        </form>
  
      </section>
    </main>
  </div>
  <script src="scripts.js"></script>
</body>
</html>