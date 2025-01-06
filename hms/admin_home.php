<?php ob_start();
// Start session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/admin_home.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
 <!-- favicon -->
 <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
</head>
<body>
<div class="dashboard-container">
        <div class="user-info">
            <button class="user-btn" style="background-color: rgb(234, 78, 55); color: white;">
                <i class="fas fa-user-circle"></i> 
                <?php echo $_SESSION['admin']; ?>
            </button>
            <a href="admin_logout.php" class="logout-btn">Logout</a>
    </div>


    <div class="actions">
    <h3 style="background-color: rgb(234, 78, 55);">Admin Controls</h3>
    <a href="admin_page.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin_page.php' ? 'active' : ''; ?>">Dashboard</a>
    <a href="doctor_form.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_form.php' ? 'active' : ''; ?>">Register Doctor</a>
    <a href="user_form.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'user_form.php' ? 'active' : ''; ?>">Register Patient</a>
    <a href="manage_doctor.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_doctor.php' ? 'active' : ''; ?>">Manage Doctor Details</a>
    <a href="manage_patients.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_patients.php' ? 'active' : ''; ?>">Manage  Patient Record</a>
    <a href="manage_user_site_content.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_user_site_content.php' ? 'active' : ''; ?>">Site Content Studio</a>
</div>

        
    </div>
</body>
</html>
