<?php
// Include database connection
include 'db.php';

// Fetch all diseases from the database
$sql = "SELECT * FROM disease ORDER BY disease_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disease Content Controls</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
     <!-- for icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
     <title>Disease Content Control Pannel</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your existing CSS file -->
</head>
<body>
<?php include 'admin_home.php'; ?>
    <div class="main-content">
        <!-- Header Section with title and buttons -->
        <div class="header" style="margin-top: 5rem; margin-bottom: 3rem;">
            <h1>Disease Content Control Pannel</h1>
            <div class="header-buttons">
                <a href="add_disease.php" class="add-disease-btn" style="  color: rgb(234, 78, 55);"><i class="fas fa-plus"></i> Add New Disease</a>
            </div>
        </div>

        <!-- Disease Cards Container -->
        <div class="disease-cards-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = htmlspecialchars($row['disease_id']);
                    echo '
                    <div class="disease-card">
                        <h3>' . htmlspecialchars($row['disease_name']) . '</h3>
                        <p class="intro-text-preview">' . htmlspecialchars($row['conclusion_text']) . '</p>
                        <div>
                            <a href="edit_disease.php?id=' . $id . '" class="edit-btn btn"><i class="fas fa-edit"></i> Edit</a>
                            <a href="delete_disease.php?id=' . $id . '" class="delete-btn btn" onclick="return confirm(\'Are you sure you want to delete this disease?\')"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No disease records found.</p>";
            }
            ?>
        </div>
        
    </div>

    <style>
/* Styling for buttons */
.btn {
    padding: 6px 12px;
    color: white;
    text-decoration: none;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 5px; /* Space between icon and text */
   
}

/* Icon styling */
.btn i {
    margin-right: 2px; 
}

/* Edit button */
.edit-btn {
    background-color: rgb(234, 78, 55); 
}

.edit-btn:hover {
    background-color: #d95e1b; 
}

/* Delete button */
.delete-btn {
    background: linear-gradient(
        280deg,
        rgb(247, 247, 247) 0%,
        rgb(226, 43, 15) 1%,
        rgb(195, 26, 10) 100%
    );
}

.delete-btn:hover {
    background: linear-gradient(
        280deg,
        rgb(255, 255, 255) 0%,
        rgb(206, 43, 15) 1%,
        rgb(165, 26, 10) 100%
    ); 
}



        .main-content {
            margin-left: 300px; /* Adjust for side panel width */
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2.4rem;
            color: rgb(234, 78, 55); /* Primary theme color */
            margin: 0;
        }

        .header-buttons a {
            display: inline-block;
            margin-left: 15px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 600;
            color: rgb(234, 78, 55);
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .add-disease-btn {
    background: white;
    color: rgb(234, 78, 55);
    padding: 15px 30px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.4s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border: 2px solid rgb(234, 78, 55);
    position: relative;
    overflow: hidden;
}

.add-disease-btn i {
    font-size: 1.2rem;
    color: rgb(234, 78, 55);
}

.add-disease-btn::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(234, 78, 55, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 15px;
}

.add-disease-btn:hover::after {
    opacity: 1;
}

.add-disease-btn:hover {
    box-shadow: 0 8px 20px rgba(234, 78, 55, 0.2);
    transform: translateY(-2px);
    color: rgb(195, 26, 10);
}

.add-disease-btn:hover i {
    color: rgb(195, 26, 10);
}


.add-disease-btn i {
    font-size: 1.3rem;
    margin-right: 8px;
    color: rgb(234, 78, 55);
    transition: transform 0.3s ease;
}

.add-disease-btn:hover {
    background: rgba(236, 125, 108, 0.1);
    transform: scale(1.05);
    color: rgb(195, 26, 10);
    box-shadow: 0 10px 25px rgba(234, 78, 55, 0.3);
}

.add-disease-btn:hover i {
    transform: rotate(90deg);
}



.add-disease-btn:hover::before {
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50px;
}

      
        /* Disease Cards */
        .disease-cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .disease-card {
            width: calc(33% - 20px);
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .disease-card h3 {
            font-size: 1.4rem;
            color: rgb(234, 78, 55); /* Primary theme color */
            margin-bottom: 10px;
        }

        .intro-text-preview {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        /* Card Actions */
        .card-actions {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 15px;
        }

        .card-actions .edit-btn,
        .card-actions .delete-btn {
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            text-align: center;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .edit-btn {
            background-color: rgb(234, 78, 55); /* Primary theme color */
        }

        .edit-btn:hover {
            background-color: rgba(234, 78, 55, 0.8); /* Lighter primary */
        }

        .delete-btn {
            background-color: rgb(195, 26, 10); /* Secondary theme color */
        }

        .delete-btn:hover {
            background-color: rgba(195, 26, 10, 0.8); /* Lighter secondary */
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .disease-card {
                width: 100%;
            }
        }
    </style>
</body>
</html>
