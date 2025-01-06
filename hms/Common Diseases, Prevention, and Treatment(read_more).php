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
// Check if 'id' is present in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("Error: No disease ID specified.");
} else {
  $disease_id = (int)$_GET['id']; // Ensure it's an integer
  // Continue with the database query using $disease_id
}

// Prepare and execute the query
$sql = "SELECT * FROM disease WHERE disease_id = $disease_id";
$result = $conn->query($sql);

// Check if data exists for this ID
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
} else {
  echo "No data found for this disease ID.";
  exit();
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- tittle -->
    <title>Care</title>
    <!-- favicon -->
    <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- for font -->
     
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
      rel="stylesheet"
    />
    <!-- for icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css"
    />
<!-- for testimonial -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

   <!-- stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
          /* Dropdown CSS */
  .dropdown {
    position: relative;
  }

  /* Style for the dropdown menu */
  .dropdown-menu {
    display: none;
    opacity: 0;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: rgba(234, 78, 55, 0.95); /* Your theme color */
    padding: 10px 0;
    list-style: none;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 10;
    min-width: 180px;
    border-radius: 5px;
    transform: translateY(-20px); /* Start slightly above */
    transition: opacity 0.4s ease, transform 0.4s ease; /* Animation effect */
  }

  /* Animation for dropdown items */
  .dropdown-menu li {
    padding: 10px 20px;
    white-space: nowrap;
    position: relative;
  }

  .dropdown-menu li a {
    color: white;
    font-weight: 500;
    text-decoration: none;
    font-size: 16px;
    display: block;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-weight: bold;
  }
  .dropdown-menu a:hover {
    background-color: rgb(234, 78, 55);
    color: white; /* This line changes the text color to white on hover */
}
  /* Animated underline for dropdown links */
  .dropdown-menu li a::after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    left: 5px;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.8); /* White underline color */
    transition: width 0.4s ease;
  }

  /* Hover effect for dropdown links */
  .dropdown-menu li a:hover::after {
    width: 80%;
  }

  /* Keep dropdown visible on hover */
  .dropdown:hover .dropdown-menu,
  .dropdown-menu:hover {
    display: block;
    opacity: 1;
    transform: translateY(0); /* Slide into place */
  }

  /* Style for the dropdown icon */
  .dropdown-icon {
    font-size: 12px;
    margin-left: 5px;
    transition: transform 0.3s ease; /* Rotate animation */
  }

  /* Rotate icon on hover */
  .dropdown:hover .dropdown-icon {
    transform: rotate(180deg);
  }
.user-info {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  margin-bottom: 20px;
}

.user-btn,
.login-btn,
.register-btn,
.logout-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  color: #ffffff;
}
.login-btn,
.register-btn,
.logout-btn {
  cursor: pointer;
}
.user-btn {
  background-color: rgb(234, 78, 55); /* Dark Navy */
  display: flex;
  align-items: center;
  gap: 5px;
  font-weight: bolder;
  cursor: pointer;
}
.user-btn a {
  font-weight: bolder;
}
.user-btn i {
  font-size: 20px;
}

.login-btn,
.register-btn {
  background-color: #f37021; /* Orange */
  text-decoration: none;
  display: inline-block;
}

.logout-btn {
  font-weight: bolder;
  background: linear-gradient(
    280deg,
    rgb(247, 247, 247) 0%,
    rgb(226, 43, 15) 1%,
    rgb(195, 26, 10) 100%
  );
  text-decoration: none;
  display: inline-block;
}

.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltip-text {
  visibility: hidden;
  width: 130px;
  background: linear-gradient(
    180deg,
    rgba(240, 98, 80, 0.9),
    rgba(255, 150, 136, 0.9)
  ); /* Slightly darker gradient */
  color: #fff;
  text-align: center;
  padding: 8px;
  border-radius: 5px;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: 160%; /* Position below the anchor */
  left: 50%;
  margin-left: -80px; /* Center the tooltip */
  opacity: 0;
  transition: opacity 0.3s;

  /* Add a little more space and border radius for a clean look */
  font-size: 14px;
}

