<?php
include 'db.php'; // Database connection

if (isset($_GET['doctor_id'])) {
    $doctor_id = $_GET['doctor_id'];

    // Fetch available main time slots from daily, weekly, and monthly tables
    $available_slots = [];

    // Daily Availability
    $sql_daily = "SELECT available_date, start_time, end_time FROM doctor_daily_main_availability WHERE doctor_id = '$doctor_id' AND status = 'available'";
    $result_daily = $conn->query($sql_daily);
    while ($row = $result_daily->fetch_assoc()) {
        $available_slots[] = [
            'available_date' => $row['available_date'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'type' => 'daily'
        ];
    }

  
  
    echo json_encode($available_slots);
}
?>
