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

$mostSearchedQuery = "SELECT subject, searches_count FROM past_papers ORDER BY searches_count DESC LIMIT 1";
$mostViewedQuery = "SELECT subject, views_count FROM past_papers ORDER BY views_count DESC LIMIT 1";

$mostSearchedResult = mysqli_query($conn, $mostSearchedQuery);
$mostViewedResult = mysqli_query($conn, $mostViewedQuery);

$mostSearched = mysqli_fetch_assoc($mostSearchedResult);
$mostViewed = mysqli_fetch_assoc($mostViewedResult);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard | Past Paper Finder</title>
  <link rel="stylesheet" href="teacherDashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="teacher-dashboard">
    <!-- Sidebar -->
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
      <!-- Welcome Section -->
      <section class="welcome">
        <h1>Welcome, <span>Teacher</span></h1>
        <p>Manage your past papers and interact with students.</p>
      </section>
      <!-- Analytics -->
      <section id="analytics" class="analytics">
        <h2>Analytics</h2>
        <div class="stats">
          <div class="stat-card">
            <h3>Most Searched Subject</h3>
            <p><?php echo $mostSearched['subject']; ?></p>
            <p>On <?php echo date('F j, Y'); ?></p>
          </div>
          <div class="stat-card">
            <h3>Most Viewed Subject</h3>
            <p><?php echo $mostViewed['subject']; ?></p>
            <p>Today</p>
          </div>
        </div>
      </section>

      <!-- Manage Past Papers -->
      <section id="manage" class="manage">
        <h2>Manage Past Papers</h2>

        <!-- Filter Inputs -->
        <input type="text" id="searchInput" placeholder="Type here to search instantly" onkeyup="searchTable()" 
          style="width:19rem;height:2rem;padding-left:1rem;" class="search-input">
           <br>

        <label for="">Filter Content Based On: </label>
        <select name="subject" id="subjectFilter" class="select_option">
            <option value="">Subjects</option>
            <option value="chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="Physics">Physics</option>
            <option value="generalpaper">General paper</option>
            <option value="english">English</option>
            <option value="kinyearwanda">Kinyarwanda</option>
            <option value="entrepreneurship">Entrepreneurship</option>
            <option value="computerscience">Computer Science</option>
            <option value="java">Java</option>
            <option value="math">Math</option>
            <option value="economics">Economics</option>
            <option value="networking">Networking</option>
            <option value="database">Database</option>
            <option value="history">History</option>
            <option value="geography">Geography</option>
            <option value="literature">Literature</option>
        </select> 

        <select name="class" id="classFilter" class="select_option">
            <option value="">Class</option>
            <?php 
            include('connection.php');
            $q = "SELECT * FROM class"; 
            $s = mysqli_query($conn, $q); 
            while ($r = mysqli_fetch_assoc($s)) { 
                echo "<option value='{$r['id']}'>{$r['classname']}</option>"; 
            } 
            ?>
        </select>

        <select name="category" id="categoryFilter" class="select_option">
            <option value="nationalexamination">Paper Type</option>
            <option value="exam">Exam</option>
            <option value="mock">Mock</option>
            <option value="weeklyexam">Weekly Exam</option>
            <option value="test">Test</option>
            <option value="quiz">Quiz</option>
        </select>

        <input type="date" id="dateFilter" class="select">
     <!-- <button onclick="applyFilters()">Apply filter</button>           -->
      </section>
              <!-- Manage Past Papers -->
  <section id="manage" class="manage">
  <table id="papersTable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Term</th>
      <th>Week</th>
      <th>Subject</th>
      <th>Class</th>
      <th>Year</th>
      <th>Category</th>
      <th>Teacher Name</th>
      <th>Qns</th>
      <th>Ans</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include 'connection.php';
    $sql = "SELECT * FROM past_papers";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
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
                    <td>{$row['uploaded_by']}</td>
                    <td><a href='{$filePath}' target='_blank' onclick='updateViewCount({$row['id']})'>Qns</a></td>
                    <td><a href='{$answerPath}' target='_blank' onclick='updateViewCount({$row['id']})'>Ans</a></td>
                    <td>
                        <a href='#' class='edit-btn' data-id='{$row['id']}' onclick='showEdit({$row['id']})'>Edit</a> |
                        <a href='delete_paper.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='13'>No past papers found.</td></tr>";
    }
    ?>
  </tbody>
</table>
</section>

    <!-- add new teacher popup -->
<div class="addTeacherModal" display="none" id="addTeachers">
  <div id="addTeacherModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="hideAddTeacher()">&times;</span>
      <h2>Add New Teacher</h2>
      <form action="addNewTeacher.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit" name="addTeacher">Add Teacher</button>
      </form>
    </div>
  </div>
</div>

</main>
    <div id="editModal" style="display:none;" class="EditModel">
    <div class="modal-content">
        <span class="close-btn" onclick="hideEdit()">&times;</span>
        
        <h2 class="Header_paspaperEdit">Edit Paper</h2>
        <form id="editForm" action="connection.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="editId" name="id">
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
              
            <button type="submit" name="updatePastpaper">Update</button>
        </form>
    </div>
</div>
</div>

<script>
  function showEdit(){
      document.getElementById("editModal").style.display = "flex";
    }
    function hideEdit(){
      document.getElementById("editModal").style.display = "none";
    }

    function addTeacher(){
      document.getElementById("addTeachers").style.display="flex";
    }
    function hideAddTeacher(){
      document.getElementById("addTeachers").style.display="none";
    }
</script>
  <script>
// Search Table Function
function searchTable() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("papersTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows (except the header row)
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none"; // Initially hide the row
    td = tr[i].getElementsByTagName("td");

    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          
          // Send the search count update when a paper is matched
          var paperId = tr[i].getElementsByTagName("td")[0].textContent; // ID is in the first column
          updateSearchCount(paperId);

          break;
        }
      }
    }
  }
}

// Update Search Count via AJAX
function updateSearchCount(paperId) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "update_search.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log('Search count updated!');
    }
  };
  xhr.send("id=" + paperId);
}

// Update View Count via AJAX
function updateViewCount(paperId) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "update_view.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log('View count updated!');
    }
  };
  xhr.send("id=" + paperId);
}

</script>
<script>
document.getElementById('subjectFilter').addEventListener('change', applyFilters);
document.getElementById('classFilter').addEventListener('change', applyFilters);
document.getElementById('categoryFilter').addEventListener('change', applyFilters);
document.getElementById('dateFilter').addEventListener('change', applyFilters);

function applyFilters() {
    let subject = document.getElementById('subjectFilter').value;
    let classSelection = document.getElementById('classFilter').value;
    let category = document.getElementById('categoryFilter').value;
    let date = document.getElementById('dateFilter').value;

    // AJAX to fetch filtered data
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `filter_papers.php?subject=${subject}&class=${classSelection}&category=${category}&date=${date}`, true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            let response = xhr.responseText;
            
            // Update the table body with the response
            let tableBody = document.querySelector('#papersTable tbody');
            tableBody.innerHTML = response;
        }
    };
    xhr.send();
}


</script>
</body>
</html>
