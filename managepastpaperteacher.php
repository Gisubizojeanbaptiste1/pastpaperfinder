<?php
include 'connection.php';
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Past Papers</title>
  <link rel="stylesheet" href="mangepastpaperteacher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Past Paper Finder</h2>
      <nav>
        <a href="teacherDashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="uploadsteacher.php"><i class="fa fa-upload"></i> Upload Past Papers</a>
        <a href="managepastpaperteacher.php" class="active"><i class="fa fa-folder"></i> Manage Papers</a>
        <a href="#analytics"><i class="fa fa-chart-line"></i> Analytics</a>
        <a href="communicate.php"><i class="fa fa-comments"></i> Communicate</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main>
      <!-- Analytics -->
      <section id="analytics" class="analytics">
        <h2>Manage past papers</h2>
        <div class="stats">
    <div class="stat-card">
        <h3>Most Searched Subjects</h3>
        <p>Mathematica</p>
        <p>with 1000 searches</p>
        <p>on 4/02/2025</p>
    </div>
    <div class="stat-card">
        <h3>Top Downloaded Subject</h3>
        <p>Total downloads: 3220</p>
        <p>Today</p>
    </div>
</div>

      </section>

      <!-- Manage Past Papers -->
      <section id="manage" class="manage">
        <h2>Search Past Papers</h2>
        <input type="text" id="searchInput" placeholder="Type here to search instantly" onkeyup="searchTable()" 
        style="width:19rem;height:2rem;padding-left:1rem;" class="searching_colors">
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
        // Use relative file paths for displaying images and files
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
                <td><a href='teacherdownload.php?id={$row['file_path']}'>Download</a></td>s
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
        
        <h2>Edit/Update Paper</h2>
        <form id="editForm" action="connection.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="editId" name="id">
              <label for="term">Term (Academic Year Term):</label>
              <select name="academicyearterms" id="adacemicyear" class="terms" required>
                  <option value="Term 1">Term 1</option>
                  <option value="Term 2">Term 2</option>
                  <option value="Term 3">Term 3</option>
              </select>

              <label for="W">Weeks</label>
              <select name="Academicweeks" id="studyingweeks" class="weeks">
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
              <input type="text" id="subject" name="subject" required>

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
              <select name="optionsofcategory" id="category" class="subject_selection" onchange="checkCategory()">
                  <option value="test">Test</option>
                  <option value="quiz">Quiz</option>
                  <option value="weeklystandardexam">Weekly Standard Exam</option>
                  <option value="exam">Exam</option>
                  <option value="mock">Mock</option>
                  <option value="Nationalexam">National exam</option>
                  <option value="other">Other</option> <!-- Added Other option -->
              </select>
              
              <!-- Category Input for 'Other' -->
              <div id="categoryOtherInput" style="display:none;">
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
    // Open the modal when the Edit button is clicked
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();

            // Populate the modal with the selected paper details
            document.getElementById('editId').value = button.getAttribute('data-id');
            document.getElementById('subject').value = button.getAttribute('data-subject');
            document.getElementById('classselection').value = button.getAttribute('data-class');
            document.getElementById('year').value = button.getAttribute('data-year');
            document.getElementById('category').value = button.getAttribute('data-category');
            document.getElementById('usernames').value = button.getAttribute('data-uploaded_by');
            // If needed, set the cover image and file path (you can use these for validation or handling)

            // Show the modal
            document.getElementById('editModal').style.display = 'flex';
        });
    });

    // Close the modal
    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>
<script>
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        
        fetch('update_paper.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); 
            closeModal();
            
        })
        .catch(error => {
            alert('Error: ' + error);
        });
    });
</script>

</body>
