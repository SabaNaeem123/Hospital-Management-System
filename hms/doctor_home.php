<?php ob_start();
// Start session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['doctor'])) {
    header('Location: doctor_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin_home.css">
     <!-- favicon -->
     <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
    <style>
        .actions a.active {
    color: rgb(234, 78, 55); /* Orange for active link */
    font-weight: bold;
    border-bottom: 2px solid rgb(234, 78, 55);; /* Optional underline to highlight the active link */
        }
        .actions a:hover {
    color: rgb(234, 78, 55); 
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
    <div class="user-info">
            <button id ="user-btn" class="user-btn" style="background-color: rgb(234, 78, 55); color: white;">
                <i class="fas fa-user-circle"></i> 
                <?php echo $_SESSION['name']; ?>
            </button>
            <a href="doctor_logout.php" class="logout-btn">Logout</a>
    </div>
    
        <div class="actions">
         <h3> Doctor Roles</h3>
         <a href="doctor_page.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_page.php' ? 'active' : ''; ?>">Dashboard</a>
    <a href="doctorUser_form.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctorUser_form.php' ? 'active' : ''; ?>">Register Patient</a>
    <a href="doctor_manage_patients.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_manage_patients.php' ? 'active' : ''; ?>">Edit Patient Record</a>
    <a href="doctor_add_availability.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_add_availability.php' ? 'active' : ''; ?>">Add Availability</a>

    <a href="doctor_view_appointment.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_view_appointment.php' ? 'active' : ''; ?>">Manage Appointments</a>
    <a href="doctor_update_profile.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_update_profile.php' ? 'active' : ''; ?>">Update Profile</a>
    <a href="doctor_view_profile.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_view_profile.php' ? 'active' : ''; ?>">View Profile</a>
         </div>
    </div>
</body>
</html>
