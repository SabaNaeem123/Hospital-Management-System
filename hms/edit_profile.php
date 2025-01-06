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

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET full_name='$full_name', email='$email', phone='$phone', address='$address', password='$hashed_password', medical_history='$medical_history' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: manage_patients.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
</head>
<body>

<form method="POST" action="edit_patient.php" id="form" style="width: 100%; max-width: 600px; margin: 5em auto; padding: 25px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; position: absolute; right:31%; ">
    <h2 style="text-align: center; margin-top: 5px; color: #f37021;">Edit Patient Details</h2>

    <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="full_name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $patient['full_name']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Email Address:</label>
        <input type="email" name="email" value="<?php echo $patient['email']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="phone" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo $patient['phone']; ?>" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="address" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Address:</label>
        <input type="text" name="address" value="<?php echo $patient['address']; ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Password:</label>
        <input type="password" name="password" value="<?php echo $patient['password']; ?>" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
    </div>

    <div class="form-group" style="margin-bottom: 20px;">
        <label for="medical_history" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Medical History:</label>
        <textarea name="medical_history" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?php echo $patient['medical_history']; ?></textarea>
    </div>

    <button type="submit" style="display: block; position:relative; width: 100%; padding: 10px 20px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; margin: 1.5em; transition: background 0.3s ease-in-out;">
        Save Changes
    </button>
</form>


</body>
</html>

<?php
$conn->close();
?>
