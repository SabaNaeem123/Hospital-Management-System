<?php
include 'db.php';

$result = $conn->query("SELECT last_cleanup_date FROM cleanup_log WHERE id = 1");
$row = $result->fetch_assoc();
$last_cleanup_date = $row['last_cleanup_date'];

$current_date = new DateTime();
$current_month = $current_date->format('Y-m');

if (substr($last_cleanup_date, 0, 7) != $current_month) {
    $conn->query("DELETE FROM doctor_daily_sub_availability WHERE available_date < CURDATE()");
    $conn->query("DELETE FROM doctor_weekly_sub_availability WHERE available_date < CURDATE()");
    $conn->query("DELETE FROM doctor_monthly_sub_availability WHERE available_date < CURDATE()");

    $conn->query("UPDATE cleanup_log SET last_cleanup_date = CURDATE() WHERE id = 1");
    echo "<script>alert('Old records cleaned up successfully for the month!');</script>";
} else {

    echo "<script>alert('Cleanup already performed for this month!');</script>";

}

$conn->close();
?>
