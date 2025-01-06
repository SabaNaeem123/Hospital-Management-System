<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
     <!-- favicon -->
     <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1; 
}
    </style>
</head>
<body>
    <img src="assets/img/login-background.jpg" alt="">
    <h1>Welcome, Admin! <br> Log In to Manage the Hospital.</h1>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="admin_dashboard.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
