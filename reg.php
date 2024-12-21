<?php


session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "testing";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    /*echo "<pre>";
        print_r($_POST);
        echo "</pre>";*/
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $usn = $conn->real_escape_string($_POST['usn']);
    $password = $conn->real_escape_string($_POST['password']);
    $usn_pattern = "/^SG\d{2}BCA[0-9]{3}$/";
   // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Validate input
    if (empty($fullname) || empty($email) || empty($usn) || empty($password)) {
        die("Please fill in all the fields.");
    }
    if (!preg_match($usn_pattern, $usn)) {
        die("Invalid USN format. It must be in the format SGxxBCAxxx, where x is a letter or digit.");
    }

    // Validate password (ensure it's not empty or too short, etc.)
   /* if (empty($password)) {
        die("Password is required.");
    }*/

    // Check if email or USN already exists in the database
    $checkSQL = "SELECT * FROM demo WHERE email='$email' OR usn='$usn'";
    $result = $conn->query($checkSQL);

    if ($result->num_rows > 0) {
        die("Error: Email or USN already exists.");
    }

    // Hash the password for secure storage
   // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert the data into the database
    $sql = "INSERT INTO demo (fullname, email, usn, password) 
            VALUES ('$fullname', '$email', '$usn', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='log1.php'>Login here</a>";
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}

// Close the database connection
$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="regdemo.css">
    
   <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <header>
    <img id="logo" src="sblogo.jpeg"><h1 id="j"> Welcome to Sharanbasva University</h1>
    </header>
    <p id="bca">BCA CO-ED</p>
    <div class="head">
    <div class="box">
       
        
        <form action="reg.php" method="POST">
            <h2 id="sign">Sign Up</h2>
            <input type="hidden" name="access_key" value="b1b6a83b-4f61-4871-b7f6-bd3f8b93ccc0">
             <input class= "input" id="text"type="text" name="fullname" placeholder="Enter Fullname" >
        <i class="fa-solid fa-user"></i>
         <br>
         <input class= "input" id="text"type="text" name="email" placeholder="Enter e-mail" >
         <i class="fa-solid fa-envelope"></i>
         
          <br>
          <input class= "input" id="text"type="text" name="usn" placeholder="Enter USN" >
          <i class="fa-solid fa-user"></i>
           <br>
        <input class= "input" id="pass" name="password" type="password" placeholder="Enter password">
        
        <i  class="fa-solid fa-lock"></i>
        <br>
   
        <input  class="rem"type="checkbox">I accept all terms and conditions 
        <br>
        <button id="btn" name="signup"type="submit">SignUp</button>
        <br>
        <p id="new">Already have an account ? </p><a href="log.php">Sign in</a>



        
            

        </form>
    
    </div>
</div>
<div class="footer">
    <p>Made with <i id="f"class="fa-solid fa-heart"></i> by Taibaz Khanam</p>
</div>

    
</body>
</html>




























