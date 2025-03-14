<?php
$conn = mysqli_connect("localhost", "root", "", "paperfinder");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

        //these codes are used for checking input wheather they are collect when user try to sign in
        if(isset($_POST["studentlogin"])){
            $email = $_POST["email"];
            $password = $_POST["password"];

            $query = "SELECT * FROM users WHERE email='$email' AND password='$password' And userrole='student'";
            $jayb = mysqli_query($conn, $query);

            
            if(mysqli_num_rows($jayb) == 1){
                $results = mysqli_fetch_assoc($jayb);

                $_SESSION['name'] = $results['name'];
                $_SESSION['role'] = $results['user_role'];
                $_SESSION['id'] = $results['id'];
                $_SESSION['email'] = $results['email'];
                $_SESSION['profile'] = $results['profile'];

                
                header('location: studentDashboard.php');
                exit;
            } else {
                
                header('location: loginstudent.php?error=1');
                exit; 
            }
        }
    
        //student sign up
        if (isset($_POST['studentsignin'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $userrole = 'student';
    
            $query = "INSERT INTO users (name, email, password, userrole) VALUES ('$name', '$email', '$password', '$userrole')";
    
            if (mysqli_query($conn, $query)) {
                header('Location: loginstudent.php');
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
            
    $search = '';

    // Check if the form has been submitted and update $search
    if (isset($_POST['searchbutton'])) {
        $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
    }

    // Search query
    $sql = "SELECT * FROM past_papers WHERE subject LIKE '%$search%' OR class_selection LIKE '%$search%' OR category LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);


    if (isset($_POST['searchbutton'])) {
        $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
    
        // Update the search count for the searched subject
        $search_query = "UPDATE past_papers SET search_count = search_count + 1 WHERE subject LIKE '%$search%'";
        mysqli_query($conn, $search_query);
    
        // Continue with your search functionality...
    }

    // if (isset($_GET['download_id'])) {
    //     $download_id = $_GET['download_id'];
    
        
    //     $result = mysqli_query($conn, "SELECT subject FROM past_papers WHERE id = '$download_id'");
    //     $row = mysqli_fetch_assoc($result);
    //     $subject = $row['subject'];
    
        
    //     $download_query = "UPDATE past_papers SET download_count = download_count + 1 WHERE id = '$download_id'";
    //     mysqli_query($conn, $download_query);
    
       
    // }
    if (isset($_POST['submitRequest'])) {

        // Collect form data
        $subject = $_POST['subject'];
        $otherSubject = isset($_POST['otherSubject']) ? $_POST['otherSubject'] : null;
        $grade = $_POST['grade'];
        $date = $_POST['date'];
        $category = $_POST['category'];
        $otherCategory = isset($_POST['otherCategory']) ? $_POST['otherCategory'] : null;
        $class_id = $_POST['class'];
        $details = $_POST['details'];
    
        $query = "INSERT INTO requests (subject, otherSubject, grade, date, category, otherCategory, class_id, details) 
                  VALUES ('$subject', '$otherSubject', '$grade', '$date', '$category', '$otherCategory', '$class_id', '$details')";
    
      
        if (mysqli_query($conn, $query)) {
            header('Location: studentRequestpastpaper.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }    

    //updating user name, password and email of the users from line 154 up to 190
    if (isset($_POST['updateusername'])) {
        // Update username
        $new_username = $_POST['username'];

        $user_id = $_SESSION['id'];
        $query = "UPDATE users SET name = '$new_username' WHERE id = $user_id";
        if ($conn->query($query) === TRUE) {
            echo "Username updated successfully.";
            header("Location: studentProfile.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }

    if (isset($_POST['updatepassword'])) {
        
        $new_password = $_POST['password'];
        $user_id = $_SESSION['id'];
        $query = "UPDATE users SET password = '$new_password' WHERE id = $user_id";
        if ($conn->query($query) === TRUE) {
            echo "Password updated successfully.";
            header("Location: studentProfile.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }

    if (isset($_POST['updateemail'])) {
       
        $new_email = $_POST['email'];
        $user_id = $_SESSION['id'];
        $query = "UPDATE users SET email = '$new_email' WHERE id = $user_id";
        if ($conn->query($query) === TRUE) {
            echo "Email updated successfully.";
            header("Location: studentProfile.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }

    //from this point on the reqirements for the teacher will all be here 
    //and this is the codes for teacher login page and redireaction to the teacher dashboard

    if(isset($_POST["teacherlogin"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        // Adjusted query to check for teacher role directly
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password' AND userrole='teacher'";
        $jayb = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($jayb) == 1){
            $results = mysqli_fetch_assoc($jayb);
    
            $_SESSION['name'] = $results['name'];
            $_SESSION['role'] = $results['user_role'];
            $_SESSION['id'] = $results['id'];
            $_SESSION['email'] = $results['email'];
            $_SESSION['profile'] = $results['profile'];
    
            // Redirect to teacher's dashboard
            header('location: teacherDashboard.php');
            exit;
        } else {
            // Redirect back to login page with an error
            header('location: loginteacher.php?error=1');
            exit;
        }
    }

    // if (isset($_POST['update'])) {
    //     $id = $_POST['id'];
    //     $subject = $_POST['subject'];
    //     $classselection = $_POST['classselection'];
    //     $year = $_POST['year'];
    //     $category = $_POST['optionsofcategory'];
    //     $uploaded_by = $_POST['allnames'];
    
    //     // Handle file upload logic if required
    //     // ...
    
    //     // Update database
    //     $sql = "UPDATE past_papers SET subject='$subject', class_selection='$classselection', year='$year', category='$category', uploaded_by='$uploaded_by' WHERE id=$id";
    
    //     if (mysqli_query($conn, $sql)) {
    //         echo "Paper updated successfully!";
    //     } else {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    // }
    
    if (isset($_POST['updatePastpaper'])) {
        // Get form data with proper error handling for missing values
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $class_selection = mysqli_real_escape_string($conn, $_POST['classselection']);
        $term = isset($_POST['academicyearterms']) ? mysqli_real_escape_string($conn, $_POST['academicyearterms']) : '';
        $week = mysqli_real_escape_string($conn, $_POST['Academicweeks']);
        $category = isset($_POST['optionsofcategory']) ? mysqli_real_escape_string($conn, $_POST['optionsofcategory']) : '';
        $uploaded_by = mysqli_real_escape_string($conn, $_POST['allnames']);
    
        // Handling 'Other' options
        if ($class_selection === "other") {
            $class_selection = mysqli_real_escape_string($conn, $_POST['otherClass']);
        }
    
        if ($category === "other") {
            $category = mysqli_real_escape_string($conn, $_POST['otherCategory']);
        }
    
        // Handle file uploads
        $cover_page = $_FILES['fileimage'];
        $paper_file = $_FILES['file'];
        $answer_file = $_FILES['answers'];
    
        // Check for upload errors
        if ($cover_page['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading the cover page. Error code: " . $cover_page['error']);
        }
    
        if ($paper_file['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading the paper file. Error code: " . $paper_file['error']);
        }
    
        if ($answer_file['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading the answer file. Error code: " . $answer_file['error']);
        }
    
        // Directories for file storage
        $cover_upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/steam/pastpaper/uploads/covers/';
        $paper_upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/steam/pastpaper/uploads/papers/';
        $answer_upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/steam/pastpaper/uploads/answers/';
    
        // Validate and move the files
        $cover_page_name = time() . '_' . basename($cover_page['name']);
        $cover_page_path = $cover_upload_dir . $cover_page_name;
        if (!move_uploaded_file($cover_page['tmp_name'], $cover_page_path)) {
            die("Error uploading the cover page.");
        }
    
        $paper_name = time() . '_' . basename($paper_file['name']);
        $paper_path = $paper_upload_dir . $paper_name;
        if (!move_uploaded_file($paper_file['tmp_name'], $paper_path)) {
            die("Error uploading the paper file.");
        }
    
        $answer_name = time() . '_' . basename($answer_file['name']);
        $answer_path = $answer_upload_dir . $answer_name;
        if (!move_uploaded_file($answer_file['tmp_name'], $answer_path)) {
            die("Error uploading the answer file.");
        }
    
        // Insert data into the database
        $sql = "UPDATE past_papers 
        SET 
            Term = '$term', 
            weeks = '$week', 
            subject = '$subject', 
            class_selection = '$class_selection', 
            category = '$category', 
            cover_page = '$cover_page_path', 
            uploaded_by = '$uploaded_by', 
            file_path = '$paper_path', 
            answers = '$answer_path' 
        WHERE paper_id = '$paper_id'";

    
        if (mysqli_query($conn, $sql)) {
            echo "Past paper updated successfully!";
            header("Location: managepastpaperteacher.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }


    //Uploading pastpapers by teachers
    // if (isset($_POST['uploadpastpaper'])) {
        
    //     $term = mysqli_real_escape_string($conn, $_POST['academicyearterms']);
    //     $week = mysqli_real_escape_string($conn, $_POST['Academicweeks']);
    //     $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    //     $class_selection = mysqli_real_escape_string($conn, $_POST['classselection']);
    //     $category = mysqli_real_escape_string($conn, $_POST['optionsofcategory']);
    //     $uploaded_by = mysqli_real_escape_string($conn, $_POST['allnames']);
    //     $year = date("Y-m-d"); 
    
    //     // Handle file uploads
    //     $cover_page = $_FILES['fileimage']['name'];
    //     $file_path = $_FILES['file']['name'];
    //     $answers = $_FILES['answers']['name'];
    
    //     // File upload directory
    //     $target_dir = "uploads/";
    //     move_uploaded_file($_FILES['fileimage']['tmp_name'], $target_dir . $cover_page);
    //     move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $file_path);
    //     move_uploaded_file($_FILES['answers']['tmp_name'], $target_dir . $answers);
    
    //     // Insert into database
    //     $query = "INSERT INTO past_papers (Term, weeks, subject, class_selection, year, category, cover_page, uploaded_by, file_path, answers) 
    //               VALUES ('$term', '$week', '$subject', '$class_selection', '$year', '$category', '$cover_page', '$uploaded_by', '$file_path', '$answers')";
    
    //     if (mysqli_query($conn, $query)) {
    //         header('Location: teacherDashboard.php');
    //         Alert("The past paper have been inserted successfully");
    //         exit();
    //     } else {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    // }

    // if (isset($_POST['uploadpastpaper'])) {
    //     $term = $_POST['academicyearterms'];
    //     $week = $_POST['Academicweeks'];
    //     $subject = $_POST['subject'];
    //     $class_selection = $_POST['classselection'];
    //     $year = $_POST['year'];
    //     $category = $_POST['optionsofcategory'];
    //     $uploaded_by = $_SESSION['Name'];
    
    //     // Define directories
    //     $coverDir = 'uploads/covers/';
    //     $paperDir = 'uploads/papers/';
    //     $answerDir = 'uploads/answers/';
    
    //     // Handle file uploads
    //     function uploadFile($file, $targetDir) {
    //         $fileName = time() . '_' . basename($file['name']);
    //         $targetPath = $targetDir . $fileName;
    //         if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    //             return $targetPath;
    //         }
    //         return null;
    //     }
    
    //     $coverPagePath = uploadFile($_FILES['cover_page'], $coverDir);
    //     $filePath = uploadFile($_FILES['file_path'], $paperDir);
    //     $answersPath = isset($_FILES['answers']) ? uploadFile($_FILES['answers'], $answerDir) : null;
    
    //     if ($coverPagePath && $filePath) {
    //         $stmt = $conn->prepare("INSERT INTO past_papers (Term, weeks, subject, class_selection, year, category, cover_page, uploaded_by, file_path, answers, uploaded_at, searches_count, views_count) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 0, 0)");
    //         $stmt->bind_param("sssssssss", $term, $week, $subject, $class_selection, $year, $category, $coverPagePath, $uploaded_by, $filePath, $answersPath);
    
    //         if ($stmt->execute()) {
    //             echo "File uploaded successfully.";
    //         } else {
    //             echo "Error: " . $stmt->error;
    //         }
    
    //         $stmt->close();
    //     } else {
    //         echo "File upload failed. Please try again.";
    //     }
    
    //     $conn->close();
    // }

    if (isset($_POST['uploadpastpaper'])) {
        // Get form data with proper error handling for missing values
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $class_selection = mysqli_real_escape_string($conn, $_POST['classselection']);
        $term = isset($_POST['academicyearterms']) ? mysqli_real_escape_string($conn, $_POST['academicyearterms']) : '';
        $week = mysqli_real_escape_string($conn, $_POST['Academicweeks']);
        $category = isset($_POST['optionsofcategory']) ? mysqli_real_escape_string($conn, $_POST['optionsofcategory']) : '';
        $uploaded_by = mysqli_real_escape_string($conn, $_POST['allnames']);
    
        // Handling 'Other' options
        if ($class_selection === "other") {
            $class_selection = mysqli_real_escape_string($conn, $_POST['otherClass']);
        }
    
        if ($category === "other") {
            $category = mysqli_real_escape_string($conn, $_POST['otherCategory']);
        }
    
        // Handle file uploads
        $cover_page = $_FILES['fileimage'];
        $paper_file = $_FILES['file'];
        $answer_file = $_FILES['answers'];
    
        // Check for upload errors
        if ($cover_page['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading the cover page. Error code: " . $cover_page['error']);
        }
    
        if ($paper_file['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading the paper file. Error code: " . $paper_file['error']);
        }
    
        if ($answer_file['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading the answer file. Error code: " . $answer_file['error']);
        }
    
        // Directories for file storage
        $cover_upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/steam/pastpaperfinder/uploads/covers/';
        $paper_upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/steam/pastpaperfinder/uploads/papers/';
        $answer_upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/steam/pastpaperfinder/uploads/answers/';
    
        // Validate and move the files
        $cover_page_name = time() . '_' . basename($cover_page['name']);
        $cover_page_path = $cover_upload_dir . $cover_page_name;
        if (!move_uploaded_file($cover_page['tmp_name'], $cover_page_path)) {
            die("Error uploading the cover page.");
        }
    
        $paper_name = time() . '_' . basename($paper_file['name']);
        $paper_path = $paper_upload_dir . $paper_name;
        if (!move_uploaded_file($paper_file['tmp_name'], $paper_path)) {
            die("Error uploading the paper file.");
        }
    
        $answer_name = time() . '_' . basename($answer_file['name']);
        $answer_path = $answer_upload_dir . $answer_name;
        if (!move_uploaded_file($answer_file['tmp_name'], $answer_path)) {
            die("Error uploading the answer file.");
        }
    
        // Insert data into the database
        $sql = "INSERT INTO past_papers 
            (Term, weeks, subject, class_selection, category, cover_page, uploaded_by, file_path, answers) 
            VALUES 
            ('$term', '$week', '$subject', '$class_selection', '$category', '$cover_page_path', '$uploaded_by', '$paper_path', '$answer_path')";
    
        if (mysqli_query($conn, $sql)) {
            echo "Past paper uploaded successfully!";
            header("Location: managepastpaperteacher.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    
?>

