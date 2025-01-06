<?php
session_start();
include 'db.php'; // Database connection

if (!isset($_SESSION['id'])) {
    header("Location: user_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    // Update the appointment status to 'canceled'
    $sql = "UPDATE appointments SET status = 'canceled by patient' WHERE id = '$appointment_id' AND patient_id = '{$_SESSION['id']}'"; // Ensure it’s the correct patient

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Appointment canceled successfully!'); window.location.href='patient_view_appointment.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "<script>alert('Invalid appointment ID.'); window.location.href='patient_view_appointment.php';</script>";
}
?>
