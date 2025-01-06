<?php
include('db.php');

// Fetch all patients
$sql = "SELECT * FROM users ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Manage Patients</title>
    <link rel="stylesheet" href="../assets/css/admin_home.css?v=1.0">
    <link rel="stylesheet" href="assets/css/table.css?v=1.0">
    <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
</head>
<body>
<?php include 'admin_home.php'; ?>

<h2 style="color: rgb(195, 26, 10);">Manage Patients</h2>

<table>
    <tr>
        <th>S.No</th> <!-- Sequential Number Column -->
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Medical History</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        $counter = 1; // This will display a sequence starting from 1
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $counter . "</td>"; // Display sequential number
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            
            // Check if medical_history is empty and display "null" if it is
            $medical_history = !empty($row['medical_history']) ? $row['medical_history'] : "<i>NULL</i>";
            echo "<td>" . $medical_history . "</td>";
            
            echo "<td>";
            echo "<a class='btn edit-btn' href='edit_patient.php?id=" . $row['id'] . "'><i class='fas fa-edit'></i> Edit</a> ";
            echo "<a class='btn delete-btn' href='delete_patient.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this patient?\")'><i class='fas fa-trash'></i> Delete</a>";
            echo "</td>";

            echo "</tr>";

            $counter++; // Increment counter for the next row
        }
    } else {
        echo "<tr><td colspan='6'>No patients found</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
$conn->close();
?>