.tooltip:hover .tooltip-text {
  visibility: visible;
  opacity: 1;
}
.login {
  background-color: rgb(234, 78, 55);
  padding: 1px 1px;
  border-radius: 8px;
  font-weight: bolder;
}
.login button a{
  font-size: 16px;
}
#logout{
  background: linear-gradient(
    280deg,
    rgb(247, 247, 247) 0%,
    rgb(234, 78, 55) 1%,
    rgb(195, 26, 10) 100%
  ); 
}
.tooltip .tooltip-text {
  visibility: hidden;
  width: 280px;
  background: linear-gradient(180deg, rgba(240, 98, 80, 0.9), rgba(255, 150, 136, 0.9));
  color: #fff;
  text-align: center;
  padding: 15px;
  border-radius: 15px;
  position: absolute;
  z-index: 1;
  top: 2.2rem;
  left: 50%;
  margin-left: -230px;
  opacity: 0;
  transform: scale(0.8);
  transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Tooltip header styling */
.tooltip-header {
  display: flex;
  justify-content: center;
  position: relative;
  margin-bottom: 10px;
}

.tooltip-name {
  font-weight: bolder;
  font-size: 1.2rem;
  text-align: center;
}

.tooltip-close {
  position: absolute;
  right: -15px;
  top: -5px;
  font-size: 1.6rem;
  color: white;
  cursor: pointer;
  background-color: rgba(255, 255, 255, 0.4);
  border-radius: 50%;
  padding: 8px;
  transition: background-color 0.3s ease;
  margin-right: 10px;
  width: 35px;
  height: 35px;
  
  /* Flexbox for centering the cross icon */
  display: flex;
  align-items: center;
  justify-content: center;
}


.tooltip-close:hover {
  background-color: rgba(255, 255, 255, 0.2);
}

/* Show/hide tooltip with animation */
.tooltip.active .tooltip-text {
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}

/* Styling for initials circle */
.tooltip-initials {
  margin-bottom: 10px;
}

.tooltip-circle {
  display: inline-block;
  width: 40px;
  height: 40px;
  background: linear-gradient(
    280deg,
    rgb(247, 247, 247) 0%,
    rgb(234, 78, 55) 1%,
    rgb(195, 26, 10) 100%
  );
  color: white;
  font-size: 1.2rem;
  line-height: 40px;
  border-radius: 50%;
  text-align: center;
  font-weight: bold;
}

/* Styling for email */
.tooltip-email {
  font-size: 1rem;
  margin-bottom: 10px;
  color: white;
  margin-bottom: 15px;
}

/* Styling for action buttons */
.tooltip-actions {
  display: flex;
  justify-content: space-between;
}

.tooltip-btn {
  padding: 10px 35px;
  background: linear-gradient(
    280deg,
    rgb(247, 247, 247) 0%,
    rgb(234, 78, 55) 1%,
    rgb(195, 26, 10) 100%
  );
  color: rgb(234, 78, 55); /* Same orange-red theme */
  color: white;
  border: none;
  border-radius: 60px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.7s ease;
  text-decoration: none;
  display: inline-block;
  box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2); /* Adding shadow for depth */
}

.tooltip-btn:hover {
  transform: scale(1.1);
  box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.4); /* Enhance shadow on hover */
}

/* Animation for fade-in and fade-out */
@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes fadeOut {
  0% {
    opacity: 1;
    transform: scale(1);
  }
  100% {
    opacity: 0;
    transform: scale(0.8);
  }
}

.tooltip.active .tooltip-text {
  animation: fadeIn 0.3s forwards;
}

