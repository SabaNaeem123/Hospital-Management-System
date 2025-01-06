<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
     <!-- favicon -->
     <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
    <style>
        .role{
    display: inline-block;
    padding: 8px 25px;
    background-color: #f37021; 
    background-image: url('assets/img/fanta-texture.png'); 
    background-size: cover;
    background-position: center;
    background-blend-mode: overlay;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
    border: none; 
    font-family: 'Poppins', sans-serif;
    border-radius: 50px;
    position: relative;
    top: -2em;
    left: 2.5em;
    }
    .role a {
    text-decoration: none;
    color: #FFF;
    font-size: 1.2em;
    font-weight: bold;
}


.role a:first-child {
    border-radius: 50px;
    margin-right: 15px;
    padding: 6px;
}

.role a:last-child {
    border: 6px solid white;
    border-radius: 50px;
    padding: 6px 25px;
    margin-right: -25px;
}

.role a + a {
    margin-left: -5px; 
}

.role a:hover {
    background-color: #ff8c00;
}

.role a:hover {
    background-color: #ff8c00; 
}
    </style>
</head>
<body style= "overflow: hidden; font-family: 'Poppins', sans-serif;">
    <img src="assets/img/image.png" alt="image" style="position:absolute; width: 100%; height :100%;  z-index: -1;">
    <div style="position: absolute; width: 80%;">
        <img src="assets/img/image1.png" alt="Hospital Image 1" style="width: 250px; height: 350px; border: 3px solid lightgray; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); margin-top: 9em; margin-left: .25em;">
        <img src="assets/img/image2.png" alt="Hospital Image 2" style="width: 250px; height: 350px; border: 3px solid lightgray; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); margin-bottom: -8em; margin-right: .5em;">
        <img src="assets/img/image3.png" alt="Hospital Image 3" style="width: 250px; height: 350px; border: 3px solid lightgray; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); margin-top: -2.5em; margin-left: 32em;">
</div>
    <div class="login-container">
    <div class="role">
            <a href="user_login.php">As patient</a>
            <a href="doctor_login.php">As Doctor</a>
        </div>
        <h2>Doctor Login</h2>
        <form action="doctor_dashboard.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
