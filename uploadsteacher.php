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
  <link rel="stylesheet" href="uploadsteacher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="teacher-dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Past Paper Finder</h2>
      <nav>
        <a href="teacherDashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="uploadsteacher.php" class="active"><i class="fa fa-upload"></i> Upload Past Papers</a>
        <a href="managepastpaperteacher.php"><i class="fa fa-folder"></i> Manage Papers</a>
        <a href="analyticspageteacher.php"><i class="fa fa-chart-line"></i> Analytics</a>
        <!-- <a href="communicate.php"><i class="fa fa-comments"></i> Communicate</a> -->
        <a href="StudentRequest.php"><i class="fa fa-comments"></i> Student Requests</a>
        <a href="teacherlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main>
      <!-- Upload Past Papers -->
      <section id="upload" class="upload">

      
      <form action="connection.php" method="POST" enctype="multipart/form-data">
    <h2>Upload Past Papers</h2>

    <label for="term">Term (Academic Year Term):</label>
    <select name="academicyearterms" id="adacemicyear" class="select_option" required>
        <option value="Term 1">Term 1</option>
        <option value="Term 2">Term 2</option>
        <option value="Term 3">Term 3</option>
    </select>

    <label for="W">Weeks</label>
    <select name="Academicweeks" id="studyingweeks" class="select_option">
      <option value="Week 1">Week 1</option>
      <option value="Week 2">Week 2</option>
      <option value="Week 3">Week 3</option>
      <option value="Week 4">Week 4</option>
      <option value="Week 5">Week 5</option>
      <option value="Week 6">Week 6</option>
      <option value="Week 7">Week 7</option>
      <option value="Week 8">Week 8</option>
      <option value="Week 9">Week 9</option>
      <option value="Week 10">Week 10</option>
      <option value="Week 11">Week 11</option>
      <option value="Week 12">Week 12</option>
      <option value="Week 13">Week 13</option>
      <option value="Week 14">Week 15</option>
      <option value="Week 16">Week 16</option>
      <option value="Week 17">Week 17</option>
    </select>
    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" placeholder="Enter Your Name" required>

    <label for="classselection">Class:</label>
    <select name="classselection" id="classselection" class="select_option" onchange="checkClassSelection()">
        <option value="">Select your class</option>
        <option value="S4MEG">S4 MEG</option>
        <option value="S4MCE">S4 MCE</option>
        <option value="S4PCB">S4 PCB</option>
        <option value="S4MPC">S4 MPC</option>
        <option value="S4HGL">S4 HGL</option>
        <option value="S5MEG">S5 MEG</option>
        <option value="S5MCE">S5 MCE</option>
        <option value="S5PCB">S5 PCB</option>
        <option value="S5MPC">S5 MPC</option>
        <option value="S5HGL">S5 HGL</option>
        <option value="S6MEG">S6 MEG</option>
        <option value="S6MCE">S6 MCE</option>
        <option value="S6PCB">S6 PCB</option>
        <option value="S6MPC">S6 MPC</option>
        <option value="S6HGL">S6 HGL</option>
        <option value="other">Other</option> 
    </select>
    
    <!-- Class Input for 'Other' -->
    <div id="classOtherInput" style="display:none;padding-top:1rem;">
        <label for="otherClass">Specify Class:</label>
        <input type="text" id="otherClass" name="otherClass" placeholder="Enter your class">
    </div>
    <label for="category">Category:</label>
    <select name="optionsofcategory" id="category" class="select_option" onchange="checkCategory()">
        <option value="test">Test</option>
        <option value="quiz">Quiz</option>
        <option value="weeklystandardexam">Weekly Standard Exam</option>
        <option value="exam">Exam</option>
        <option value="mock">Mock</option>
        <option value="Nationalexam">National exam</option>
        <option value="other">Other</option> <!-- Added Other option -->
    </select>
    
    <!-- Category Input for 'Other' -->
    <div id="categoryOtherInput" style="display:none; font-family: 'Poppins', sans-serif;">
        <label for="otherCategory">Specify Category:</label>
        <input type="text" id="otherCategory" name="otherCategory" placeholder="Enter category">
    </div>

    <label for="fileimage">Upload cover page:</label>
    <input type="file" id="fileimage" name="fileimage" required>

    <label for="allnames">Uploaded by:</label>
    <input type="text" name="allnames" id="usernames" placeholder="Uploaded by teacher" required>

    <label for="file">Upload paper File:</label>
    <input type="file" id="file" name="file" accept=".pdf,.doc,.docx" required>
    <label for="answers">Upload answer of paper:</label>
    <input type="file" id="answers" name="answers" accept=".pdf,.doc,.docx" required>
    <button type="submit" name="uploadpastpaper">Upload</button>
</form>

      </section>
    </main>
  </div>

  <script>
    // Function to show the input for 'Other' class
    function checkClassSelection() {
        var classSelection = document.getElementById("classselection").value;
        var classOtherInput = document.getElementById("classOtherInput");

        if (classSelection === "other") {
            classOtherInput.style.display = "block";
        } else {
            classOtherInput.style.display = "none";
        }
    }

    // Function to show the input for 'Other' category
    function checkCategory() {
        var categorySelection = document.getElementById("category").value;
        var categoryOtherInput = document.getElementById("categoryOtherInput");

        if (categorySelection === "other") {
            categoryOtherInput.style.display = "block";
        } else {
            categoryOtherInput.style.display = "none"; 
        }
    }
</script>
</body>
</html>
