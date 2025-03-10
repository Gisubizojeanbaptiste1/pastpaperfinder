<?php
// Check if there's an error parameter in the URL
if(isset($_GET['error'])){
    $error_code = $_GET['error'];
    if($error_code == 1){
        $error_message = "Invalid email or password. Please try again.";
    } else {
        $error_message = "An unknown error occurred. Please try again later.";
    }
} else {
    $error_message = "";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link href="loginteacher.css" rel="stylesheet" type="text/css" />
  <title>Teachers login Form</title>
</head>

<body>      
  <section>
    <div class="form-box">
      <div class="form-value">
      <?php if(!empty($error_message)): ?>
        <p style="color: red;padding-bottom:1rem;"><?php echo $error_message; ?></p>
      <?php endif; ?>
        <form action="connection.php" method="POST">
          <h2>Teachers Login</h2>
          <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" id="email" name='email' autocomplete="off" required>
            <label for="email">Email</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" id="password" autocomplete="off" name="password" required oninput="checkPassword()">
            <label for="password">Password </label>
            <span id="passwordStrength"></span>
          </div>
          <div class="forget">
            <label for="remember"><input type="checkbox" id="remember" onclick="myJayFunction()">Show password</label>
            <a href="forgetpassword.php" class="forgeta">Forgot password</a>
          </div>
          <button type="submit" class="btn-login" name="teacherlogin">Log in</button> <br>
          <a href="index.php" class="forget">Go To Home</a>
        </form>
      </div>
    </div>

    </section>   
    <!-- this link is from ionicons(https://ionic.io/ionicons) it is used to provide icons and it use javascript-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
      function validateForm() {
        var password = document.getElementById("password").value;
        var passwordStrength = document.getElementById("passwordStrength");
        var strongRegex = new RegExp(
          "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
        );

        if (password.match(strongRegex)) {
          passwordStrength.innerHTML = "";
          return true;
        } else {
          passwordStrength.innerHTML = "Password must contain at least 8 characters including uppercase, lowercase, numbers, and special characters";
          return false;
        }
      }

      function checkPassword() {
          var password = document.getElementById("password").value;
          var passwordStrength = document.getElementById("passwordStrength");
          var requirements = [];
          if (!password.match(/[a-z]/)) {
            requirements.push("at least one lowercase letter");
          }
          if (!password.match(/[A-Z]/)) {
            requirements.push("at least one uppercase letter");
          }
          if (!password.match(/[0-9]/)) {
            requirements.push("at least one digit");
          }
          if (!password.match(/[!@#$%^&*]/)) {
            requirements.push("at least one special character");
          }

          if (requirements.length === 0) {
            passwordStrength.innerHTML = "Strong password";
            passwordStrength.className = "password-guidelines";
          } else {
            passwordStrength.innerHTML = "Password must contain " + requirements.join(", ");
            passwordStrength.className = "password-guidelines";
          }
        }

        
        function myJayFunction() {
        var jayb = document.getElementById("password");
        if (jayb.type === "password") {
            jayb.type = "text";
        } else {
            jayb.type = "password";
        }
        }
    </script>
  <!-- <script>
      function clearForm() {
          document.getElementById('email').value = '';
          document.getElementById('password').value = '';
          return true;
      }
  </script> -->

  
</body>

</html>
