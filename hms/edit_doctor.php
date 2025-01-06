<?php 
include('db.php');

$doctor = null; // Initialize doctor as null

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the doctor's current data
    $sql = "SELECT * FROM doctors WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
    } else {
        echo "Doctor not found.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update doctor details
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $address = $_POST['address'];
    $years_of_experience = $_POST['years_of_experience'];
    $medical_license_number = $_POST['medical_license_number'];
    $education = $_POST['education'];
    $consultation_hours = $_POST['consultation_hours'];
    $bio = $_POST['bio'];
    $social_media = $_POST['social_media'];

    // Prepare the update query without the password initially
    $sql = "UPDATE doctors SET name='$name', email='$email', phone='$phone', specialization='$specialization', 
            address='$address', years_of_experience='$years_of_experience', 
            medical_license_number='$medical_license_number', education='$education', 
            consultation_hours='$consultation_hours', bio='$bio', social_media='$social_media'";

    // If the user provided a new password, hash it and add it to the update query
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password='$hashed_password'";
    }

    // Complete the query with the WHERE clause
    $sql .= " WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Updated successfully!'); window.location='manage_doctor.php';</script>";
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Doctor</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon"/>
</head>
<body>
<?php include 'admin_home.php'; ?>

<?php if ($doctor): // Only show the form if a doctor record was found ?>
<form method="POST" action="edit_doctor.php" id="form" style="width: 100%; max-width: 850px; margin: 1em 20em; background-color: rgba(255, 255, 255, 0.5); border: 1px solid #ddd; border-radius: 8px; padding-bottom: 50px;">
    <h2 style="text-align: left;  background-color: rgb(195, 26, 10); color: white; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 6px 20px;">Edit Doctor <i style="margin-left: 22em;"class='fas fa-edit'></i></h2>

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($doctor['id']); ?>">

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin: 40px 20px 1px 20px;">
        <div style="flex: 1; min-width: 300px;">
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($doctor['email']); ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter new password" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
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
                <input type="text" id="medical_license_number" name="medical_license_number" placeholder="Medical License Number" value="<?php echo htmlspecialchars($doctor['medical_license_number']); ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="education" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Education and Certifications:</label>
                <textarea id="education" name="education" placeholder="Education and Certifications" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo htmlspecialchars($doctor['education']); ?></textarea>
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
        <label for="social_media" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Social Media Links:</label>
        <textarea id="social_media" name="social_media" placeholder="Enter your social media profile link (e.g., https://www.linkedin.com/in/username)" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo htmlspecialchars($doctor['social_media']); ?></textarea>
    </div>
    <p style=" position:absolute; right: 27em; top: 41em; width: 5%; padding: 6px 13px;background: #666666; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        <a style= "text-decoration: none; color: white;" href="manage_doctor.php">Cancel</a></p>
    <button type="submit" style=" position:absolute; right: 25.5em; top: 55.25em; width: 8%; padding: 10px 5px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        Update Profile</button>
</form>
<?php endif; ?>

</body>
</html>
