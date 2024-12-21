<?php
 // Ensure this is writable
session_start();


$host = "localhost";
$username = "root";
$password = "";
$database = "testing";
$conn = new mysqli($host, $username, $password, $database);

// Ensure database connection works
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $usn = trim($_POST['usn']);
    $password = trim($_POST['password']); 
      // Regex pattern for USN validation
      $usn_pattern = "/^SG\d{2}BCA[0-9]{3}$/";

      // Validate USN format
      if (!preg_match($usn_pattern, $usn)) {
          die("Invalid USN format. It must be in the format SGxxBCAxxx, where x is a letter or digit.");
      }// Trim to remove any extra spaces

    if (empty($usn) || empty($password)) {
        die("USN and Password are required.");
    }

    // Prepare SQL query
    $query = "SELECT * FROM demo WHERE usn = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $usn); // Bind the USN parameter
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Debugging output
            //echo "Stored password: " . $user['password'] . "<br>";
           // echo "Entered password: " . $password . "<br>";

            // Plaintext or hashed password comparison
            //if ($password == $user['password'])
           /* if (password_verify($password, $user['password'])) { // Replace with `password_verify` if hashed
                echo "Login successful! Redirecting...";
                $_SESSION['user'] = $user; // Store user data in session
                header("Location: home.php");
                exit();
            } */
           // if (password_verify($password, $user['password']))
            if ($password == $user['password']) {
                echo "Login successful! Redirecting...";
                $_SESSION['user'] = $user;
               // Store user data in session
                header("Location: homeacc.html");
                exit();
            }else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with this USN.";
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    if ($stmt) {
        $stmt->close(); // Close statement
    }
}
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="logdemo.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    </head>
    <!--<body>
        
        <div class="body">
            <div id="header">
                <img id="logo" src="sblogo.jpeg">
                <h2 id="text"><b> Sharanbasva University</b></h2>
                <div id="list">
                   
                        <a class="link" href="home.html">HOME</a>
                        <div class="co">
                        <a class="link" href="res.html">COURSES</a>
                    </div>
                     
                       
                        <a class="link" href="about.html">ABOUT US</a>
                        <a class="link" href="contact.html">CONTACT</a>
                </div>
                  
                </div>
             
            </div>
            <h2>Welocme to Sharnbasva university</h2>
            <br>
            <h1>BCA CO-ED</h1>
        </div>
        <!DOCTYPE html>
<html lang="en">
<head>-->
    

  
<body>
    <header>
    <img id="logo" src="sblogo.jpeg"><h1 id="j"> Welcome to Sharanbasva University</h1>
    </header>
    <p id="bca">BCA CO-ED</p>
    <div class="head">
    <div class="box">
   
        
        <form action="log1.php" method="POST">
            <input type="hidden" name="access_key" value="b1b6a83b-4f61-4871-b7f6-bd3f8b93ccc0">
            <h2>Login</h2>
             <input class= "input" id="text"type="text" name="usn" placeholder="Enter USN" >
        <i class="fa-solid fa-user"></i>
      
         <br>
        <input class= "input" id="pass" name="password" type="password" placeholder="Enter password">
        
        <i  class="fa-solid fa-lock"></i>
        <box-icon type='solid' name='lock-alt'></box-icon> 
        <br>
        <input  class="rem"type="checkbox">Remember me 
        
        
        <br>
        <button id="btn" name="login"type="submit">Login</button>
        <br>

        <p class="reg">Don't have an account?</p>
        <br>
        <a  class="reg" href="reg.php">Sign in</a>
            

        </form>
    
    </div>
</div>
<div class="footer">
    <p>Made with <i id="f"class="fa-solid fa-heart"></i> by Taibaz Khanam</p>
</div>
   <!--  <div class="box">
     <div class="team" id="class">
        <img class="img"src="class.jpeg">
        <p class="head">Classrooms</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, obcaecati? Placeat quam eveniet, explicabo nesciunt error non similique eos consectetur nihil molestiae in impedit? Error obcaecati maiores cum ex vitae.</p>
     </div>
     <div class="team" id="play">
        <img class="img"src="img.jpeg">
        <p class="head">Playground</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia repellendus omnis blanditiis ullam inventore, impedit quam aspernatur! Impedit ab possimus, explicabo iure dolor harum, nulla earum esse aspernatur, sit fugit.</p>
     </div>
     <div class="team" id="lab">
        <img  class="img" src="lab.jpeg">
        <p class="head">Lab</p>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis quae, cum in deleniti repellendus nulla quidem non enim dignissimos amet debitis eligendi labore quas voluptates libero. Odio ipsa debitis vitae.</p>
     </div>
     </div>
     
     <div class="footer">
        <p>Made with <i class="fa-solid fa-heart"></i> by Taibaz Khanam</p>
     </div>
        </div>
-->
    </body>
    </html>



