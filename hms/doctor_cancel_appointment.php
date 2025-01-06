<?php
session_start();
include 'db.php'; // Database connection

if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $sql = "UPDATE appointments SET status = 'canceled by doctor' WHERE id = '$appointment_id'";


    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Appointment canceled successfully!'); window.location.href='doctor_view_appointment.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "<script>alert('Invalid appointment ID.'); window.location.href='view_appointments.php';</script>";
}
?>
