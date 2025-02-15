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
        <a href="#analytics"><i class="fa fa-chart-line"></i> Analytics</a>
        <a href="communicate.php"><i class="fa fa-comments"></i> Communicate</a>
        <a href="teacherlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main>
      <!-- Welcome Section -->
      <section class="welcome">
        <h1>Welcome, Teacher</h1>
        <p>Manage your past papers and interact with students.</p>
      </section>
      <!-- Analytics -->
      <section id="analytics" class="analytics">
        <h2>Analytics</h2>
        <div class="stats">
          <div class="stat-card">
            <h3>Most Searched Subjects</h3>
            <p>Mathematics</p>
            <p>on January,08 , 2025 </p>
          </div>
          <div class="stat-card">
            <h3>Top downloaded subject</h3>
            <p>total download 102</p>
            <p>Today</p>
          </div>
        </div>
      </section>

      <!-- Manage Past Papers -->
      <section id="manage" class="manage">
      <h2>Manage Past Papers</h2>

<!-- Filter Inputs -->
<input type="text" id="searchInput" placeholder="Type here to search instantly" onkeyup="searchTable()" 
    style="width:19rem;height:2rem;padding-left:1rem;" class="searching_colors">

<label for="">Filter content</label>
<select name="subject" id="subjectFilter">
    <option value="">Filter content based on subjects</option>
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

<select name="class" id="classFilter">
    <option value="">Filter according to class</option>
    <?php 
    include('connection.php');
    $q = "SELECT * FROM class"; 
    $s = mysqli_query($conn, $q); 
    while ($r = mysqli_fetch_assoc($s)) { 
        echo "<option value='{$r['id']}'>{$r['classname']}</option>"; 
    } 
    ?>
</select>

<select name="category" id="categoryFilter">
    <option value="nationalexamination">National Exam</option>
    <option value="exam">Exam</option>
    <option value="mock">Mock</option>
    <option value="weeklyexam">Weekly Exam</option>
    <option value="test">Test</option>
    <option value="quiz">Quiz</option>
</select>

<input type="date" id="dateFilter">

          <!-- <button onclick="applyFilters()">Apply filter</button> -->
        
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
      <th>Cover Page</th>
      <th>Teacher Name</th>
      <th>Qns</th>
      <th>Ans</th>
      <th>Download</th>
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
        echo "<tr><td colspan='13'>No past papers found.</td></tr>";
    }
    ?>
  </tbody>
</table>
 

      </section>

    </main>
    <div id="editModal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        
        <h2>Edit Paper</h2>
        <form id="editForm" action="update_paper.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="editId" name="id">
            
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            
            <label for="classselection">Class:</label>
            <select name="classselection" id="classselection" class="select_option" onchange="checkClassSelection()">
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
            <div id="classOtherInput" style="display:none; padding-top:1rem;">
                <label for="otherClass">Specify Class:</label>
                <input type="text" id="otherClass" name="otherClass" placeholder="Enter your class">
            </div>

            <label for="year">Date:</label>
            <input type="date" id="year" name="year" required>

            <label for="category">Category:</label>
            <select name="optionsofcategory" id="category" class="subject_selection" onchange="checkCategory()">
                <option value="test">Test</option>
                <option value="quiz">Quiz</option>
                <option value="weeklystandardexam">Weekly Standard Exam</option>
                <option value="exam">Exam</option>
                <option value="mock">Mock</option>
                <option value="Nationalexam">National exam</option>
                <option value="other">Other</option>
            </select>

            <!-- Category Input for 'Other' -->
            <div id="categoryOtherInput" style="display:none;">
                <label for="otherCategory">Specify Category:</label>
                <input type="text" id="otherCategory" name="otherCategory" placeholder="Enter category">
            </div>

            <label for="fileimage">Upload cover page:</label>
            <input type="file" id="fileimage" name="fileimage">

            <label for="allnames">Uploaded by:</label>
            <input type="text" name="allnames" id="usernames" required>

            <label for="file">Upload File:</label>
            <input type="file" id="file" name="file" accept=".pdf,.doc,.docx" required>

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</div>
  </div>

  <script>
function searchTable() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase(); // Convert input to uppercase for case-insensitive search
  table = document.getElementById("papersTable");
  tr = table.getElementsByTagName("tr"); // Get all rows in the table

  // Loop through all table rows (except the header row)
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none"; // Initially hide the row
    td = tr[i].getElementsByTagName("td");
    
    // Loop through all columns of the current row
    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        
        // If the text in any column matches the search input, show the row
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break; // No need to check further columns if match found
        }
      }
    }
  }
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
