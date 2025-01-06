<?php
include 'db.php'; // Database connection

if (isset($_GET['specialization'])) {
    $specialization = $_GET['specialization'];
    $sql = "SELECT id, name FROM doctors WHERE specialization = '$specialization'";
    $result = $conn->query($sql);
    
    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
    echo json_encode($doctors);
}
?>
