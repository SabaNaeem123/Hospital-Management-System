<?php
include 'db.php'; // Database connection

if (isset($_GET['doctor_id']) && isset($_GET['available_date']) && isset($_GET['start_time']) && isset($_GET['end_time'])) {
    $doctor_id = $_GET['doctor_id'];
    $available_date = $_GET['available_date'];
    $start_time = $_GET['start_time'];
    $end_time = $_GET['end_time'];
    
    $sub_slots = [];

    // Fetch Daily Sub Slots
    $sql_daily = "SELECT start_time, end_time, status FROM doctor_daily_sub_availability 
                  WHERE doctor_id = '$doctor_id' 
                  AND available_date = '$available_date' 
                  AND start_time >= '$start_time' 
                  AND end_time <= '$end_time'";
    $daily_result = $conn->query($sql_daily);
    while ($row = $daily_result->fetch_assoc()) {
        $sub_slots[] = [
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'status' => $row['status'],
            'type' => 'daily' // Marking the source as daily
        ];
    }
    
    // Fetch Daily Sub Slots
    $sql_daily = "SELECT start_time, end_time, status FROM doctor_weekly_sub_availability 
                  WHERE doctor_id = '$doctor_id' 
                  AND available_date = '$available_date' 
                  AND start_time >= '$start_time' 
                  AND end_time <= '$end_time'";
    $daily_result = $conn->query($sql_daily);
    while ($row = $daily_result->fetch_assoc()) {
        $sub_slots[] = [
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'status' => $row['status'],
            'type' => 'daily' // Marking the source as daily
        ];
    }


    // Fetch Weekly Sub Slots
    $sql_weekly = "SELECT start_time, end_time, status FROM doctor_weekly_sub_availability 
                   WHERE doctor_id = '$doctor_id' 
                   AND available_date = '$available_date' 
                   AND start_time >= '$start_time' 
                   AND end_time <= '$end_time'";
    $weekly_result = $conn->query($sql_weekly);
    while ($row = $weekly_result->fetch_assoc()) {
        $sub_slots[] = [
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'status' => $row['status'],
            'type' => 'weekly' // Marking the source as weekly
        ];
    }

    // Fetch Monthly Sub Slots
    $sql_monthly = "SELECT start_time, end_time, status FROM doctor_monthly_sub_availability 
                    WHERE doctor_id = '$doctor_id' 
                    AND week_of_month = (SELECT CASE 
                                                  WHEN DAY('$available_date') BETWEEN 1 AND 7 THEN 'first'
                                                  WHEN DAY('$available_date') BETWEEN 8 AND 14 THEN 'second'
                                                  WHEN DAY('$available_date') BETWEEN 15 AND 21 THEN 'third'
                                                  WHEN DAY('$available_date') BETWEEN 22 AND 28 THEN 'fourth'
                                                  ELSE 'last'
                                              END) 
                    AND day_of_week = (SELECT DAYNAME('$available_date')) 
                    AND start_time >= '$start_time' 
                    AND end_time <= '$end_time'";
                    
    $monthly_result = $conn->query($sql_monthly);
    while ($row = $monthly_result->fetch_assoc()) {
        $sub_slots[] = [
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'status' => $row['status'],
            'type' => 'monthly' // Marking the source as monthly
        ];
    }

    // Return the available sub slots as JSON
    echo json_encode($sub_slots);
}
?>