.tooltip.hide .tooltip-text {
  animation: fadeOut 0.3s forwards;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes fadeOut {
  0% {
    opacity: 1;
    transform: scale(1);
  }
  100% {
    opacity: 0;
    transform: scale(0.8);
  }
}
    </style>
  </head>
  <body>
   <!-- header -->
   <header>
      <div class="logo">
        <img src="assets/img/logo.png" alt="care Hospital Logo" />
      </div>
      <nav class="nav-links">
        <ul>
          <li><a href="index.php" class="actives home active">Home</a></li>
          <li><a href="aboutus.php" class="actives">About Us</a></li>
          <li><a href="services.php" class="actives">Services</a></li>
          <li><a href="faqs.php" class="actives">Faqs</a></li>
          <li><a href="contactus.php" class="actives">Contact Us</a></li>
          <li class="dropdown">   <a href="#" class="actives">For Patients <i class="fas fa-chevron-down dropdown-icon"></i></a>  
         <ul class="dropdown-menu">    
           <li><a href="#">Search Doctors</a></li>   
             <li><a href="#">Book Appointment</a></li>   
               <li><a href="#">Manage Appointments</a></li>  
               </ul> 
              </li>
       
        </ul>
      </nav>
 <!-- Display before_login or after_login based on user status -->
 <?php if ($loggedIn): ?> 
  <div class="login" id="after_login">
                <button class="user-btn">
                   <i class="fas fa-user-circle"></i> 
                    <?php echo htmlspecialchars($first_name); ?>
                   
                    <div class="tooltip">
    <div class="tooltip-text">
        <div class="tooltip-header">
            <p class="tooltip-name">Hi, <?php echo htmlspecialchars($_SESSION['name']); ?> </p>
            <span class="tooltip-close">&times;</span>
        </div>
        <div class="tooltip-initials">
            <span class="tooltip-circle">  <?php echo htmlspecialchars($first_letter); ?></span>
        </div>
        <p class="tooltip-email">    <?php echo htmlspecialchars($_SESSION['user']); ?></p>
        <div class="tooltip-actions">
            <a href="user_profile.php" class="tooltip-btn manage-profile" style="position: relative; left:1rem;">View Profile</a>
            <a href="logout.php" class="tooltip-btn logout" style="position: relative; right:1rem;">Logout</a>
        </div>
    </div>
</div>

                   
 </button>     
  </div>
  <script>
    //js for tooltip
document.querySelectorAll('.user-btn').forEach(button => {
  button.addEventListener('click', () => {
    const tooltip = button.querySelector('.tooltip');
    
    // Toggle tooltip visibility
    if (tooltip.classList.contains('active')) {
      tooltip.classList.remove('active');
      tooltip.classList.add('hide');
    } else {
      tooltip.classList.remove('hide');
      tooltip.classList.add('active');
    }
  });
});

// Close tooltip when the close button is clicked
document.querySelectorAll('.tooltip-close').forEach(closeBtn => {
  closeBtn.addEventListener('click', (event) => {
    event.stopPropagation(); // Prevent closing when clicking inside the tooltip
    const tooltip = closeBtn.closest('.tooltip');
    tooltip.classList.remove('active');
    tooltip.classList.add('hide');
  });
});
  </script>
      <?php else: ?>
        <div class="login">
      <button class="user-btn" >
                    <a href="user_login.php"> <i class="fas fa-user-circle"></i> 
                    <?php echo "Login"; ?>
                </a>
                   
                </button>
      </div>
      <?php endif; ?>
      <div class="hamburger" onclick="openMenu()">
        <i class="fas fa-bars"></i>
      </div>
    </header>

    <!-- Fullscreen Menu -->
    <div class="fullscreen-menu" id="fullscreenMenu">
      <span class="close-menu" onclick="closeMenu()">&times;</span>
      <ul>
      <li><a href="index.php">Home</a></li>
          <li><a href="aboutus.php" >About Us</a></li>
          <li><a href="services.php" >Services</a></li>
          <li><a href="faqs.php">Faqs</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
        <li><a href="#">Search Doctors</a></li>   
             <li><a href="#">Book Appointment</a></li>   
               <li><a href="#">Manage Appointments</a></li>   
        <li>
        <?php if ($loggedIn): ?> 
       
        <button class="user-btn" style="margin-left: 4rem;">
                    <a href="#"> <i class="fas fa-user-circle"></i> 
                    <?php echo htmlspecialchars($_SESSION['name']); ?>
                   
                </a>
                   
                </button>
                <div style="display: flex; gap:1rem; margin-top:1rem;">
                
                <a href="user_profile.php" class="logout-btn">Manage Profile</a>
                <a href="logout.php" class="logout-btn">Logout</a>
          </div>
            <?php else: ?>

                <button class="user-btn" style="margin-left: 3rem;">
                <a href="user_login.php" > <i class="fas fa-user-circle"></i> 
                    <?php echo "Login"; ?>
                </a>
                   
                </a>
                   
                </button>
   
            <?php endif; ?>
        </li>
      </ul>
    </div>

  
   

 <style>

        /* Page Container */
        .disease-details-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header Section */
        .header-section {
            background: linear-gradient(135deg, rgb(234, 78, 55), rgb(195, 26, 10));
            padding: 40px 30px;
            border-radius: 8px;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .header-section p {
            font-size: 1.5rem;
            opacity: 0.9;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            font-weight: bolder;
        }

        /* Disease Intro Section */
        .disease-intro {
            display: flex;
            gap: 40px;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            margin-bottom: 50px;
        }

        .disease-intro-title {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgb(234, 78, 55), rgb(255, 150, 120));
            color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .disease-intro-title h2 {
            font-size: 2.5rem;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            letter-spacing: 1.5px;
            line-height: 1.3;
        }

        .disease-intro-text {
            flex: 2;
        }

        .disease-intro-text p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
        }

        .disease-intro-text .intro-detail {
            margin-top: 20px;
        }
/* Responsive Design for .disease-intro */
@media (max-width: 768px) {
    .disease-intro {
        flex-direction: column; /* Stack the sections vertically on smaller screens */
        padding: 20px;
        gap: 20px;
    }

    .disease-intro-title,
    .disease-intro-text {
        width: 100%; /* Ensure both sections take full width on smaller screens */
    }

    .disease-intro-title h2 {
        font-size: 2rem;
    }

    .disease-intro-text p {
        font-size: 1rem;
    }
}
        /* Amazing Section Styling */
        .section-wrapper {
            padding: 60px 30px;
            margin-bottom: 40px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(234, 78, 55, 0.1));
            border-radius: 15px;
            border-left: 5px solid rgb(234, 78, 55);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .section-heading {
            font-size: 2.5rem;
            color: rgb(234, 78, 55);
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            text-align: left;
            position: relative;
            z-index: 1;
        }

        /* Floating Background Circles */
        .section-wrapper::before, .section-wrapper::after {
            content: '';
            position: absolute;
            background-color: rgba(234, 78, 55, 0.05);
            border-radius: 50%;
            z-index: 0;
            animation: float 10s infinite ease-in-out alternate;
        }

        .section-wrapper::before {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
        }

        .section-wrapper::after {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
        }

        /* Keyframe for Floating Background Circles */
        @keyframes float {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(20px);
            }
        }

        /* Details Section */
        .details-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .details-card {
          cursor: pointer;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            border-left: 6px solid rgb(234, 78, 55);
        }

        .details-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .details-card h3 {
            font-size: 1.6rem;
            color: rgb(234, 78, 55);
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .details-card p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.8;
        }
