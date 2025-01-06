<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $medical_history = $_POST['medical_history'];
    $password = $_POST['password'];
    $registered_by = $_POST['registered_by'];  // This distinguishes if admin or user is registering

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to include all fields
   $query = "INSERT INTO users (full_name, email, phone, address, medical_history, password, registered_by) 
          VALUES ('$full_name', '$email', '$phone', '$address', '$medical_history', '$hashed_password','$registered_by')";

    
    if (mysqli_query($conn, $query)) {
        if ($registered_by == 'admin') {
            // If admin is registering the user, stay on the admin dashboard
            echo "<script>alert('Patient registered successfully!'); window.location='admin_page.php';</script>";
        } else if ($registered_by == 'doctor') {
            // If doctor is registering the user, stay on the doctor's dashboard
            echo "<script>alert('Patient registered successfully!'); window.location='doctor_page.php';</script>";
        } else {
            // If user is registering themselves, redirect to the login page
            echo "<script>alert('Registration successful! Please log in.'); window.location='user_login.php';</script>";
        }
    }
}
?>
