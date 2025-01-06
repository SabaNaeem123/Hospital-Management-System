<?php
session_start();
include 'db.php'; // Database connection

if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

$appointment_id = $_GET['id'];

// Fetch the appointment details
$sql = "SELECT * FROM appointments WHERE id = '$appointment_id'";
$result = $conn->query($sql);
$appointment = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $appointment['doctor_id'];
    $patient_id = $appointment['patient_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

   // Update appointment details
   $sql_update = "UPDATE appointments SET start_time = '$start_time', end_time = '$end_time', status = 'reschedule by doctor' WHERE id = '$appointment_id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Appointment updated successfully!'); window.location.href='doctor_view_appointments.php';</script>";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
</head>
<body>
<?php include 'doctor_home.php'; ?>
<form method="POST" style="width: 100%; max-width: 850px; margin: 11em 20em; background-color: rgba(255, 255, 255, 0.5); border: 1px solid #ddd; border-radius: 8px; padding-bottom: 50px;">
<h2 style="text-align: left; background-color: rgb(195, 26, 10); color: white; border-top-left-radius: 8px; border-top-right-radius: 8px; padding: 6px 20px; margin-top: 0px;">Edit Appointment <i style="margin-left: 19em;" class='fas fa-edit'></i></h2>

<div class="form-group" style="margin: 20px;">
<label for="start_time" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">Start Time:</label>
    <input type="time" name="start_time" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"value="<?php echo $appointment['start_time']; ?>" required>
</div>
    
<div class="form-group" style="margin: 20px;">
<label for="end_time" style="display: block; margin-bottom: 5px; font-weight: bold; color: #424141;">End Time:</label>
    <input type="time" name="end_time" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"value="<?php echo $appointment['end_time']; ?>" required>
</div>

    <button type="submit"style=" position:absolute; right: 25.5em; top: 31.5em; width: 10%; padding: 10px 5px; background: linear-gradient(45deg, #F37021, #D32F2F); color: white; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s ease-in-out;">Update Appointment</button>
</form>

</body>
</html>
