<?php
session_start();
include 'db.php'; // Database connection
include 'doctor_home.php'; // Include sidebar for navigation

if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

// Helper function to create 30-minute time slots
function generateTimeSlots($start_time, $end_time) {
    $slots = [];
    $start = strtotime($start_time);
    $end = strtotime($end_time);

    while (($start + 1800) <= $end) { // 1800 seconds = 30 minutes
        $slot_start = date("H:i:s", $start);
        $slot_end = date("H:i:s", strtotime('+30 minutes', $start));
        $slots[] = ['start_time' => $slot_start, 'end_time' => $slot_end];
        $start = strtotime($slot_end);
    }

    return $slots;
}

// Handle form submissions for daily availability
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['daily'])) {
    $available_date = $_POST['available_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Insert the main availability slot
    $sql_main = "INSERT INTO doctor_daily_main_availability (doctor_id, available_date, start_time, end_time, status)
                 VALUES ('$doctor_id', '$available_date', '$start_time', '$end_time', 'available')";
    $conn->query($sql_main);

    // Get the ID of the main slot for reference in sub-slots
    $main_slot_id = $conn->insert_id;

    // Generate 30-minute sub-slots
    $sub_slots = generateTimeSlots($start_time, $end_time);
    foreach ($sub_slots as $slot) {
        $slot_start = $slot['start_time'];
        $slot_end = $slot['end_time'];
        $sql_sub = "INSERT INTO doctor_daily_sub_availability (main_slot_id, doctor_id, available_date, start_time, end_time, status)
                    VALUES ('$main_slot_id', '$doctor_id', '$available_date', '$slot_start', '$slot_end', 'available')";
        $conn->query($sql_sub);
    }
    
    echo "<script>alert('Daily availability slots added successfully!');</script>";
}

// Handle form submissions for weekly availability
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['weekly'])) {
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $slots = generateTimeSlots($start_time, $end_time);

    // Insert a main slot for the specified day of the week
    $sql_main = "INSERT INTO doctor_weekly_main_availability (doctor_id, day_of_week, start_time, end_time, status)
                 VALUES ('$doctor_id', '$day_of_week', '$start_time', '$end_time', 'available')";
    $conn->query($sql_main);

    // Get the ID of the main slot for reference in sub-slots
    $main_slot_id = $conn->insert_id;

    // Calculate the date for the next occurrence of the specified day of the week
    $current_date = new DateTime();
    while ($current_date->format('l') !== $day_of_week) {
        $current_date->modify('+1 day');
    }
    $available_date = $current_date->format('Y-m-d');

    // Insert each 30-minute sub-slot for this specific week
    foreach ($slots as $slot) {
        $slot_start = $slot['start_time'];
        $slot_end = $slot['end_time'];
        $sql_sub = "INSERT INTO doctor_weekly_sub_availability (main_slot_id, doctor_id, available_date, start_time, end_time, status)
                    VALUES ('$main_slot_id', '$doctor_id', '$available_date', '$slot_start', '$slot_end', 'available')";
        $conn->query($sql_sub);
    }

    echo "<script>alert('Weekly availability slots added successfully!');</script>";
}

