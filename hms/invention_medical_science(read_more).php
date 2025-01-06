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
  


<div class="container">
    <!-- Overview Box that holds both content and image -->
    <div class="overview-box">
        <!-- Content Section (left side) -->
        <section class="content-section">
            <h2>Overview</h2>
            <div class="intro-box" style="background-color:  rgba(234, 78, 55, 0.05);">
            <p class="highlight-text">
    Robotic surgical systems are revolutionizing modern surgery, providing unparalleled precision and control for complex procedures. 
    This technology allows for more delicate surgeries with fewer risks, offering surgeons enhanced 3D vision and real-time control. 
    Patients benefit from faster recovery times and less post-surgical discomfort, making it a groundbreaking innovation in healthcare.
</p>

            </div>
           
        </section>

        <!-- Main Image Section (right side) -->
        <div class="main-image-section">
            <img src="assets/img/invention1.jpg" alt="Robotic Surgery Image">
            <div class="main-image-overlay">Robotic Surgical Systems</div>
        </div>
    </div>


<style>
    .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

       
       

        /* Content Section */
        .content-section {
            background-color: white;
            border-radius: 15px;
            padding: 50px;
            margin-bottom: 50px;
            transition: transform 0.4s ease;
            position: relative;
        }

        .content-section:hover {
            transform: translateY(-5px);
        }

        .content-section h2 {
            color: rgb(234, 78, 55);
            font-size: 2.4rem;
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
/* Highlight Box */
.intro-box {
    padding: 25px;
    background: rgba(234, 78, 55, 0.05);
    border-left: 6px solid rgb(234, 78, 55);
    border-radius: 12px;
    font-weight: 600;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    animation: slideIn 1s ease-out;
}

.highlight-text {
    font-size: 1.6rem;
    font-weight: 600;
    color: rgb(234, 78, 55);
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

        .content-section p {
            color: #555;
            font-size: 1.3rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .content-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: white;
            border-radius: 12px 0 0 12px;
        }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Overview Box */
    .overview-box {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        gap: 30px;
        background-color: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s ease;
        margin-bottom: 50px;
        height: max-content;
    }

    .overview-box:hover {
        transform: translateY(-5px);
    }

    /* Content Section */
    .content-section {
        flex: 1; /* Make the content section flexible */
        padding-right: 20px;
        transition: transform 0.4s ease;
        position: relative;
    }

    .content-section h2 {
        color: rgb(234, 78, 55);
        font-size: 2.4rem;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .intro-box {
        padding: 25px;
        background: rgba(234, 78, 55, 0.07);
        border-left: 6px solid rgb(234, 78, 55);
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        animation: slideIn 1s ease-out;
    }

    .highlight-text {
        font-size: 1.6rem;
        font-weight: 600;
        color: rgb(234, 78, 55);
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .content-section p {
        color: #555;
        font-size: 1.3rem;
        line-height: 1.8;
        margin-bottom: 30px;
    }

 
    /* Main Image Section */
    .main-image-section {
        flex: 1;
        position: relative;
        width: 100%;
        height: 600px;
        margin-bottom: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .main-image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Overlay Heading */
    .main-image-overlay {
        position: absolute;
        bottom: 20px;
        left: 10px;
        right: 10px;
        color: white;
        font-size: 2.4rem;
        font-weight: bold;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        z-index: 10;
        width: max-content;
    }

    @media (max-width: 992px) {
        .overview-box {
            flex-direction: column;
        }

        .main-image-section {
            height: 300px;
        }
    }

</style>

      <section class="overview-section circle_section" style="background-color: white;">
    <div class="overview-header" >
        <h2 class="overview-title">Revolutionizing Surgery with Robotic Systems</h2>
        <p class="overview-subtitle">Discover how robotic surgical systems are transforming complex surgeries into safer and more precise procedures.</p>
    </div>

    <div class="overview-content">
        <div class="overview-text">
            <h3 class="main-highlight">The Next Frontier in Precision Surgery</h3>
            <p>Robotic surgical systems bring an unprecedented level of precision and control, allowing surgeons to perform complex operations with enhanced accuracy. The surgeon operates the robotic arms, which mimic the surgeon’s movements with high precision, while the system provides real-time imaging to guide every step of the procedure.</p>
        </div>

        <div class="key-statistics">
            <div class="statistic-box">
                <h4>95%</h4>
                <p>Success rate in reducing complications in robotic surgeries compared to traditional methods.</p>
            </div>
            <div class="statistic-box">
                <h4>50%</h4>
                <p>Decrease in post-operative recovery times, leading to faster patient recovery and shorter hospital stays.</p>
            </div>
            <div class="statistic-box">
                <h4>90%</h4>
                <p>Improved patient satisfaction due to minimally invasive techniques and quicker recovery.</p>
            </div>
        </div>

        <div class="highlighted-feature">
            <h3>Minimally Invasive and Precision-Driven</h3>
            <p>Robotic systems have redefined the concept of minimally invasive surgery, offering unmatched precision and control that reduces the need for large incisions, thereby minimizing trauma to the body. This allows for shorter recovery periods, lower risks of infection, and better patient outcomes overall.</p>
        </div>
    </div>
</section>

<style>
/* Section Styling */
.overview-section {
    padding: 90px 60px;
    background-color: white; /* Apply complete white background */
    border-radius: 20px;
    text-align: center;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Title Styling */
.overview-header {
    margin-bottom: 60px;
}

.overview-title {
    font-size: 3.8rem;
    color: rgb(234, 78, 55);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.overview-subtitle {
    font-size: 1.6rem;
    color: #666;
    line-height: 1.8;
    margin-bottom: 60px;
}

/* Main Content Section */
.overview-content {
    padding: 0 40px;
    position: relative;
    z-index: 2;
}

/* Highlighted Text Section */
.main-highlight {
    font-size: 2.4rem;
    color: rgb(234, 78, 55);
    font-weight: 600;
    margin-bottom: 30px;
    letter-spacing: 1.5px;
}

.overview-text p {
    font-size: 1.4rem;
    color: #555;
    line-height: 1.8;
    margin-bottom: 60px;
}

/* Key Statistics Styling */
.key-statistics {
    display: flex;
    justify-content: space-around;
    gap: 30px;
    margin-bottom: 70px;
    position: relative;
    z-index: 2;
}

.statistic-box {
    background: white; /* Adjust to white */
    border-radius: 20px;
    padding: 40px;
    width: 280px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.statistic-box:hover {
    transform: translateY(-12px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.statistic-box::before {
    content: '';
    position: absolute;
    background: rgba(234, 78, 55, 0.05);
    border-radius: 50%;
    width: 200px;
    height: 200px;
    top: -60px;
    left: -60px;
    z-index: 0;
    animation: float 12s infinite ease-in-out;
}

.statistic-box h4 {
    font-size: 4rem;
    color: rgb(234, 78, 55);
    font-weight: bold;
    margin-bottom: 15px;
    z-index: 1;
    position: relative;
}

.statistic-box p {
    font-size: 1.3rem;
    color: #666;
    line-height: 1.6;
    z-index: 1;
    position: relative;
}

/* Highlighted Feature Section */
.highlighted-feature {
    background:rgba(234, 78, 55, 0.05);
    padding: 50px;
    border-radius: 25px;
    position: relative;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    margin-bottom: 80px;
}

.highlighted-feature h3 {
    font-size: 2.2rem;
    color: rgb(234, 78, 55);
    margin-bottom: 20px;
    text-transform: uppercase;
}

.highlighted-feature p {
    font-size: 1.4rem;
    color: #555;
    line-height: 1.8;
}

/* Floating Animation */
@keyframes float {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(20px);
    }
}

/* Responsive Design */
@media (max-width: 992px) {
    .key-statistics {
        flex-direction: column;
        align-items: center;
        gap: 40px;
    }

    .statistic-box {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .overview-title {
        font-size: 2.8rem;
    }

    .overview-subtitle {
        font-size: 1.4rem;
    }

    .main-highlight {
        font-size: 2rem;
    }

    .key-statistics {
        flex-direction: column;
        gap: 30px;
    }

    .statistic-box {
        padding: 30px;
    }
}
.circle_section::before{
  
            content: '';
            position: absolute;
            top: -120px;
            right: -120px;
            width: 350px;
            height: 350px;
            background-color: rgba(234, 78, 55, 0.05);
            border-radius: 50%;
            z-index: 0;
            animation: float 12s infinite ease-in-out;
  
}
</style>

<section class="overview-section key_section">
    <div class="overview-header">
        <h2 class="overview-title">KEY FEATURES</h2>
        <p class="overview-subtitle">How Robotic Surgical Systems are transforming the world of surgery.</p>
    </div>
    
    <div class="overview-grid">
        <!-- Timeline Step 1 -->
        <div class="timeline-step">
            <div class="circle-marker"></div>
            <div class="content-box">
                <h3>Introduction to Robotic Surgery</h3>
                <p>Robotic surgery is leading the future of medical procedures by offering surgeons greater precision, flexibility, and control.</p>
            </div>
        </div>

        <!-- Timeline Step 2 -->
        <div class="timeline-step">
            <div class="circle-marker"></div>
            <div class="content-box">
                <h3>Minimally Invasive Techniques</h3>
                <p>Patients benefit from smaller incisions, less pain, and quicker recoveries thanks to minimally invasive robotic-assisted surgeries.</p>
            </div>
        </div>

        <!-- Timeline Step 3 -->
        <div class="timeline-step">
            <div class="circle-marker"></div>
            <div class="content-box">
                <h3>Advanced Precision</h3>
                <p>The fine motor skills provided by robotic systems allow surgeons to perform complex procedures with exceptional accuracy.</p>
            </div>
        </div>

        <!-- Timeline Step 4 -->
        <div class="timeline-step">
            <div class="circle-marker"></div>
            <div class="content-box">
                <h3>Future of Surgery</h3>
                <p>The future holds exciting possibilities as robotic surgery systems continue to evolve, integrating AI and autonomous features.</p>
            </div>
        </div>

        
    </div>
    <style>
     /* Overview Section */
.overview-section {
    padding: 60px 40px;
    background-color:white;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    margin-bottom: 70px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

/* Header Styling */
.overview-header {
    text-align: center;
    margin-bottom: 50px;
}

.overview-title {
    font-size: 3rem;
    color: rgb(234, 78, 55);
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}

.overview-subtitle {
    font-size: 1.5rem;
    color: #666;
    line-height: 1.6;
    margin-top: 15px;
}

/* Timeline Grid */
.overview-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    position: relative;
}

/* Timeline Step Styling */
.timeline-step {
    position: relative;
    text-align: center;
    padding: 20px;
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.timeline-step:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

/* Circle Marker */
.circle-marker {
    width: 30px;
    height: 30px;
    background-color: rgb(234, 78, 55);
    border-radius: 50%;
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 5px 15px rgba(234, 78, 55, 0.3);
}

/* Content Box */
.content-box h3 {
    color: rgb(234, 78, 55);
    font-size: 1.8rem;
    margin-bottom: 15px;
}

.content-box p {
    font-size: 1.2rem;
    color: #666;
    line-height: 1.7;
    padding: 0 15px;
}



/* Floating Animation */
@keyframes float {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(20px);
    }
}

/* Responsive Design */
@media (max-width: 992px) {
    .overview-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .overview-grid {
        grid-template-columns: 1fr;
    }
}
    </style>
</section>

        <!-- Benefits Section -->
        <section class="benefits-section">
            <div class="benefits-content">
                <h2>Benefits for Patients</h2>
                <ul class="benefits-list">
                    <li>Faster recovery times</li>
                    <li>Reduced risk of infection</li>
                    <li>Minimal scarring and post-surgical discomfort</li>
                    <li>Enhanced surgical precision</li>
                    <li>Shorter hospital stays</li>
                </ul>
            </div>
        </section>
<style>
   /* Benefits Section */
   .benefits-section {
            background-color: white;
            padding: 60px;
            border-radius: 15px;
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .benefits-section::before {
            content: '';
            position: absolute;
            top: -120px;
            right: -120px;
            width: 300px;
            height: 300px;
            background-color: rgba(234, 78, 55, 0.05);
            border-radius: 50%;
            z-index: 0;
            animation: float 12s infinite ease-in-out;
        }

        .benefits-content {
            position: relative;
            z-index: 1;
        }

        .benefits-content h2 {
            color: rgb(234, 78, 55);
            font-size: 2.4rem;
            margin-bottom: 25px;
        }

        .benefits-list {
            list-style: none;
            padding-left: 0;
        }

        .benefits-list li {
            margin-bottom: 15px;
            font-size: 1.3rem;
            color: #333;
        }

        .benefits-list li::before {
            content: "✓";
            color: rgb(234, 78, 55);
            font-size: 1.5rem;
            margin-right: 10px;
        }

  
</style>
        <!-- Future Impact Section -->
 <section class="future-impact-section">
    <h2 class="future-impact-title">Future Impact</h2>
    <div class="future-impact-content">
        <p class="future-impact-text">
            As robotic surgical systems continue to advance, they have the potential to revolutionize more areas of healthcare, particularly in complex and high-risk procedures. 
            <span class="highlight-text">With improved AI integration</span>, these systems could enable autonomous surgeries, real-time decision-making, and enhanced patient outcomes across a broader spectrum of medical fields.
        </p>
        <ul class="impact-list">
            <li><i class="fas fa-robot"></i> Autonomous surgeries with AI integration</li>
            <li><i class="fas fa-heartbeat"></i> Real-time decision-making in critical surgeries</li>
            <li><i class="fas fa-stethoscope"></i> Enhanced patient outcomes and safety</li>
        </ul>
    </div>
</section>

<style>
/* Enhanced Future Impact Section */
.future-impact-section {
    padding: 90px 60px;
  background-color: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
    position: relative;
    text-align: center;
    overflow: hidden;
}

/* Title Styling */
.future-impact-title {
    font-size: 3rem;
    color: rgb(234, 78, 55);
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 40px;
    position: relative;
    letter-spacing: 1.8px;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
}

/* Content Styling */
.future-impact-content {
    position: relative;
    z-index: 2;
}

.future-impact-text {
    font-size: 1.5rem;
    color: #555;
    line-height: 1.8;
    margin-bottom: 40px;
    text-align: justify;
    font-weight: 500;
}

.highlight-text {
    color: rgb(234, 78, 55);
    font-weight: bold;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    font-size: 1.6rem;
}

/* Impact List */
.impact-list {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: space-around;
    gap: 20px;
    flex-wrap: wrap;
    z-index: 2;
    position: relative;
}

.impact-list li {
    font-size: 1.4rem;
    color: #666;
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    background: rgba(234, 78, 55, 0.05);
    padding: 20px;
    border-radius: 12px;
    width: 300px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.impact-list li i {
    font-size: 2rem;
    color: rgb(234, 78, 55);
    margin-right: 10px;
}

.impact-list li:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

/* Floating Circles */
.future-impact-section::before, .future-impact-section::after {
    content: '';
    position: absolute;
    border-radius: 50%;
background-color: rgba(234, 78, 55, 0.05);
    animation: float 10s infinite ease-in-out;
}

.future-impact-section::before {
    width: 350px;
    height: 350px;
    top: -150px;
    left: -150px;
}

.future-impact-section::after {
    width: 250px;
    height: 250px;
    bottom: -150px;
    right: -100px;
}


/* Floating Animation */
@keyframes float {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(20px);
    }
}

/* Responsive Design */
@media (max-width: 992px) {
    .impact-list {
        flex-direction: column;
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .future-impact-title {
        font-size: 2.4rem;
    }

    .future-impact-text {
        font-size: 1.3rem;
    }

    .impact-list li {
        width: 100%;
        padding: 15px;
    }
}
/* Floating Circles for Overview Section */
.key_section::before, .key_section::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background-color: rgba(234, 78, 55, 0.05);
    animation: float 10s infinite ease-in-out;
}

.key_section::before {
    width: 350px;
    height: 350px;
    top: -150px;
    left: -150px;
}

.key_section::after {
    width: 250px;
    height: 250px;
    bottom: -150px;
    right: -100px;
}

/* Section Styling */
.overview-section {
    padding: 90px 60px;
    background-color: white;
    border-radius: 20px;
    text-align: center;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}
.contact::before {
    content: '';
    position: absolute;
    border-radius: 50%;
    background-color: rgba(234, 78, 55, 0.05);
    width: 350px;
    height: 350px;
    top: -150px;
    right: -150px;
    animation: float 10s infinite ease-in-out;
}

/* Section Styling */
.overview-section {
    padding: 90px 60px;
    background-color: white;
    border-radius: 20px;
    text-align: center;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Floating Animation */
@keyframes float {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(20px);
    }
}

</style>



  <!-- Call to Action Section -->
  <section class="cta-section">
            <h2>Take Control of Your Health</h2>
            <p>Consult with our healthcare professionals to receive personalized care and health management support.</p>
            <a href="/contact" class="cta-button">Book an Appointment</a>
        </section>
        <style>
          
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

//js for diseases section
document.querySelectorAll(".read-more-btn").forEach((button) => {
  button.addEventListener("click", () => {
    window.location.href =
      "Common Diseases, Prevention, and Treatment(read_more).php"; // Link to a separate page for all diseases
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
