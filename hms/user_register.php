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
    <title>User Registration</title>
</head>
<body style= "overflow-x: hidden; font-family: 'Poppins', sans-serif;">
    <img src="assets/img/image.png" alt="image" style="position:absolute; width: 100%; height: 132vh;  z-index: -1;">
    <div style="position: absolute; width: 80%;">
        <img src="assets/img/image1.png" alt="Hospital Image 1" style="width: 250px; height: 350px; border: 3px solid lightgray; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); margin-top: 9em; margin-left: 8em;">
        <img src="assets/img/image2.png" alt="Hospital Image 2" style="width: 250px; height: 350px; border: 3px solid lightgray; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); margin-bottom: -8em; margin-left: 1em;">
       
</div>
<!-- <div style="text-align: center; padding: 20px;">
    <img src="hospital-logo.jpg" alt="Dr. Ziauddin Hospital Logo" style="width: 50%; margin: 0 auto; display: block;">
</div> -->

<form action="register_user.php" method="POST" id="form" style="width: 100%; max-width: 550px; margin: 5px auto; padding: 15px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; position: absolute; right:1%; z-index:2;">
    <h2 style="text-align: center; margin-top: 5px; color: #f37021;">User Registration</h2>

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

    <input type="hidden" name="registered_by" value="user" style="display: none;"> <!-- Hidden field -->

    <button type="submit" style="display: block; position:relative; width: 100%; padding: 10px 20px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 1em; transition: background 0.3s ease-in-out;">
        Register User
    </button>
    <p style="margin-top: 15px;">Already registered? <a href="user_login.php" style= "text-decoration: none; color: #f37021">Login here</a>.</p>
</form>
        
    </div>
    <script src="assets/js/regex.js"></script>
</body>
</html>
