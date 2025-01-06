<?php
include 'db.php';

$message = "";
$confirm_password_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $address = $_POST['address'];
    $register_as = 'Doctor';  

    // Check if passwords match
    if ($password !== $confirm_password) {
        $confirm_password_error = "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert doctor data into the database
        $query = "INSERT INTO doctors (name, email, password, phone, specialization, address, register_as) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $name, $email, $hashed_password, $phone, $specialization, $address, $register_as);

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            echo "<script>alert('Doctor registered successfully!'); window.location='admin_page.php';</script>";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>