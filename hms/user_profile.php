<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    echo "You need to log in to update your profile.";
    header('Location: user_login.php');
    exit();
}

$email = $_SESSION['user']; // Get the email from the session

// Query the database for user information
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- FontAwesome for icons -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            max-width: 850px;
            margin: 20px 20em;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
        }

        .profile-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 40px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f78b2d, #e02a2a);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 50px;
            color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            margin-left: 30px;
        }

        .profile-name h2 {
            margin: 0;
            font-size: 28px;
            color: rgb(195, 26, 10);
            font-weight: bold;
        }

        .profile-name p {
            margin: 8px 0 0;
            font-size: 18px;
            color: #666;
        }

        .profile-section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .profile-field {
            flex: 1;
            min-width: 350px;
            margin: 10px;
            background-color: rgba(196, 164, 132),0.1;
            border-radius: 10px;
            padding: 15px;
            color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        .profile-field:hover {
            transform: translateY(-10px);
        }

        .profile-field p {
            margin: 12px 0;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        .profile-field strong {
            color: black;
            font-weight: bold;
            margin-right: 10px;
            font-size: 16px;
        }

        /* General Button Styling */
        button {
            background: linear-gradient(45deg, #F37021, #D32F2F);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 6em; /* Add some margin for spacing */
            display: inline-block; /* Allow margin adjustments */
        }

        button:hover {
            background-color: rgb(195, 26, 10);
        }

        #user-btn {
            display: none;
        }

        /* Profile container responsive */
        @media screen and (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-name {
                margin-left: 0;
                margin-top: 20px;
            }

            .profile-section {
                flex-direction: column;
                align-items: center;
            }

            .profile-field {
                width: 100%;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-image">
                <i class="fa fa-user"></i> <!-- Profile Icon using FontAwesome -->
            </div>
            <div class="profile-name">
                <h2><?php echo htmlspecialchars($user['full_name']); ?></h2>
                <p>@<?php echo htmlspecialchars($_SESSION['user']); ?></p>
            </div>
        </div>

        <div class="profile-section">
            <div class="profile-field">
                <p><strong>Email:</strong> <?php echo !empty($user['email']) ? htmlspecialchars($user['email']) : 'Not inserted'; ?></p>
                <p><strong>Phone:</strong> <?php echo !empty($user['phone']) ? htmlspecialchars($user['phone']) : 'Not inserted'; ?></p>
            </div>
            <div class="profile-field">
                <p><strong>Medical History:</strong> <?php echo !empty($user['medical_history']) ? nl2br(htmlspecialchars($user['medical_history'])) : 'Not inserted'; ?></p>
                <p><strong>Address:</strong> <?php echo !empty($user['address']) ? htmlspecialchars($user['address']) : 'Not inserted'; ?></p>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <button onclick="location.href='user_edit.php'"><i class="fas fa-edit edit-icon"></i> Edit Profile</button>
    </div>
</body>
</html>