// Handle form submissions for monthly availability
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['monthly'])) {
    $week_of_month = $_POST['week_of_month'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $slots = generateTimeSlots($start_time, $end_time);

    // Insert a main slot for the specified week and day of the month
    $sql_main = "INSERT INTO doctor_monthly_main_availability (doctor_id, week_of_month, day_of_week, start_time, end_time, status)
                 VALUES ('$doctor_id', '$week_of_month', '$day_of_week', '$start_time', '$end_time', 'available')";
    $conn->query($sql_main);

    // Get the ID of the main slot for reference in sub-slots
    $main_slot_id = $conn->insert_id;

    // Insert each 30-minute sub-slot for this specific month
    foreach ($slots as $slot) {
        $slot_start = $slot['start_time'];
        $slot_end = $slot['end_time'];
        $sql_sub = "INSERT INTO doctor_monthly_sub_availability (main_slot_id, doctor_id, week_of_month, day_of_week, start_time, end_time, status)
                    VALUES ('$main_slot_id', '$doctor_id', '$week_of_month', '$day_of_week', '$slot_start', '$slot_end', 'available')";
        $conn->query($sql_sub);
    }

    echo "<script>alert('Monthly availability slots added successfully!');</script>";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <title>Add Availability</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Add Availability</title>
    <style>
        body {
            
  font-family: "Archivo Narrow", sans-serif;
            background-color: white;
            color: #333;
            padding-top: 20px;
            display: flex;
            justify-content: center;
        }
     
     
        /* Tab styling */
        .tab-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            cursor: pointer;
            border-bottom: 2px solid #ddd;
        }
        .tab {
            padding: 12px 20px;
            font-weight: bold;
            color: #555;
            transition: color 0.3s, border-bottom 0.3s;
            border-bottom: 3px solid transparent;
        }
    .tab.active {
            color: rgb(234, 78, 55);
            border-bottom: 3px solid rgb(234, 78, 55);
            border-left: 5px solid rgb(234, 78, 55);
          
         
        }

        /* Smooth transition effect for form cards */
        .form-card {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            opacity: 0;
            transform: scale(0.98);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .form-card.active {
            display: block;
            opacity: 1;
            transform: scale(1);
        }

        /* Form label and input styling */
        label {
            font-weight: 500;
            color: #444;
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
            color: #333;
            transition: border-color 0.3s;
        }
        input:focus, select:focus {
            border-color: rgb(234, 78, 55);
            outline: none;
        }

        .content {
    width: 100%;
    max-width: 800px;
    margin-left: 200px; /* Adjust based on sidebar width */
    margin-right: 140px;
    padding: 25px;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-top: 70px;
}

/* Enhanced Styling for title */
h2 {
    text-align: center;
    color: rgb(234, 78, 55);
    font-size: 3rem;
    margin-bottom: 30px;
    font-weight: 800;
    font-style: italic;
}

/* Rounded Tab styling with icons */
.tab-container {
    display: flex;
    justify-content: space-around;
    margin-bottom: 30px;
    cursor: pointer;
    position: relative;
}

.tab {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    border-radius: 25px;
    background-color: #f0f2f5;
    color: #555;
    font-weight: bold;
    font-size: 1.1em;
    transition: all 0.3s ease;
    position: relative;
    min-width: 130px;
    color: rgb(234, 78, 55);
            border-bottom: 3px solid rgb(234, 78, 55);
           
}



.tab:hover {
    transform: translateY(-5px);
    background-color: #f5f5f5;
    transition: background-color 0.4s, transform 0.3s ease-out;
}

.tab i {
    margin-right: 8px;
    font-size: 1.2em;
}

/* Animated underline effect for tabs */
.tab-container::after {
    content: '';
    display: block;
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    width: 0;
    background-color: #EA4E37;
    transition: width 0.5s ease, left 0.5s ease;
}

.tab.active ~ .tab-container::after {
    width: 100%;
    left: 0;
}

/* Modern Card Style for forms */
.form-card {
    display: none;
    padding: 25px;
    border-radius: 15px;
    background: #fafafa;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    transform: translateY(20px);
    transition: all 0.6s ease;
}

.form-card.active {
    display: block;
    transform: translateY(0);
    animation: fadeInSlideUp 0.8s ease both;
}

@keyframes fadeInSlideUp {
    0% {
        opacity: 0;
        transform: translateY(30px) scale(0.97);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Floating Labels for inputs */
.form-card label {
    position: relative;
    font-size: 0.9em;
    color: #777;
    transition: all 0.3s ease;
    pointer-events: none;
    transform-origin: left top;
    margin-bottom: 10px;
    margin-top: 25px;
}

input, select {
    width: 100%;
    padding: 12px 12px 12px 10px;
    margin-bottom: 25px;
    border: none;
    border-bottom: 2px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    color: #333;
    background-color: #f8f8f8;
    transition: border-color 0.3s, background-color 0.3s;
    outline: none;
    cursor: pointer;
}

input:focus, select:focus {
    border-color: #EA4E37;
    background-color: #fff;
    outline: none;
}

input:focus + label, select:focus + label {
    color: #EA4E37;
    transform: translateY(-22px) scale(0.85);
}

/* Dividers and Section Highlights */
.form-card .divider {
    border-bottom: 1px solid #e0e0e0;
    margin: 15px 0;
    position: relative;
}

.form-card input:hover, .form-card select:hover {
    background-color: #f111;
}
/* Enhanced Divider and Hover Effects */
.form-card .divider {
    border-bottom: 1px solid #e0e0e0;
    margin: 15px 0;
    position: relative;
    text-align: center;
}
.form-card .divider::before {
    content: "OR";
    display: inline-block;
    background-color: #fafafa;
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    padding: 0 10px;
    color: #aaa;
    font-size: 0.9em;
}

/* Hover Effects for Inputs */
.form-card input:hover, .form-card select:hover {
    background-color: #f1f1f1;
    border-color: #ddd;
}

/* Form Button with smooth hover */
.button {
    width: 30%;
    margin-top: 5px;
    margin-bottom: 25px;
    position: relative;
    left: 280px;
    padding: 16px;
    font-size: 16px;
    color: #fff;
    background: linear-gradient(
    280deg,
    rgb(247, 247, 247) 0%,
    rgb(234, 78, 55) 1%,
    rgb(195, 26, 10) 100%
  );
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.6s;
    box-shadow: 0 4px 10px rgba(234, 78, 55, 0.2);
}
.button:hover {
    background-color: #d94c3d;
    transform:scale(1.1);
}

/* Additional Form Label and Focus Styling */
label {
    font-weight: bold;
    font-size: 1rem;
    color: #858484;
    display: block;
    margin: 10px 0 5px;
    transition: color 0.3s ease;
}
input:focus + label, select:focus + label {
    color: rgb(234, 78, 55);
}
h3{
    color: #a09f9f;
}
/* Responsive Design */
@media (max-width: 768px) {
    .content {
        margin-left: 0;
        padding: 20px;
    }
    button {
        width: 100%;
        left: 0;
        margin-top: 10px;
    }
    .tab-container {
        flex-direction: column;
        align-items: center;
    }
    .tab {
        margin-bottom: 10px;
    }
}

/* Tooltip Styling for Help or Information Icons */
.tooltip {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 5px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%; /* Position above the icon */
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
/* Enhanced Dropdown (Select) Styling */
select {
    width: 100%;
    padding: 15px; /* Increased padding for comfort */
    margin-bottom: 20px;
    border: 1px solid #ddd; /* Light border color */
    border-radius: 10px; /* Rounded edges */
    background-color: #f9f9f9; /* Light background */
    color: #333; /* Text color */
    font-size: 1em; /* Font size */
    appearance: none; /* Remove default arrow */
    background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"%3E%3Cpath fill="%23EA4E37" d="M4.293 8.293a1 1 0 0 1 1.414 0L8 10.586l2.293-2.293a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 0-1.414z"/%3E%3C/svg%3E'); /* Custom arrow */
    background-repeat: no-repeat;
    background-position: right 10px center; /* Position arrow */
    background-size: 16px; /* Size of custom arrow */
    transition: border-color 0.3s, background-color 0.3s; /* Smooth transition */
    cursor: pointer;
}

/* Dropdown on focus */
select:focus {
    border-color:rgb(234, 78, 55); /* Highlight border color */
    background-color: #fff; /* Change background to white on focus */
    outline: none; /* Remove default outline */
}

/* Dropdown hover effect */
select:hover {
    background-color: #f1f1f1; /* Light background on hover */
}

/* Remove the default styling for option elements */
select option {
    padding: 10px; /* Add padding for options */

}
option:hover{
    background-color: orange;
}
/* Media Query for Responsiveness */
@media (max-width: 480px) {
    select {
        padding: 12px; /* Adjust padding for smaller screens */
    }
}
    </style>
</head>
<body>

<div class="content" style="margin-left: 20px;">
    <h2 style="
  font-family: Archivo Narrow, sans-serif;">Add Your  Availability</h2>

    <!-- Tab Navigation -->
    <div class="tab-container">
        <div class="tab active" data-target="dailyForm">Daily</div>
        <div class="tab " data-target="weeklyForm">Weekly</div>
        <div class="tab " data-target="monthlyForm">Monthly</div>
    </div>

    <!-- Form Sections -->
    <div id="dailyForm" class="form-card active">
        <h3>Set Daily Availability</h3>
        <form action="doctor_add_availability.php" method="POST">
            <label for="available_date" style="color: rgb(234,78,55);">Date:</label>
            <input type="date" name="available_date" required>
            <label for="start_time" style="color: rgb(234,78,55);">Start Time:</label>
            <input type="time" name="start_time" required>
            <label for="end_time" style="color: rgb(234,78,55);">End Time:</label>
            <input type="time" name="end_time" required>
            <button type="submit" class="button" name="daily" style="width: 30%; margin-top: 5px; margin-bottom: 25px; position: relative; left: 480px;">Add  Availability</button>
        </form>
    </div>

    <div id="weeklyForm" class="form-card">
        <h3>Set Weekly Availability</h3>
        <form action="doctor_add_availability.php" method="POST">
            <label for="day_of_week" style="color: rgb(234,78,55);">Day of the Week:</label>
            <select name="day_of_week" required>
            <option value="" selected hidden>Select</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <label for="start_time" style="color: rgb(234,78,55);">Start Time:</label>
            <input type="time" name="start_time" required>
            <label for="end_time" style="color: rgb(234,78,55);">End Time:</label>
            <input type="time" name="end_time" required>
            <button type="submit" class="button" name="weekly" style="width: 30%; margin-top: 5px; margin-bottom: 25px; position: relative; left: 480px;">Add  Availability</button>
        </form>
    </div>

    <div id="monthlyForm" class="form-card">
        <h3>Set Monthly Availability</h3>
        <form action="doctor_add_availability.php" method="POST">
            <label for="week_of_month" style="color: rgb(234,78,55);">Week of the Month:</label>
            <select name="week_of_month" required>
            <option value="" selected hidden>Select</option>
                <option value="first">First</option>
                <option value="second">Second</option>
                <option value="third">Third</option>
                <option value="fourth">Fourth</option>
                <option value="last">Last</option>
            </select>
            <label for="day_of_week" style="color: rgb(234,78,55);">Day of the Week:</label>
            <select name="day_of_week" required>
            <option value="" selected hidden>Select</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <label for="start_time" style="color: rgb(234,78,55);">Start Time:</label>
            <input type="time" name="start_time" required>
            <label for="end_time" style="color: rgb(234,78,55);">End Time:</label>
            <input type="time" name="end_time" required>
            <button type="submit" class="button" name="monthly" style="width: 30%; margin-top: 5px; margin-bottom: 25px; position: relative; left: 480px;">Add  Availability</button>
        </form>
    </div>
</div>

<script>
    // JavaScript for tab switching with smooth transition
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs and form cards
            document.querySelectorAll('.tab').forEach(item => item.classList.remove('active'));
            document.querySelectorAll('.form-card').forEach(form => form.classList.remove('active'));

            // Add active class to clicked tab and corresponding form
            this.classList.add('active');
            document.getElementById(this.getAttribute('data-target')).classList.add('active');
        });
    });
</script>


</body>
</html>