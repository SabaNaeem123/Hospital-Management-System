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
background-color: rgba(255, 255, 255, 0.3);
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
  background-color: rgba(255, 255, 255, 0.5);
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
  height: 2.5rem;
  border-radius: 50px;
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
  <body style="background-color: white;">
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
            <a href="user_profile.php" class="tooltip-btn manage-profile" style="position: relative; left:1.5rem; border-radius:10px;">View Profile</a>
            <a href="logout.php" class="tooltip-btn logout" style="position: relative; right:1.5rem; border-radius:10px;">Logout</a>
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

    
    <section class="contact-header"  style="background-color: white;">
        <h1>Our Services</h1>
    
    
    <!-- <button id="button">Book an Appointment</button> -->

    <script>
      // JavaScript goes here
      document.getElementById('button').addEventListener('click', function() {
          alert('Appointment booking form will be displayed.');
          // Here you can redirect to another page or display a form/modal
          // window.location.href = 'booking-form.html'; // Example of redirecting
      });
  </script>
    <section id="services"  style="background-color: white;">
          <div class="services-container">
              <div class="service">
                  <i class="fas fa-user-md"></i>
                  <h3>Consultation</h3>
                  <p>Expert medical consultation services to guide you on your health journey.</p>
              </div>
              <div class="service">
                  <i class="fas fa-procedures"></i>
                  <h3>Emergency Care</h3>
                  <p>24/7 emergency care services to respond to your urgent medical needs.</p>
              </div>
              <div class="service">
                  <i class="fas fa-stethoscope"></i>
                  <h3>Health Checkups</h3>
                  <p>Comprehensive health checkups to monitor and maintain your well-being.</p>
              </div>
              <div class="service">
                  <i class="fas fa-syringe"></i>
                  <h3>Vaccination</h3>
                  <p>Vaccination services to protect you and your family against preventable diseases.</p>
              </div>
              <div class="service">
                  <i class="fas fa-heartbeat"></i>
                  <h3>Cardiology</h3>
                  <p>Specialized cardiology services for heart health and conditions.</p>
              </div>
              <div class="service">
                  <i class="fas fa-pills"></i>
                  <h3>Pharmacy</h3>
                  <p>On-site pharmacy for all your medication and healthcare product needs.</p>
              </div>
          </div>
      </section>
    
     
      <h1 style="background-color: white; color:rgb(234, 78, 55); text-decoration:underline; margin-bottom: 50px; margin-top:30px;"> Doctor Slots & Availability</h1>

      <h2 style="margin-top: 60px;">General Doctors</h2>
    <table>
        <thead>
            <tr>
                <th>SPECIALITY</th>
                <th>CONSULTANT'S NAME</th>
                <th>DAYS</th>
                <th>TIMINGS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gastroenterologist</td>
                <td>Prof. Dr. Hasnain Ali Shah<br>MBBS, MRCP, FRCP, M.D. (Edin.)</td>
                <td>Wed, Thu</td>
                <td>02:00 pm to 04:00 pm</td>
            </tr>
          
            <tr>
                <td>General Physician/Family Medicine</td>
                <td>Dr. Aijaz Abdul Sattar<br>MBBS, ABIM</td>
                <td>Mon, Thu</td>
                <td>03:00 pm to 05:00 pm</td>
            </tr>
            
           
            <tr>
                <td>Urologist</td>
                <td>Dr. Roshan E Sahid Rana<br>MBBS, FCPS</td>
                <td>Wed to Thu</td>
                <td>03:00 pm to 05:00 pm</td>
            </tr>
        </tbody>
    </table>
    
    
    
    <h2 style="margin-top: 60px;">Rehabilitation Services</h2>
        <table>
            <thead>
                <tr>
                    <th>SPECIALITY</th>
                    <th>CONSULTANT'S NAME</th>
                    <th>DAYS</th>
                    <th>TIMINGS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rehabilitation Services</td>
                    <td>Dr. Syed Abid Mehdi Kazmi<br>PhD-PT</td>
                    <td>Mon to Fri</td>
                    <td>02:00 pm to 04:00 pm</td>
                </tr>
                
                
                <tr>
                    <td>Rehabilitation Services</td>
                    <td>Mr. Muhammad Abid<br>MS-PT</td>
                    <td>Tue, Wed, Thu</td>
                    <td>04:00 pm to 07:00 pm</td>
                </tr>
                
            </tbody>
        </table>
    
    
    
    
        <h2 style="margin-top: 60px;">Clinical Psychology</h2>
        <table>
            <thead>
                <tr>
                    <th>SPECIALITY</th>
                    <th>CONSULTANT'S NAME</th>
                    <th>DAYS</th>
                    <th>TIMINGS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Clinical Psychology</td>
                    <td>Ms. Shumaila Atif<br>MS- Psychology</td>
                    <td>Mon, Fri</td>
                    <td>02:00 pm to 04:00 pm</td>
                </tr>
                <tr>
                    <td>Clinical Psychology</td>
                    <td>Ms. Sarah Jehangir<br>MS- Psychology</td>
                    <td>Tue</td>
                    <td>02:00 pm to 04:00 pm</td>
                </tr>
                
            </tbody>
        </table>

        <h2 style="margin-top: 60px;">Occupational Therapy Schedule</h2>
        <table>
            <tr>
                <th>Therapist</th>
                <th>Degree</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>
            <tr>
                <td>Ms. Neelum Zehra</td>
                <td>BS-OT</td>
                <td>04:00 pm - 06:00 pm</td>
                <td>04:00 pm - 06:00 pm</td>
                <td>12:00 pm - 01:00 pm</td>
                <td>02:00 pm - 04:00 pm</td>
                <td>02:00 pm - 04:00 pm</td>
                <td>09:00 am - 02:00 pm</td>
            </tr>
           
            <tr>
                <td>Ms. Sobia Haroon</td>
                <td>BS-OT</td>
                <td>04:00 pm - 05:00 pm</td>
                <td>01:00 pm - 04:00 pm</td>
                <td>09:00 am - 05:00 pm</td>
                <td>09:00 am - 05:00 pm</td>
                <td>04:00 pm - 05:00 pm</td>
                <td>09:00 am - 11:00 am</td>
            </tr>
        </table>
    
    
    
    
    

    
        <h2 style="margin-top: 60px;">Dermatology Schedule</h2>


    <table>
        <tr>
            <th>Doctor</th>
            <th>Qualifications</th>
            <th>Days</th>
            <th>Time</th>
        </tr>
        <tr>
            <td>Dr. Hina Fahd</td>
            <td>Consultant Dermatologist and Aesthetic Physician<br>MBBS (Gold Medalist), D-Derm, American Academy of Aesthetics (USA)</td>
            <td>Monday and Wednesday</td>
            <td>03:00 pm - 05:00 pm</td>
        </tr>
        
    </table>
    
    
    

    <h2 style="margin-top: 60px;">General and Bariatric Surgery Schedule</h2>
    <table>
        <tr>
            <th>Doctor</th>
            <th>Qualifications</th>
            <th>Days</th>
            <th>Time</th>
        </tr>
        <tr>
            <td>Dr. Syed Asif Ali</td>
            <td>MBBS, FCPS<br>Minimal Invasive General and Weight Loss Surgeon</td>
            <td>Monday to Friday</td>
            <td>05:30 pm - 07:00 pm</td>
        </tr>
    </table>

    <style>
      body{
        overflow-x: hidden;
        background-color: white;
      }
               /* Services Section */
               #services {
                background-color: white;
                padding: 40px 20px;
                text-align: center;
            }
            #services h2 {
                font-size: 2.5rem;
                color: rgb(234, 78, 55);
                margin-bottom: 20px;
            }
            .services-container {
                display: flex;
                flex-wrap: wrap;
                display: grid;
                grid-template-columns: repeat(3,1fr);
                justify-content: center;
                gap: 20px;
            }
            .service {
                background-color: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                width: 400px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: transform 0.2s;
                cursor: pointer;
            }
            .service:hover {
                transform: scale(1.05);
            }
            .service i {
                font-size: 40px;
                color: rgb(234, 78, 55);
            }
            .service h3 {
                font-size: 1.5rem;
                margin: 10px 0;
            }
            .service p {
                font-size: 1rem;
                color: #666;
            }
            /* Footer Styles */
            footer {
                background-color: #333;
                color: white;
                padding: 20px 0;
                text-align: left;
            }
            .footer-content {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                padding: 20px;
            }
            .company-info,
            .quick-links,
            .support-center,
            .opening-hours {
                flex: 1;
                min-width: 250px;
                margin: 10px;
            }
            .logo-container img {
                max-width: 60%;
                height: auto;
            }
            .footer-bottom {
                display: flex;
                justify-content: space-between;
                padding: 10px 20px;
                background-color: #222;
            }
            .footer-bottom-social a {
                color: rgb(234, 78, 55);;
                margin: 0 5px;
            }
            
            /* Responsive Styles */
            @media (max-width: 768px) {
           
                .reponsive_mode {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    padding: 20px;
                }
            }
            @media (min-width: 1125px) {
                .reponsive_mode {
                    display: none;
                }
            }
      
  
    h2 {
        text-align: center;
        color: rgb(234, 78, 55);
        margin-bottom: 20px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
       
        
    }
    
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    
    th {
        background-color: rgb(234, 78, 55);
        color: white;
    }
    
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
 
    #button {
        background-color: rgb(234, 78, 55); 
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 0 auto;
        display: block;
    }
    
    #button:hover {
        background-color: #218838; /* Darker green */
    }
    

   

