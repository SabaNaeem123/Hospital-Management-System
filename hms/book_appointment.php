<?php
session_start();
include 'db.php'; // Database connection

if (isset($_POST["add"])) {
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_SESSION['id']; // Replace with actual patient id from session or input
    $time_range = explode('|', $_POST['time_range']);
    
    $start_time = $time_range[0];
    $end_time = $time_range[1];
    
    // Extracting the appointment date from the time range
    $appointment_details = explode(' ', $time_range[0]); // Assuming the first element contains the date
    $appointment_date = $appointment_details[0]; // Fetching the date part
    
    // Check for available sub-slots
    $sql_check = "SELECT *
    FROM doctor_daily_sub_availability
    WHERE main_slot_id = (SELECT id FROM doctor_daily_main_availability 
                           WHERE available_date = '$appointment_date' 
                           AND doctor_id = '$doctor_id' 
                           AND start_time <= '$start_time' 
                           AND end_time >= '$start_time')
    AND status = 'available';";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $sub_slot = $result_check->fetch_assoc();
        $sub_slot_id = $sub_slot['id'];
        $sub_start_time = $sub_slot['start_time']; // Start time from sub slot
        $sub_end_time = $sub_slot['end_time']; // End time from sub slot


        // Update the status of the sub-slot to 'booked'
        $sql_update = "UPDATE doctor_daily_sub_availability SET status = 'booked' WHERE id = '$sub_slot_id'";
        $conn->query($sql_update);

        // Insert into appointments table
        $sql_insert = "INSERT INTO appointments (doctor_id, patient_id, appointment_date, start_time, end_time, status) VALUES ('$doctor_id', '$patient_id', '$appointment_date', '$sub_start_time', '$sub_end_time', 'booked')";
        
        if ($conn->query($sql_insert) === TRUE) {
              // Check if all corresponding sub-slots are booked
              $main_slot_id = $sub_slot['main_slot_id']; // Get the main slot ID from the booked sub slot
              $sql_check_main = "SELECT COUNT(*) AS booked_count FROM doctor_daily_sub_availability WHERE main_slot_id = '$main_slot_id' AND status = 'booked'";
              $result_main = $conn->query($sql_check_main);
              $row_main = $result_main->fetch_assoc();
              $booked_count = $row_main['booked_count'];
  
              // Count total sub-slots for the main slot
              $sql_total_count = "SELECT COUNT(*) AS total_count FROM doctor_daily_sub_availability WHERE main_slot_id = '$main_slot_id'";
              $result_total = $conn->query($sql_total_count);
              $row_total = $result_total->fetch_assoc();
              $total_count = $row_total['total_count'];
  
              // If all sub-slots are booked, update the main slot status to 'booked'
              if ($booked_count === $total_count) {
                  $sql_update_main = "UPDATE doctor_daily_main_availability SET status = 'booked' WHERE id = '$main_slot_id'";
                  $conn->query($sql_update_main);
              }
            // Include the appointment date and time in the success alert
            echo "<script>alert('Appointment booked successfully on $appointment_date from $sub_start_time to $sub_end_time!'); window.location.href='book_appointment_form.php';</script>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Selected time slot is not available. Please choose another slot.'); window.location.href='book_appointment_form.php';</script>";
    }
}
?>
