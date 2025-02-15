<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with PDF Upload</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>PPFinder</h2>
        <ul>
            <li>Dashboard</li>
            <li>Statistics</li>
            <li>Projects</li>
            <li>Upload PDF</li>
            <li>studentDashboard</li><a href="studentDashboard.html">studentDashboard</a>
            <li>adminDashboard</li><a href="adminDashboard.html">adminDashboard</a>
            <li>adminDashboard</li><a href="teacherDashboard.html">teacherDashboard</a>
        </ul>
    </div>

    <div class="content">
        <header>
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <span>Welcome, Admin</span>
            </div>
        </header>

        <div class="main-dashboard">
            <!-- PDF Upload Section -->
            <section class="pdf-upload">
                <h2>Upload PDF Files</h2>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <label for="pdfFile">Select PDF:</label>
                    <input type="file" name="pdfFile" id="pdfFile" accept=".pdf" required>
                    <button type="submit" name="upload">Upload</button>
                </form>
            </section>

            <!-- Uploaded Files List -->
            <section class="pdf-list">
                <h2>Uploaded PDF Files</h2>
                <ul>
                    <?php
                        include 'connection.php';
                        $query = "SELECT * FROM uploaded_pdfs";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li><a href="uploads/' . $row['file_name'] . '" target="_blank">' . $row['file_name'] . '</a></li>';
                        }
                    ?>
                </ul>
            </section>
        </div>
    </div>
</body>
</html>