.contact-header {
    text-align: center;
    padding: 50px 0;
    background-color: #f8f8f8;
}

.contact-header h1 {
    font-size: 40px;
    background-color: rgb(234, 78, 55);
    color: white;
}


    table {
        background-color: white;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background-color: rgb(234, 78, 55);
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

 
    .hero {
        text-align: center;
        margin: 20px 0; /* Adjust as needed */
    }
    
    
    .hero-image {
        max-width: 100%;
        height: auto;
    }
    
    .hero-heading {
        font-size: 2rem; /* Adjust the font size as needed */
        color: rgb(234, 78, 55); /* Use the same color scheme */
        margin-top: 15px;
    }
    </style>
  

    <!-- footer -->
    <footer style="position: relative; top:50px">
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

   //js for disease section
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".read-more-btn").forEach(button => {
        button.addEventListener("click", () => {
            const diseaseId = button.getAttribute("data-id");
            if (diseaseId) {
                window.location.href = `Common Diseases, Prevention, and Treatment(read_more).php?id=${diseaseId}`;
            } else {
                console.error("Disease ID not found on button.");
            }
        });
    });
});

document.querySelector(".view-all-btn").addEventListener("click", () => {
  window.location.href =
    "Common Diseases, Prevention, and Treatment(view_all).php"; // Link to a separate page for all diseases
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
