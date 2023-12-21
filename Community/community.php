<?php
session_start();

// Database connection for 'loginsimpledb'
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "loginsimpledb";

// Establishing connection to 'loginsimpledb' database
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the username and store it in the session
$sql = "SELECT `user_name` FROM users LIMIT 1"; // Assuming 'user_name' is the username field
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['user_name'];
} else {
    echo "No user found";
}

// Database connection for 'ucomments' database
$dbhost2 = "localhost";
$dbuser2 = "root";
$dbpass2 = "";
$dbname2 = "ucomments";

// Establishing connection to 'ucomments' database
$con2 = mysqli_connect($dbhost2, $dbuser2, $dbpass2, $dbname2);
if (!$con2) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    // Handle comment submission for 'ucomments' table
    $username = $_SESSION['username'];
    $comment = $_POST['comment'];

    $sql2 = "INSERT INTO ucomments (`user`, `ucommnet`) VALUES ('$username', '$comment')";

    if (mysqli_query($con2, $sql2)) {
        echo "Comment saved successfully in 'ucomments' table";
    } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($con2);
    }
}

// Closing connections
mysqli_close($con);
mysqli_close($con2);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FCAI | Community</title>
    <link rel="stylesheet" href="community.css" />
  </head>
  <body>
    <header>
      <!-- This part for logo and main Title -->
      <div class="logo">
        <img src="../Home/imgs/FACIlogo.png" alt="College Logo" />
      </div>
      <div class="title">
        <h1>Faculty of Computers and Artificial Intelligence</h1>
      </div>

      <!-- This part for nav bar need more edits -->
      <nav>
        <ul>
          <li>
            <a href="../Home/index.html" class="a1">Home</a>
          </li>
          <li>
            <a href="../Programs/index.html" class="a1">Programs</a>
          </li>
          <li>
            <a href="../Community/index.html" class="a1">Community</a>
          </li>
          <!-- Button to go to register page wich contains login and signup choices -->
          <li>
            <a href="../Register/index.html" class="button">Register</a>
          </li>
        </ul>
      </nav>
    </header>

    <main>
      <center>
        <section id="events">
          <section id="about">
            <h2>About Our Community</h2>
            <p>
              Welcome to our vibrant communityOur computer science community
              fosters innovation through collaborative projects and cutting-edge
              research. Engaging in hackathons and coding competitions, we
              nurture a culture of problem-solving and creativity. Networking
              events and tech talks facilitate connections among students,
              faculty, and industry experts. Mentorship programs offer guidance,
              empowering aspiring computer scientists in their academic journey.
              Our community hosts seminars and conferences, sharing insights
              into the latest technological advancements.
            </p>
          </section>
          <br />
          
          <h1>Upcoming Events at FCAI college</h1>
          <div class="card-container">
            <div class="photo-container">
              <div class="date">
                <div class="day">15</div>
                <div class="month">MAY</div>
              </div>
              <div class="image"></div>
            </div>
            <div class="info-container">
              <div class="event-name">Pre-Mason Day</div>
              <div class="event-location">
                Early celebration in the Corner Pocket
              </div>
            </div>
          </div>
          <div class="card-container">
            <div class="photo-container">
              <div class="date">
                <div class="day">16</div>
                <div class="month">MAY</div>
              </div>
              <div class="image"></div>
            </div>
            <div class="info-container">
              <div class="event-name">Mason Day</div>
              <div class="event-location">
                See headlining artist: Soulja Boy
              </div>
            </div>
          </div>
          <div class="card-container">
            <div class="photo-container">
              <div class="date">
                <div class="day">22</div>
                <div class="month">MAY</div>
              </div>
              <div class="image"></div>
            </div>
            <div class="info-container">
              <div class="event-name">De-Stress Fest</div>
              <div class="event-location">
                De-stress before finals with puppies!
              </div>
            </div>
          </div>
        </section>
      </center>
      <section id="members">
        <center><h2>Our Members</h2></center>
        <div class="member">
          <img src="imgs/photo_2023-12-16_20-21-04.jpg" alt="Kareem Medhat" />
          <img
            src="imgs/photo_2023-12-16_20-18-21 (2).jpg"
            alt="Mohamed Elmashed "
          />
          <img src="imgs/photo_2023-12-16_20-18-21.jpg" alt="Mohamed Wael " />
          <img src="imgs/photo_2023-12-16_20-18-22.jpg" alt="Yousef Kareem " />
        </div>
        <section id="contactus">
          <div>
            <h2>Contact Us</h2>
            <ul>
              <li><img src="imgs/mail.png" alt="Mail Icon" id="mailimg" /></li>
              <li>
                <a href="mailto:elmashadmohamed775@gmail.com">Elmashed</a>
              </li>
              <li><a href="mailto:wael@gmail.com">Wael</a></li>
              <li><a href="mailto:karim@gmail.com">Karim</a></li>
              <li><a href="mailto:mesawey@gmail.com">Youssef</a></li>
            </ul>
          </div>
          <div>
            <form id="commentForm" action="" method="post">
              <textarea name="comment" id="comment" cols="30" rows="3" placeholder="We want to know your Opinion"></textarea>
              <input type="submit" value="Comment">
            </form>
          </div>
        </section>
      </section>
    </main>
    <footer>
      <div class="footer-left">
        <div class="college-logo">
          <img src="../Home/imgs/FACIlogo.png" alt="College Logo" />
        </div>
        <div class="college-name">
          <h5>FCAI</h5>
        </div>
      </div>
      <div class="footer-content">
        <p><b>&copy; 2023</b> DU | FCAI</p>
      </div>
    </footer>
  </body>
</html>
