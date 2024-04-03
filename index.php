<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "userdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate credentials
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // User found, verify password
      $row = $result->fetch_assoc();
      if (password_verify($password, $row['password'])) {
          // Password is correct, login successful
          echo "Login successful!";
          // Redirect to the dashboard or home page
          // header("Location: dashboard.php");
          // exit;
      } else {
          // Incorrect password
          echo "Incorrect password.";
      }
  } else {
      // User not found
      echo "User not found.";
  }
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hawkworks Drone App - Sign In</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <script>
        // Function to handle form submission and redirect to loggedin.php
        function handleFormSubmission() {
            // Retrieve form data
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Perform basic client-side validation (you can add more)
            if (email.trim() === "" || password.trim() === "") {
                alert("Please enter both email and password.");
                return false; // Prevent form submission
            }

            // Form data is valid, proceed with form submission
            return true;
        }
    </script>
</head>
<body>
<main>
    <h1>Hawkworks Drone App - Sign In</h1>  
</main>
<form method="post" action="login.php" onsubmit="return handleFormSubmission()">
    <p>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </p>
    <p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </p>
    <p>
        <input type="submit" value="Sign In">
    </p>
</form>
<p>
    <a href="newuser.php">Create New User</a>
</p>
</body>
</html>
