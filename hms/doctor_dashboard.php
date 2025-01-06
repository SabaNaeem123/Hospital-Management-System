
<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain password entered by the user

    $query = "SELECT * FROM doctors WHERE email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Verify the password using password_verify
    if (password_verify($password, $row['password'])) {
        $_SESSION['doctor'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['doctor_id'] = $row['id'];
        header('Location: doctor_page.php');
        exit();
    } else {
        echo "<div style='background-color: rgba(255, 87, 34, 0.2); padding: 20px; border-radius: 10px; width: 300px; margin: 20px auto; text-align: center; font-family: Arial, sans-serif;'>
        <p style='color: #D32F2F; font-size: 16px; margin-bottom: 10px;'>Invalid Email or Password</p>
        <a href='doctor_login.php' style='display: inline-block; padding: 10px 20px; background-color: #D32F2F; color: #FFFFFF; text-decoration: none; border-radius: 8px; font-weight: bold;'>Try Again</a>
        </div>";
    }
} else {
    echo "<div style='background-color: rgba(255, 87, 34, 0.2); padding: 20px; border-radius: 10px; width: 300px; margin: 20px auto; text-align: center; font-family: Arial, sans-serif;'>
    <p style='color: #D32F2F; font-size: 16px; margin-bottom: 10px;'>Invalid Email or Password</p>
    <a href='doctor_login.php' style='display: inline-block; padding: 10px 20px; background-color: #D32F2F; color: #FFFFFF; text-decoration: none; border-radius: 8px; font-weight: bold;'>Try Again</a>
    </div>";
}
}
?>

