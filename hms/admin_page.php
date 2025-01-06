<?php
session_start();
$loggedIn = isset($_SESSION['user']);
if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
  $first_letter = substr($_SESSION['name'], 0, 1);
  $fullName = $_SESSION['name'];

  // Extract the first word
  $first_name = strtok($fullName, ' ');
  
} else {
  // Handle the case where the session variable is not set or is empty
  $first_letter = '';
}
// Include database connection
include 'db.php';
// Prepare and execute the query
$sql = "SELECT * FROM disease ORDER BY disease_id DESC LIMIT 3";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css?v=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php include 'admin_home.php'; ?>
    <!-- Main Content -->
  <div class="main-content">
    <!-- Notifications Section -->
    <div class="notification-container card">
      <h2>Notifications</h2>
      <div id="notifications" style="color: white;">
        <div class="notification-item">
          <p>New appointment scheduled with Dr. Smith</p>
          <button class="close-btns" onclick="removeNotification(this)">×</button>
        </div>
        <div class="notification-item" style="background-color:#d95e1b">
          <p>Emergency patient admitted</p>
          <button class="close-btns" onclick="removeNotification(this)">×</button>
        </div>
        <div class="notification-item">
          <p>Lab report for John Doe is ready</p>
          <button class="close-btns" onclick="removeNotification(this)">×</button>
        </div>
        <!-- New Notification -->
        <div class="notification-item" style="background-color:#d95e1b">
          <p>Scheduled system maintenance at midnight</p>
          <button class="close-btns" onclick="removeNotification(this)">×</button>
        </div>
      </div>
      <div id="no-notifications" class="no-notifications" style="display: none;">
        No notifications
      </div>
    </div>

    <!-- Graph Section -->
    <div class="graph-container">
      <div class="graph">
        <canvas id="appointmentsChart"></canvas>
      </div>
      <div class="graph">
        <canvas id="patientGrowthChart"></canvas>
      </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-container">
      <div class="stat-card">
        <h3>120</h3>
        <p>New Patients</p>
      </div>
      <div class="stat-card">
        <h3>85%</h3>
        <p>Bed Occupancy</p>
      </div>
      <div class="stat-card">
        <h3>15</h3>
        <p>Doctors on Duty</p>
      </div>
    </div>

    <!-- Tasks Overview Section -->
    <div class="task-container card">
      <h2>Task Overview</h2>
      <div class="task-card">
        <h3>Task 1</h3>
        <p>Review pending appointments for approval.</p>
      </div>
      <div class="task-card">
        <h3>Task 2</h3>
        <p>Update patient medical records in the system.</p>
      </div>
      <div class="task-card">
        <h3>Task 3</h3>
        <p>Prepare weekly hospital performance report.</p>
      </div>
    </div>
  </div>

  <!-- Chart.js Scripts -->
  <script>
    // Appointments Chart
    const appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
    const appointmentsChart = new Chart(appointmentsCtx, {
      type: 'line',
      data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [{
          label: 'Appointments',
          data: [20, 35, 25, 40, 50, 30, 45],
          backgroundColor: 'rgba(234, 78, 55, 0.2)',
          borderColor: 'rgb(234, 78, 55)',
          borderWidth: 2
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Patient Growth Chart
    const patientGrowthCtx = document.getElementById('patientGrowthChart').getContext('2d');
    const patientGrowthChart = new Chart(patientGrowthCtx, {
      type: 'bar',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
          label: 'New Patients',
          data: [50, 75, 60, 90, 120, 100, 130],
          backgroundColor: 'rgba(217, 94, 27, 0.2)',
          borderColor: '#d95e1b',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Remove notification function
    function removeNotification(element) {
      const notifications = document.getElementById('notifications');
      const noNotifications = document.getElementById('no-notifications');

      // Remove the notification item
      element.parentElement.style.display = 'none';

      // Check if all notifications are removed
      const visibleNotifications = notifications.querySelectorAll('.notification-item');
      const visibleCount = Array.from(visibleNotifications).filter(
        (item) => item.style.display !== 'none'
      ).length;

      // If no notifications are left, show "No notifications" text
      if (visibleCount === 0) {
        noNotifications.style.display = 'block';
      }
    }
  </script>
</body>

</html>