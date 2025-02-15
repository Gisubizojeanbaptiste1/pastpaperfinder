<?php
include('connection.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('location:loginstudent.php');
    exit();
}

$sql = "SELECT id, subject FROM past_papers";
$result = $conn->query($sql);

// echo "<h2>Available Papers</h2>";
// while ($row = $result->fetch_assoc()) {
//     echo "<p>{$row['id']} <button onclick=\"toggleFavorite('add', {$row['subject']})\">Add to Favorite</button></p>";
// }
$userId = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard | Past Paper Finder</title>
    <link rel="stylesheet" href="studentfavorite.css" />
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
          <a href="studentfavorite.php" class="active"><i class="fa fa-heart"></i> Favorites</a>
          <a href="studentRequestpastpaper.php"><i class="fa fa-envelope"></i> Request Papers</a>
          <a href="studentlogout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
          <a href="studentsettings.php"><i class="fa fa-cogs" ></i> Settings</a>
          <a href="studentProfile.php" ><i class="fa fa-user" ></i> Student(s) profile</a>
        </nav>
      </aside>

      <!-- Main Content -->
      <main>
        <!-- Search Bar -->
        <section class="search-bar">
          
          <h2>Search for Past Papers</h2>    
          <input type="text" id="searchInput" placeholder="Type here to search instantly" onkeyup="searchTable()" 
        style="width:19rem;height:2rem;padding-left:1rem;" class="searching_colors">
        </section>

        <!-- Papers Section -->
        <section class="papers">
          <h2>Available Papers</h2>
          <!-- <div class="paper-list">
            <div class="paper-card">
              <h3>Mathematics (2023)</h3>
              <p>Grade 12</p>
              <a href="download.php?id=1" class="btn">Download</a>
              <button class="btn-fav" onclick="addToFavorites(1)">
                Add to Favorites
              </button>
            </div>
            
          </div> -->
        </section>

        <?php
include "connection.php";

// Pagination setup
$limit = 6; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total records
$totalQuery = "SELECT COUNT(*) AS total FROM past_papers";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRows = $totalRow['total'];
$totalPages = ceil($totalRows / $limit);

// Get past papers with pagination
$papersQuery = "SELECT p.*, 
                (SELECT COUNT(*) FROM favourite f WHERE f.user_id = {$_SESSION['id']} AND f.paper_id = p.id) AS is_favorite
                FROM past_papers p 
                ORDER BY uploaded_at DESC 
                LIMIT $limit OFFSET $offset";
$papersResult = mysqli_query($conn, $papersQuery);
?>

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
            <th>Add/Remove Favourites</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($papersResult) > 0) {
            while ($row = mysqli_fetch_assoc($papersResult)) {
                $coverPath = str_replace('C:/xampp/htdocs', '', $row['cover_page']);
                $filePath = str_replace('C:/xampp/htdocs', '', $row['file_path']);
                $answerPath = str_replace('C:/xampp/htdocs', '', $row['answers']);
                $isFavorite = $row['is_favorite'] > 0;
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['Term']}</td>
                        <td>{$row['weeks']}</td>
                        <td>" . htmlspecialchars($row['subject']) . "</td>
                        <td>" . htmlspecialchars($row['class_selection']) . "</td>
                        <td>{$row['year']}</td>
                        <td>" . htmlspecialchars($row['category']) . "</td>
                        <td><img src='{$coverPath}' alt='Cover' width='50'></td>
                        <td>" . htmlspecialchars($row['uploaded_by']) . "</td>
                        <td><a href='{$filePath}' target='_blank'>Qns</a></td>
                        <td><a href='{$answerPath}' target='_blank'>Ans</a></td>
                        <td><a href='teacherdownload.php?id={$row['file_path']}'>Download</a></td>
                        <td>
                            <span class='favorite-icon " . ($isFavorite ? 'favorited' : '') . "' 
                                  id='fav-icon-{$row['id']}'
                                  onclick=\"toggleFavorite('" . ($isFavorite ? 'remove' : 'add') . "', {$row['id']})\">
                                  " . ($isFavorite ? '❤️' : '🤍') . "
                            </span>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='13'>No past papers found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
function toggleFavorite(action, paperId) {
    // Perform AJAX request to add or remove from favorites
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "add_or_remove_favorite.php?action=" + action + "&paper_id=" + paperId, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText == "added") {
                alert("Added to favorites!");
                document.querySelector(`#fav-icon-${paperId}`).innerHTML = '❤️';
                document.querySelector(`#fav-icon-${paperId}`).setAttribute('onclick', `toggleFavorite('remove', ${paperId})`);
            } else if (xhr.responseText == "removed") {
                alert("Removed from favorites!");
                document.querySelector(`#fav-icon-${paperId}`).innerHTML = '🤍';
                document.querySelector(`#fav-icon-${paperId}`).setAttribute('onclick', `toggleFavorite('add', ${paperId})`);
            } else {
                alert("There was an error. Please try again.");
            }
        }
    };

    xhr.send();
}
</script>


        <div class="pagination">
            <?php
            if ($page > 1) {
                echo "<a href='?page=" . ($page - 1) . "'>Previous</a>";
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                echo $i == $page ? "<span>$i</span>" : "<a href='?page=$i'>$i</a>";
            }
            if ($page < $totalPages) {
                echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
            }
            ?>
        </div>
    </section>
      </main>
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
  </body>
</html>
