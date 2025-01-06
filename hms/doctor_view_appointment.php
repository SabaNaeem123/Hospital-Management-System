<?php
include('db.php');
ob_start();
// Start session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['doctor'])) {
    header('Location: doctor_login.php');
    exit();
}


$doctor_id = $_SESSION['doctor_id'];

// Fetch appointments for the logged-in doctor
$sql = "SELECT a.id, a.appointment_date, a.start_time, a.end_time, a.status, u.full_name, u.phone
        FROM appointments a
        JOIN users u ON a.patient_id = u.id
        WHERE a.doctor_id = '$doctor_id'
        ORDER BY a.appointment_date, a.start_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="assets/css/table.css?v=1.0">
</head>
<body>
<style>
    a{
        cursor: pointer;
    }
    .actions a.active {
    color: rgb(234, 78, 55); /* Orange for active link */
    font-weight: bold;
    border-bottom: 2px solid rgb(234, 78, 55);; /* Optional underline to highlight the active link */
        }
        .actions a:hover {
    color: rgb(234, 78, 55); 
        }
        .action{
       display: flex;
       gap: 10px;
        }
</style>
<?php include 'doctor_home.php'; ?>

<h2>Your Appointments</h2>

<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Patient Name</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Time Slot</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): 
           $counter = 1;
            ?>
            
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                   
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['start_time'] . ' - ' . $row['end_time']; ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                    <td>
                        <div class="action">
                            <a class="btn edit-btn" href="doctor_edit_appointment.php?id=<?php echo $row['id']; ?>" class="btn"><i class='fas fa-edit'></i>Edit</a>
                            <a class="btn delete-btn" onclick="confirmCancel(<?php echo $row['id']; ?>)"><i class='fas fa-trash'></i> Cancel</a>
                        </div>
                        
                    </td>
                </tr>
                <?php  $counter++;?>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No appointments found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
    function confirmCancel(appointmentId) {
        if (confirm("Are you sure you want to cancel this appointment?")) {
            // Redirect to cancel appointment script
            window.location.href = "doctor_cancel_appointment.php?id=" + appointmentId;
        }
    }
    
</script>

</body>
</html>
