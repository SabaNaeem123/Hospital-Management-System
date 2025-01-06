<?php 
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header('Location: admin_page.php');
    } else {
        echo "<div style='background-color: rgba(255, 87, 34, 0.2); padding: 20px; border-radius: 10px; width: 300px; margin: 20px auto; text-align: center; font-family: Arial, sans-serif;'>
            <p style='color: #D32F2F; font-size: 16px; margin-bottom: 10px;'>Invalid Email or Password</p>
            <a href='admin_login.php' style='display: inline-block; padding: 10px 20px; background-color: #D32F2F; color: #FFFFFF; text-decoration: none; border-radius: 8px; font-weight: bold;'>
                Try Again
            </a>
          </div>";
    }
}
?>
