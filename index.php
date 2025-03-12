<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Paper Finder</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <nav class="navbar">
      <div class="logo">
        <div class="img-logo">
          <img src="images/logo.png" alt="Logo Image" class="img">
        </div>
        <span class="logo-cont"><a href="index.php">PAST PAPER FINDER</a></span>
      </div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#mission">Mission</a></li>
        <li><a href="#vision">Vision</a></li>
        <li><a href="#about">About</a></li>
      </ul>
      <button class="login-btn dropdown" aria-label="toggle navigation"> Login
            <div class="dropdown-content">
                <a href="loginteacher.php">Teacher Login</a>
                <a href="loginstudent.php">Student Login</a>
            </div>
      </button>
    </nav>
</header>


    <section class="hero">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Find Past Papers with Ease</h1>
                <p>Our platform is a centralized hub where teachers can upload past <br>exam papers, and students can easily access and review them. By simplifying the<br> process of finding and organizing past papers, we aim to enhance <br>academic preparation, promote self-paced learning, and foster a <br>collaborative educational environment.</p>
                <a href="loginstudent.php" class="cta-btn">Get Started</a>
            </div>
        </div>
    </section>


    <section class="mission-vision" id="mission">
        <h2>Our Mission & Vision</h2>

        <div class="mission-vision-content">
            <div class="mission">
                <h2>Our Mission</h2>
                <p>To provide students with easy access to past exam papers, helping them prepare effectively.</p>
            </div>
            <div class="vision">
                <h2>Our Vision</h2>
                <p>To be the top digital platform for academic past papers, empowering students worldwide.</p>
            </div>
        </div>
        
    </section>

    <section class="search-section">
        <h2>Search for Past Papers</h2>
        <input type="text" placeholder="Enter subject or exam name...">
        <button>Search</button>
    </section>

    <section class="categories">
        <h2>Explore Subjects</h2>
        <div class="category-list">
            <div class="category">Mathematics</div>
            <div class="category">Physics</div>
            <div class="category">Chemistry</div>
            <div class="category">Biology</div>
            <div class="category">History</div>
            <div class="category">Literature</div>
        </div>
    </section>

    <section class="about" id="about">
        <h2>About Us</h2>
        <p>Past Paper Finder helps students access past exams easily, making learning more effective.</p>
    </section>

    <footer>
        <p>&copy; 2025 Past Paper Finder | All rights reserved.</p>
        <p>Developed with ❤️ by: <strong>NextGen Coders</strong></p>
    </footer>
</body>
</html>
