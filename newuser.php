<?php
// Establish database connection (replace placeholders with actual connection details)
$servername = "Camdens-MBP";
$username = "camden";
$password = "Viterbo-2024";
$dbname = "userdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['newfirst'];
    $lastName = $_POST['newlast'];
    $studentID = $_POST['newstid'];
    $phoneNumber = $_POST['newphone'];
    $email = $_POST['newemail'];
    $password = $_POST['newpassword'];
    $confirmPassword = $_POST['newpasswordcnfm'];
    
    // Perform basic validation
    if (empty($firstName) || empty($lastName) || empty($studentID) || empty($phoneNumber) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
    } elseif ($password != $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user data into the database
        $sql = "INSERT INTO users (first_name, last_name, student_id, phone_number, email, password) VALUES ('$firstName', '$lastName', '$studentID', '$phoneNumber', '$email', '$hashedPassword')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hawkworks Drone App - New User Registration</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>
<main>
    <h1>Hawkworks Drone App - New User Registration</h1>  
</main>
<form method="post" action="register.php">
    <p>
        <label for="newfirst">First Name:</label>
        <input type="text" id="newfirst" name="newfirst" required>
    </p>
    <p>
        <label for="newlast">Last Name:</label>
        <input type="text" id="newlast" name="newlast" required>
    </p>
    <p>
        <label for="newstid">Student ID:</label>
        <input type="text" id="newstid" name="newstid" required>
    </p>
    <p>
        <label for="newphone">Phone Number:</label>
        <input type="text" id="newphone" name="newphone" required>
    </p>
    <p>
        <label for="newemail">Email:</label>
        <input type="email" id="newemail" name="newemail" required>
    </p>
    <p>
        <label for="newpassword">Password:</label>
        <input type="password" id="newpassword" name="newpassword" required>
    </p>
    <p>
        <label for="newpasswordcnfm">Re-enter Password:</label>
        <input type="password" id="newpasswordcnfm" name="newpasswordcnfm" required>
    </p>
    <p>
        <input type="submit" value="Submit">
    </p>
</form>
</body>
</html>
