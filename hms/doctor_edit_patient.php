<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the patient's current data
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        echo "Patient not found.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update patient details
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $medical_history = $_POST['medical_history'];

    // Initialize the update query without updating the password initially
    $sql = "UPDATE users SET full_name='$full_name', email='$email', phone='$phone', address='$address', medical_history='$medical_history'";

    // If a new password is provided, hash it and update the password
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password='$hashed_password'";
    }

    // Complete the query with the WHERE clause
    $sql .= " WHERE id=$id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record Updated Successfully!'); window.location='doctor_manage_patients.php';</script>";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon" />
</head>
<body>
<?php include 'doctor_home.php'; ?>

<form method="POST" action="doctor_edit_patient.php" id="form" style="width: 100%; max-width: 850px; margin: 1.25em 20em; background-color: rgba(255, 255, 255, 0.5); border: 1px solid #ddd; border-radius: 8px; padding-bottom: 50px;">
    <h2 style="text-align: left; background-color: rgb(195, 26, 10); color: white; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 6px 20px;">Edit Patient Details <i style="margin-left: 18.5em;" class='fas fa-edit'></i></h2>

    <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">

    <div class="form-group" style="margin: 20px;">
        <label for="full_name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $patient['full_name']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Email Address:</label>
        <input type="email" name="email" value="<?php echo $patient['email']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo $patient['phone']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="address" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Address:</label>
        <input type="text" name="address" value="<?php echo $patient['address']; ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Password</label>
        <input type="password" name="password" placeholder="Enter new Password" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin: 20px;">
        <label for="medical_history" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Medical History:</label>
        <textarea name="medical_history" placeholder="Medical History (if any)" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo $patient['medical_history']; ?></textarea>
    </div>

    <p style=" position:absolute; right: 27em; top: 34em; width: 5%; padding: 6px 13px;background: #666666; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        <a style= "text-decoration: none; color: white;" href="doctor_manage_patients.php">Cancel</a></p>
    <button type="submit" style=" position:absolute; right: 25.5em; top: 45.75em; width: 8%; padding: 10px 5px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">
        Update Patient</button>
</form>


</body>
</html>

<?php
$conn->close();
?>
