<?php
session_start();


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $conn = new mysqli('localhost', 'root', '', 'grading_system');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();


        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit();
        } else {
            $error = "Incorrect username or password.";
        }
    } else {
        $error = "";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRT LOGIN FORM</title>
    <link rel="stylesheet" href="login.css">
    <style>
        .error-message {
            display: none; 
            margin-top: 10px;
            color: white;
            background-color: red;
            padding: 10px;
            border-radius: 3px;
            text-align: center;
            font-size: 14px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="login-form">
        <img src="CRT2.jpg" alt="" style="height: 100px; width: 100px; position: relative; margin-bottom: -50px;"> 
        <form id="loginForm" method="POST" style="background-color: rgba(0, 123, 255, 0.822); display: flex; flex-direction: column; padding: 30px 30px; border-radius: 5px; ">
            <h2>CRT STUDENTS<br> GRADING SYSTEM</h2>
            <p>ADMIN LOGIN</p>

            <label for="username" style="font-size: 12px; color: white; padding-bottom: 5px;">Username</label>
            <input type="text" id="username" name="username" required style="padding: 5px 10px; border-radius: 3px; margin-bottom: 10px; outline: none; border: none; box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.1);">
            <label for="password" style="font-size: 12px; color: white; padding-bottom: 5px;">Password</label>
            <input type="password" id="password" name="password" required style="padding: 5px 10px; border-radius: 3px; margin-bottom: 10px; outline: none; border: none; box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.1);">
            <div class="show" style="display: flex; justify-content: center; align-items: center; text-align: center;">
                <input type="checkbox" onclick="myshow()">
                <label style="color:white;">Show password</label>
            </div>

            <button type="submit" style="padding: 8px; border: none; border-radius: 3px; color: white; background-color: rgb(38, 0, 255); font-weight: 100; font-size: 12px; cursor: pointer;">Login</button>

            <a href="view.php" style="padding: 8px 0; border: none; border-radius: 3px; text-align: center; margin-top:10px; text-decoration:none; color:black; width:100%; background-color: rgb(255, 255, 255); font-weight: 100; font-size: 12px; cursor: pointer;"> VIew Table</a>
        </form>
    </div>

    <!-- Error Message -->
    <div id="errorMessage" class="error-message" <?php if (!empty($error)) echo 'style="display: block;"'; ?>>
        <?php echo $error; ?>
    </div>

    <script>
        function myshow() {
            let passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
