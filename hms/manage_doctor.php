<?php
include('db.php');

// Fetch all doctors
$sql = "SELECT * FROM doctors ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Manage Doctors</title>
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

<h2 style="color: rgb(195, 26, 10);">Manage Doctors</h2>

<table>
    <tr>
        <th>S.No</th> <!-- Sequential Number Column -->
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Specialization</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        $counter = 1; // This will display a sequence starting from 1
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $counter . "</td>"; // Display sequential number
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['specialization'] . "</td>";
            echo "<td>";
            echo "<a class='btn edit-btn' href='edit_doctor.php?id=" . $row['id'] . "'><i class='fas fa-edit'></i>Edit</a> ";
            echo "<a class='btn delete-btn' href='delete_doctor.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this doctor?\")'><i class='fas fa-trash'></i>Delete</a>";
            echo "</td>";
            echo "</tr>";

            $counter++; // Increment counter for the next row
        }
    } else {
        echo "<tr><td colspan='6'>No doctors found</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
$conn->close();
?>
