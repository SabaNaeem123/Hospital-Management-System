<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    echo "You need to log in to update your profile.";
    header('Location: user_login.php');
    exit();
}

$email = $_SESSION['user']; // Get the email from the session

// Query the database for user information
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $user_id = $user['id']; // Retrieve the user ID
    // Now you can access user data, for example:
    $name = $user['full_name'];
} else {
    echo "User not found.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $medical_history = $_POST['medical_history'];

    // Update the user's details
    $update_query = "UPDATE users SET full_name = ?, email = ?, phone = ?, address = ?, medical_history = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('sssssi', $full_name, $email, $phone, $address, $medical_history, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Record Updated successfully!'); window.location='user_profile.php';</script>";
    } else {
        echo "Error updating profile.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMK1t1d0g/wzOMC7C5h+2T/e5z1d+5w46/4E7y" crossorigin="anonymous">

</head>
<body>
<form method="POST" action="user_edit.php" id="form" style="width: 100%; max-width: 850px; margin: 1.25em 20em; background-color: rgba(255, 255, 255, 0.5); border: 1px solid #ddd; border-radius: 8px; padding-bottom: 30px;">
    <h2 style="text-align: left; background-color: rgb(195, 26, 10); color: white; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 6px 20px; margin-top: 0px;">Edit User Details <i style="margin-left: 18.5em; background-color: black;" class='fas fa-edit'></i></h2>

    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

    <div class="form-group" style="margin: 20px;">
        <label for="full_name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Email Address:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="address" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Address:</label>
        <textarea name="address" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo htmlspecialchars($user['address']); ?></textarea>
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="medical_history" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Medical History:</label>
        <textarea name="medical_history" placeholder="Medical History (if any)"style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo htmlspecialchars($user['medical_history']); ?></textarea>
    </div>

    <p style=" position:absolute; right: 38em; top: 32em; width: 5%; padding: 6px 13px;background: #666666; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        <a style= "text-decoration: none; color: white;" href="index.php">Cancel</a></p>
    <button type="submit" style=" position:absolute; right: 35em; top: 39.5em; width: 8%; padding: 10px 5px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        Update Profile</button>
</form>
</body>
</html>

