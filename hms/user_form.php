<?php
session_start();

// Ensure the admin or doctor is logged in
if (!isset($_SESSION['admin']) && !isset($_SESSION['doctor'])) {
    header('Location: admin_login.php');  // Redirect to the relevant login if not authorized
    exit();
}

// Include database connection
include 'db.php';

// Initialize an empty message for feedback
$message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $medical_history = $_POST['medical_history'];
    $registered_by = $_POST['registered_by'];  // New field to distinguish the source
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $query = "INSERT INTO users (full_name, email, phone, dob, address medical_history, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $full_name, $email, $phone, $address, $medical_history, $hashed_password);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        if ($registered_by == 'admin') {
            header('Location: admin_home.php');  // Redirect to admin dashboard
        } else {
            header('Location: user_login.php');  // Redirect to user login page
        }
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Patient</title>
    <link rel="stylesheet" href="assets/css/adminForms.css">
     <!-- favicon -->
     <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
</head>
<body>
    <?php include 'admin_home.php'; ?>

        <!-- Display success or error message -->
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="register_user.php" method="POST" id="form" style="width: 100%; max-width: 600px; margin: 40px auto; padding: 30px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; position: absolute; right:30%;">
    <h2 style="text-align: center; margin-bottom: 20px; color: rgb(195, 26, 10);">Register Patient</h2>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Full Name:</label>
        <input type="text" id="name" name="full_name" placeholder="Full Name" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="name-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Email Address:</label>
        <input type="email" id="email" name="email" placeholder="Email" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="email-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="Phone Number" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="phone-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="address" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Address:</label>
        <input type="text" id="address" name="address" placeholder="Address" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="address-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="password-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="confirm_password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="confirm-password-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>


    <div class="form-group" style="margin-bottom: 20px;">
        <label for="medical_history" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Medical History:</label>
        <textarea id="medical_history" name="medical_history" placeholder="Medical History (if any)" rows="3" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"></textarea>
        <span id="medical_history-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <input type="hidden" name="registered_by" value="admin" style="display: none;"> <!-- Hidden field -->

    <button type="submit" style="display: block; position:relative; width: 100%; padding: 10px 20px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; margin-top:-2em; margin-left:1.25em; transition: background 0.3s ease-in-out;">
        Register User
    </button>
</form>

<script src="assets/js/regex.js"></script>
</body>
</html>
