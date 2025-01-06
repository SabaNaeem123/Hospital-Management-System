<?php
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Include database connection
include 'db.php';

$message = ''; // Initialize the message variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- favicon -->
     <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
    <title>Register Doctor</title>
    <style></style>
</head>
<body>
<?php include 'admin_home.php'; ?>

    <!-- Display success or error message -->
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="register_doctor.php" method="POST" id="form" style="width: 100%; max-width: 600px; margin: 60px auto; padding: 30px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; position: absolute; right: 30%">
    <h2 style="text-align: center; margin-bottom: 20px; color: rgb(195, 26, 10);">Register Doctor</h2>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Full Name:</label>
        <input type="text" id="name" name="name" placeholder="Full Name" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="name-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Email Address:</label>
        <input type="email" id="email" name="email" placeholder="Email Address" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="email-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
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
        <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="Phone Number" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="phone-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="specialization" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Specialization:</label>
        <select id="specialization" name="specialization" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <option value="" selected hidden>Select Specialization</option>
        <option value="General Physician">General Physician</option>
<option value="Pediatrician">Pediatrician</option>
<option value="Dermatologist">Dermatologist</option>
<option value="Cardiologist">Cardiologist</option>
<option value="Dentist">Dentist</option>
<option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
<option value="Psychiatrist">Psychiatrist</option>
<option value="Gynecologist">Gynecologist</option>
<option value="Ophthalmologist">Eye Specialist</option>
<option value="ENT Specialist">ENT Specialist</option>
        </select>
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="address" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Address:</label>
        <input type="text" id="address" name="address" placeholder="Address" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <span id="address-error" class="error-message" style="color: red; font-size: 0.9em; display: block;"></span>
    </div>

    <input type="hidden" name="register_as" value="Doctor" style="display: none;">

    <button type="submit" id="register-btn" style="display: block; position: relative; width: 100%; padding: 10px 20px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: -2em; margin-left: 1.25em; transition: background 0.3s ease-in-out;">
        Register Doctor
    </button>
</form>


<script src="assets/js/regex.js"></script>
</body>
</html>
