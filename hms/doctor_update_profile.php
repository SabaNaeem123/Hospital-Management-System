<?php
session_start();
include 'db.php';

// Ensure the doctor is logged in
if (!isset($_SESSION['doctor_id'])) {
    header('Location: doctor_login.php');
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

// Fetch doctor's current data
$query = "SELECT * FROM doctors WHERE id = $doctor_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $doctor = mysqli_fetch_assoc($result);
} else {
    echo "Doctor not found";
    exit();
}

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; // New password (if provided)
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $address = $_POST['address'];
    $years_of_experience = $_POST['years_of_experience'];
    $medical_license_number = $_POST['medical_license_number'];
    $education = $_POST['education'];
    $consultation_hours = $_POST['consultation_hours'];
    $bio = $_POST['bio'];
    $social_media = $_POST['social_media'];

    // Initialize the update query without password update
    $update_query = "UPDATE doctors SET email='$email', phone='$phone', specialization='$specialization', 
                     address='$address', years_of_experience='$years_of_experience', 
                     medical_license_number='$medical_license_number', education='$education', 
                     consultation_hours='$consultation_hours', bio='$bio', social_media='$social_media'";

    // Check if a new password was provided
    if (!empty($password)) {
        // Hash the new password and add it to the update query
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query .= ", password='$hashed_password'";
    }

    // Complete the query with the WHERE clause
    $update_query .= " WHERE id=$doctor_id";

    // Execute the update query
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profile Updated successfully!'); window.location='doctor_page.php';</script>";
        exit;
    } else {
        echo "Error updating profile: " . mysqli_error($conn);  // Output any SQL error
    }
}
?>
<!-- The HTML form remains the same -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="assets/css/admin_home.css">
      <!-- for icons -->
      <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="assets/css/">
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
<?php include 'doctor_home.php'; ?>
<form method="POST" action="doctor_update_profile.php" id="form" style="width: 100%; max-width: 850px; margin: 1em 20em; background-color: rgba(255, 255, 255, 0.5); border: 1px solid #ddd; border-radius: 8px; padding-bottom: 65px;">
    <h2 style="text-align: left;  background-color: rgb(195, 26, 10); color: white; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 6px 20px; ">Update Profile <i style="margin-left: 20.5em;"class='fas fa-edit'></i></h2>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin: 40px 20px 1px 20px;">
        <div style="flex: 1; min-width: 300px;">
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" readonly style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($doctor['email']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Password</label>
            <input type="password" id="password" name="password" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($doctor['phone']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="specialization" style="display: block; margin-top: 2.25em; margin-bottom: 5px; font-weight: bold; color: #424141;">Specialization:</label>
                <input type="text" id="specialization" name="specialization" value="<?php echo htmlspecialchars($doctor['specialization']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="flex: 1; min-width: 300px;">
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="address" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($doctor['address']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="years_of_experience" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Years of Experience:</label>
                <input type="number" id="years_of_experience" name="years_of_experience" value="<?php echo htmlspecialchars($doctor['years_of_experience']); ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="medical_license_number" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Medical License Number:</label>
                <input type="text" id="medical_license_number" name="medical_license_number" placeholder="Medical License Number"  value="<?php echo htmlspecialchars($doctor['medical_license_number']); ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="education" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Education and Certifications:</label>
                <textarea id="education" name="education"  placeholder="Education and Certifications" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo htmlspecialchars($doctor['education']); ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="consultation_hours" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Consultation Hours:</label>
                <input type="text" id="consultation_hours" name="consultation_hours" placeholder="Consultation Hours" value="<?php echo htmlspecialchars($doctor['consultation_hours']); ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>
    </div>

    <div class="form-group" style="margin: 2px 20px;">
        <label for="bio" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Biography:</label>
        <textarea id="bio" name="bio" placeholder="Write a short biography about yourself..." style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo htmlspecialchars($doctor['bio']); ?></textarea>
    </div>

    <div class="form-group" style="margin: 15px 20px;">
        <label for="social_media" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Social Media Links :</label>
        <input type="url" id="social_media" name="social_media" placeholder="Enter your social media profile link (e.g., https://www.linkedin.com/in/username)" value="<?php echo htmlspecialchars($doctor['social_media']); ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <p style=" position:absolute; right: 27em; top: 41em; width: 5%; padding: 6px 13px;background: #666666; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        <a style= "text-decoration: none; color: white;" href="doctor_page.php">Cancel</a></p>
    <button type="submit" style=" position:absolute; right: 25.5em; top: 55.25em; width: 8%; padding: 10px 5px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        Update Profile</button>
    
</form>

</body>
</html>
