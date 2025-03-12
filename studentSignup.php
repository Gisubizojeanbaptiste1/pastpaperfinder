<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup Page</title>
    <link rel="stylesheet" href="loginstudent.css">
</head>
<body>
    <section>
    <div class="form-box">
      <div class="form-value">
      <?php if(!empty($error_message)): ?>
        <p style="color: red;padding-bottom:1rem;"><?php echo $error_message; ?></p>
      <?php endif; ?>
        <form action="connection.php" method="POST">
          <h2>Student's Sign Up</h2>
          <div class="inputbox">
            <ion-icon name="person-outline"></ion-icon>
            <input type="text" id="name" name='name' autocomplete="off" required>
            <label for="name">Name</label>
          </div>
          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" id="email" name='email' autocomplete="off" required>
            <label for="email">Email</label>
          </div>

          <div class="inputbox">
            <select name="role" id="role" class="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="student">Student</option>
            </select>
          </div>

          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" id="password" autocomplete="off" name="password" required oninput="checkPassword()">
            <label for="password">Password </label>
            <span id="passwordStrength"></span>
          </div>
          <div class="forget">
            <label for="remember"><input type="checkbox" id="remember" onclick="myJayFunction()">Show password</label>
          </div>
          <button type="submit" class="btn-login" name="studentsignin">Sign Up</button> <br>
          <p class='forget'>Have an account? <a href="loginstudent.php" class="forget">Login</a></p>
          <a href="index.php" class="forget">Go To Home</a>
        </form>
      </div>
    </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>

        function myJayFunction() {
        var jayb = document.getElementById("password");
        if (jayb.type === "password") {
            jayb.type = "text";
        } else {
            jayb.type = "password";
        }
        }
    </script>
</body>
</html>