/* Advanced Conclusion Section */
.conclusion-section {
    padding: 60px 30px;
    background: rgb(255, 255, 255);
    border-radius: 12px;
    border-top: 6px solid rgb(234, 78, 55);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 60px;
    transition: all 0.4s ease;
    text-align: center;
}

.conclusion-section h2 {
    font-size: 2.5rem;
    color: rgb(234, 78, 55);
    font-weight: bold;
    margin-bottom: 30px;
}

.conclusion-text {
    color: #555;
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 20px;
    text-align: justify;
    max-width: 1000px;
    margin: 0 auto;
}

.conclusion-list {
    list-style: none;
    padding-left: 0;
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-top: 30px;
}

.conclusion-list li {
  margin-bottom: 2rem;
  margin-top: 1rem;
    background-color: rgb(234, 78, 55);
    color: white;
    padding: 20px;
    border-radius: 15px;
    font-size: 1.2rem;
    font-weight: 600;
    flex: 1;
    line-height: 1.6;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

/* Responsive Design for Conclusion Section */
@media (max-width: 768px) {
    .conclusion-list {
        flex-direction: column;
        gap: 15px;
    }

    .conclusion-list li {
        width: 100%;
    }
}

   
        /* Call to Action */
        .cta-section {
            background-color: rgb(234, 78, 55);
            color: white;
            padding: 50px;
            text-align: center;
            border-radius: 12px;
            margin-top: 50px;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .cta-section p {
            font-size: 1.3rem;
            margin-bottom: 30px;
        }

        .cta-button {
            background-color: white;
            color: rgb(234, 78, 55);
            padding: 15px 30px;
            border-radius: 30px;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .cta-button:hover {
            background-color: rgba(255, 255, 255, 0.8);
            color: rgb(195, 26, 10);
        }

  
    </style>
</head>
<body>
    <div class="disease-details-page">
        <!-- Header Section -->
        <header class="header-section">
            <p>A comprehensive guide on the prevention, symptoms, and treatment of <?php echo htmlspecialchars($row['disease_name']); ?>.</p>
        </header>

        <!-- Disease Intro Section with Two Parts -->
        <section class="disease-intro">
            <div class="disease-intro-title">
                <h2 style="font-family: 'Nunito', sans-serif; " style="font-weight: bolder;"><?php echo htmlspecialchars($row['intro_title']); ?></h2>
            </div>
            <div class="disease-intro-text">
               <p><?php echo htmlspecialchars($row['intro_text1']); ?>.</p>
                <p class="intro-detail"><?php echo htmlspecialchars($row['intro_text2']); ?></p>
            </div>
        </section>

        <!-- Symptoms Section -->
        <div class="section-wrapper">
            <h2 class="section-heading">Symptoms</h2>
            <section class="details-wrapper">
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['symptom1_title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['symptom1_detail']); ?></p>
                </div>
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['symptom2_title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['symptom2_detail']); ?>.</p>
                </div>
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['symptom3_title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['symptom3_detail']); ?></p>
                </div>
            </section>
        </div>

        <!-- Prevention Section -->
        <div class="section-wrapper">
            <h2 class="section-heading">Prevention</h2>
            <section class="details-wrapper">
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['prevention1_title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['prevention1_detail']); ?></p>
                </div>
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['prevention2_title']); ?>
                    </h3>
                    <p><?php echo htmlspecialchars($row['prevention2_detail']); ?></p>
                </div>
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['prevention3_title']); ?>
                    </h3>
                    <p><?php echo htmlspecialchars($row['prevention3_detail']); ?></p>
                </div>
            </section>
        </div>

        <!-- Treatment Section -->
        <div class="section-wrapper">
            <h2 class="section-heading">Treatment</h2>
            <section class="details-wrapper">
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['treatment1_title']); ?></h3>
                    <p>Insulin is essential for people with type 1 diabetes and may be necessary for those with advanced type 2 diabetes.</p>
                </div>
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['treatment2_title']); ?></h3>
                    <p>For people with type 2 diabetes, oral medications can help regulate blood sugar and reduce the need for insulin therapy.</p>
                </div>
                <div class="details-card">
                    <h3><?php echo htmlspecialchars($row['treatment3_title']); ?></h3>
                    <p>Managing diabetes through diet and lifestyle choices remains a crucial aspect of treatment, supporting blood sugar control.</p>
                </div>
            </section>
        </div>

<!-- Conclusion Section -->
<section class="conclusion-section">
    <h2 class="conclusion-heading">Concluding Insights : <?php echo htmlspecialchars($row['conclusion_heading']); ?></h2>
    <p class="conclusion-text"><?php echo htmlspecialchars($row['conclusion_text']); ?></p>
    <ul class="conclusion-list">
        <li><?php echo htmlspecialchars($row['conclusion_point1']); ?></li>
        <li><?php echo htmlspecialchars($row['conclusion_point2']); ?></li>
        <li><?php echo htmlspecialchars($row['conclusion_point3']); ?></li>
    </ul>
    <p class="conclusion-text">Stay informed and follow medical advice. If you experience symptoms or need support, consult with a healthcare professional to develop a personalized plan that addresses your unique health needs.</p>
</section>


        <!-- Call to Action Section -->
        <section class="cta-section">
            <h2>Take Control of Your Health</h2>
            <p>Consult with our healthcare professionals to receive personalized care and diabetes management support.</p>
            <a href="/contact" class="cta-button">Book an Appointment</a>
        </section>


    </div>





   <!-- footer -->
   <footer>
      <div class="footer-content">
        <div class="company-info">
          <div class="logo-container">
            <img src="assets/img/logo.png" alt="" />
            <style>
              .logo-container img {
                max-width: 60%; /* Ensures the image does not exceed its container's width */
                height: auto; /* Maintains aspect ratio */
              }

              @media (max-width: 1023px) {
                .logo-container {
                  text-align: center; /* Centers the image for smaller screens */
                  margin-bottom: 20px;
                }
              }
            </style>
          </div>
          <p>
            "Delivering advanced technology with compassionate, personalized care for all your health needs."
          </p>
          <ul class="contact-info">
            <li><i class="fas fa-phone"></i> +2 123 654 7898</li>
            <li>
              <i class="fas fa-map-marker-alt"></i> 25/3 Milford Road, New York
            </li>
            <li><i class="fas fa-envelope"></i> info@example.com</li>
          </ul>
        </div>
        <div class="quick-links">
          <h3>Quick Links</h3>
          <ul>
            <li>
              <a href="#"><i class="bx bx-chevron-right"></i>Services</a>
            </li>
            <li>
              <a href="#"
                ><i class="bx bx-chevron-right"></i>Book Appointment</a
              >
            </li>
            <li>
              <a href="#"><i class="bx bx-chevron-right"></i>Career</a>
            </li>
            <li>
              <a href="#"><i class="bx bx-chevron-right"></i>Privacy Policy</a>
            </li>
            <li>
              <a href="#"
                ><i class="bx bx-chevron-right"></i>Terms and Cnditions</a
              >
            </li>
          </ul>
        </div>
        <div class="support-center">
          <h3>Support Center</h3>
          <ul>
            <li>
              <a href="#"><i class="bx bx-chevron-right"></i>FAQs</a>
            </li>
            <li>
              <a href="#"><i class="bx bx-chevron-right"></i>Contact Us</a>
            </li>
            <li><a href="#"><i class="bx bx-chevron-right"></i>Health Resources</a></li>
          
<li><a href="#"><i class="bx bx-chevron-right"></i>Insurance Information</a></li>
              <a href="#"><i class="bx bx-chevron-right"></i>Feedback</a>
            </li>
          </ul>
        </div>
        <div class="opening-hours" style="position: relative; bottom:30px;">
          <h3 style="width: max-content;">Opening Hours</h3>
          <p>
            Monday – Thursday <br />
            <span>10:00 am – 12:00 am</span>
          </p>
          <p>
            Friday <br />
            <span> 2:00 pm – 12:00 am </span>
          </p>
          <p>
            Saturday – Sunday <br />
            <span>12:00 am – 12:00 pm</span>
          </p>
        </div>
      </div>
      <div class="footer-bottom">
        <p>
          &copy; Copyright 2024
          <span style="color: rgb(234, 78, 55);  font-weight: bolder;">Care</span> All Rights
          Reserved.
        </p>
        <div class="footer-bottom-social">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <style>
        @media (max-width: 1124px) {
          .footer-bottom {
            display: none; /* Hide on mobile and tablet screens */
          }
        }

        @media (min-width: 1125px) {
          .footer-bottom {
            display: flex; /* Display on desktop screens */
          }
        }
      </style>
      <div class="reponsive_mode">
        <div class="footer-bottom-s">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
        <p>
          &copy; Copyright 2024
          <span style="color: rgb(234, 78, 55);  font-weight: bolder;">Care</span> All Rights
          Reserved.
        </p>
      </div>
      <style>
        @media (min-width: 1125px) {
          .reponsive_mode {
            display: none; /* Hide on desktop */
          }
        }

        @media (max-width: 1124px) {
          .reponsive_mode {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
          }

          .footer-bottom {
            display: none; /* Hide desktop footer on mobile and tablet */
          }
        }

        .footer-bottom-s {
          display: flex;
          justify-content: center;
          gap: 10px;
        }
      </style>
    </footer>
    <!-- js links -->

    <!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- swiper js for testimonial slider -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   <script src="assets/js/index.js"></script>
   
   <script>

 // Dropdown JavaScript
 document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.querySelector('.dropdown');

    dropdown.addEventListener('mouseover', function () {
      const dropdownMenu = this.querySelector('.dropdown-menu');
      dropdownMenu.style.display = 'block';

      // Add a slight delay for animation
      setTimeout(() => {
        dropdownMenu.style.opacity = '1';
        dropdownMenu.style.transform = 'translateY(0)';
      }, 10);
    });

    dropdown.addEventListener('mouseleave', function () {
      const dropdownMenu = this.querySelector('.dropdown-menu');

      // Start the fade-out and slide-up animation
      dropdownMenu.style.opacity = '0';
      dropdownMenu.style.transform = 'translateY(-20px)';

      // Hide after the transition completes
      setTimeout(() => {
        dropdownMenu.style.display = 'none';
      }, 400); // Match the transition duration (0.4s)
    });
  });

     //js for tooltip
document.querySelectorAll('.user-btn').forEach(button => {
  button.addEventListener('click', () => {
    const tooltip = button.querySelector('.tooltip');
    
    // Toggle tooltip visibility
    if (tooltip.classList.contains('active')) {
      tooltip.classList.remove('active');
      tooltip.classList.add('hide');
    } else {
      tooltip.classList.remove('hide');
      tooltip.classList.add('active');
    }
  });
});

// Close tooltip when the close button is clicked
document.querySelectorAll('.tooltip-close').forEach(closeBtn => {
  closeBtn.addEventListener('click', (event) => {
    event.stopPropagation(); // Prevent closing when clicking inside the tooltip
    const tooltip = closeBtn.closest('.tooltip');
    tooltip.classList.remove('active');
    tooltip.classList.add('hide');
  });
});
   </script>
  </body>
</html>
