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
    <link rel="stylesheet" href="studentRequestpastpaper.css" />
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
          <a href="studentDashboard.php" class="active"><i class="fa fa-home"></i> Dashboard</a>
          <a href="studentfavorite.php"><i class="fa fa-heart"></i> Favorites</a>
          <a href="studentRequestpastpaper.php"><i class="fa fa-envelope"></i> Request Papers</a>
          <a href="studentlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
          <a href="studentsettings.php"><i class="fa fa-cogs" ></i> Settings</a>
          <a href="studentProfile.php" ><i class="fa fa-user" ></i> Student(s) profile</a>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
            <!-- Request Papers Section -->
            <section id="requests" class="request-papers">
                <h2>Request Missing Papers</h2>
                <form method="POST" action="connection.php">
                    <!-- Subject Filter Dropdown -->
                    <select name="subject" id="subjectFilter">
                        <option value="">Request missing paper of any subject</option>
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
                        <option value="other">Other</option> <!-- Added "Other" option -->
                    </select>

                    <!-- New input field for "Other" subject -->
                    <div id="otherSubjectInputContainer" style="display: none;">
                        <input type="text" name="otherSubject" placeholder="Please specify the subject" />
                    </div>

                    <!-- Grade Input -->
                    <input type="text" name="grade" placeholder="Grade" required />
                    <!-- Date Input -->
                    <input type="date" name="date" placeholder="Date" required />

                    <!-- Category Filter Dropdown -->
                    <select name="category" id="categoryFilter">
                        <option value="nationalexamination">National Exam</option>
                        <option value="exam">Exam</option>
                        <option value="mock">Mock</option>
                        <option value="weeklyexam">Weekly Exam</option>
                        <option value="test">Test</option>
                        <option value="quiz">Quiz</option>
                        <option value="other">Other</option> <!-- Added "Other" option -->
                    </select>

                    <!-- New input field for "Other" category -->
                    <div id="otherCategoryInputContainer" style="display: none;">
                        <input type="text" name="otherCategory" placeholder="Please specify the category" />
                    </div>

                    <!-- Class Filter Dropdown -->
                    <select name="class" id="classFilter">
                        <option value="">Select class</option>
                        <?php 
                            include('connection.php');
                            $q = "SELECT * FROM class"; 
                            $s = mysqli_query($conn, $q); 
                            while ($r = mysqli_fetch_assoc($s)) { 
                                echo "<option value='{$r['id']}'>{$r['classname']}</option>"; 
                            } 
                        ?>
                    </select>

                    <!-- Reason/Suggestion Textarea -->
                    <label for="reason">Type Reason/Suggestion for Request</label>
                    <textarea name="details" placeholder="Additional Details"></textarea>

                    <!-- Submit Button -->
                    <button type="submit"name="submitRequest">Submit Request</button>
                </form>
            </section>
      </main>
    </div>

    <script>
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
    
    const subjectSelect = document.getElementById('subjectFilter');
    const otherSubjectInputContainer = document.getElementById('otherSubjectInputContainer');
    
    const categorySelect = document.getElementById('categoryFilter');
    const otherCategoryInputContainer = document.getElementById('otherCategoryInputContainer');

    
    subjectSelect.addEventListener('change', function() {
        if (subjectSelect.value === 'other') {
            otherSubjectInputContainer.style.display = 'block';
        } else {
            otherSubjectInputContainer.style.display = 'none';
        }
    });

    
    categorySelect.addEventListener('change', function() {
        if (categorySelect.value === 'other') {
            otherCategoryInputContainer.style.display = 'block';
        } else {
            otherCategoryInputContainer.style.display = 'none';
        }
    });
</script>
  </body>
</html>
