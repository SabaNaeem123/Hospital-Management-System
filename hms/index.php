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
           <li><a href="search_doctors.php">Search Doctors</a></li>   
             <li><a href="book_appointment_form.php">Book Appointment</a></li>   
               <li><a href="patient_view_appointment.php">Manage Appointments</a></li>  
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
      <a href="user_login.php"> 
    <i class="fas fa-user-circle"></i> 
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


  <!-- banner  -->

    <div class="banner">
      <div class="left-half">
          <div class="shape-overlay">
              <!-- Multiple animated circles for dynamic effect -->
              <div class="circle small"></div>
              <div class="circle medium"></div>
              <div class="circle small"></div>
              <div class="circle medium"></div>
              <div class="circle small"></div>
              <div class="circle medium"></div>
              <div class="circle small"></div> <!-- Extra small circle at the start -->
              <div class="circle medium"></div> <!-- Extra medium circle at the start -->
          </div>
          <div class="text-container">
            <h1>Innovative Healthcare Solutions</h1> <!-- Adding a heading for impact -->
            <p style="font-weight: bolder;">Care is a leading healthcare provider committed to delivering high-quality medical services with a focus on patient care, advanced technology, and compassionate staff to ensure the well-being of all patients</p>
            <a href="#appointment" class="cta-btn">Book Your Appointment</a> <!-- Updated button text -->
        </div>
      </div>
      <div class="right-half">
          <img src="assets/img/banner.jpeg" alt="Doctor Team" class="banner-image">
      </div>
  </div>
  
   
<!-- Services and Specialties Section -->
<section class="services-section">
  <div class="container">
      <h2 class="section-title" style="margin-bottom: 3rem;">Our Medical Services</h2>
      <div class="services-grid">
          <!-- Service 1 -->
          <div class="service-item">
              <div class="icon-background">
                  <i class="fas fa-heartbeat service-icon"></i> <!-- Example icon -->
              </div>
              <h3>Cardiology</h3>
              <p>We provide advanced diagnostics and treatments for heart diseases. Our specialists help manage conditions and improve long-term heart health in our patients.</p>
              <a href="#cardiology" class="learn-more">Learn More</a>
          </div>
          
          <!-- Service 2 -->
          <div class="service-item">
              <div class="icon-background">
                  <i class="fas fa-brain service-icon"></i> <!-- Example icon -->
              </div>
              <h3>Neurology</h3>
              <p>Our neurology team offers innovative treatments for neurological conditions. We focus on diagnosis and rehabilitation to improve patient outcomes.</p>
              <a href="#neurology" class="learn-more">Learn More</a>
          </div>
          
          <!-- Service 3 -->
          <div class="service-item">
              <div class="icon-background">
                  <i class="fas fa-bone service-icon"></i> <!-- Example icon -->
              </div>
              <h3>Orthopedics</h3>
              <p>Our orthopedic specialists offer treatments for bone and joint issues, including trauma care, joint replacement, and fracture management to restore mobility.</p>
              <a href="#orthopedics" class="learn-more">Learn More</a>
          </div>
          
          <!-- Service 4 -->
          <div class="service-item">
              <div class="icon-background">
                  <i class="fas fa-stethoscope service-icon"></i> <!-- Example icon -->
              </div>
              <h3>Pediatrics</h3>
              <p>Our pediatric care covers preventive services and treatment for various childhood conditions. We focus on ensuring children's health and well-being at every stage.</p>
              <a href="#pediatrics" class="learn-more">Learn More</a>
          </div>
      </div>
  </div>
</section>

<!-- Custom team Slider Section -->
<div class="slider-section">
  <h2 id="slider-title">Our Trusted Experts</h2>
  <p id="slider-description">Meet our highly qualified experts who are dedicated to providing exceptional care and  treatment to all patients. Their experience ensures top-tier medical services, making  trusted name in healthcare</p>

  <div class="slider-container">
    <button id="prev-button" class="slider-arrow">
      <i class="fas fa-chevron-left"></i>
    </button>
    <img id="slider-image" src="assets/img/trusted_experts.jpg" alt="Slider Image" />
    <button id="next-button" class="slider-arrow">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>
</div>






<!-- Gallery Section -->
<div id="gallery" class="gallery">
  <div class="container">
      <div class="inner-title" style="margin-bottom: 2rem;">
          <h2 class="gallery-title">Our Gallery</h2>
      </div>

      <div class="gallery-filter">
          <button class="filter-button active" data-filter="all">All</button>
          <button class="filter-button" data-filter="cardiology">Cardiology</button>
          <button class="filter-button" data-filter="neurology">Neurology</button>
          <button class="filter-button" data-filter="dental">Dental</button>
          <button class="filter-button" data-filter="surgery">Surgery</button>
      </div>

      <div class="gallery-container row">
          <div class="gallery_product filter dental">
              <img src="assets/img/dental1.jpg" class="port-image" alt="Dental Image 1">
          </div>
          <div class="gallery_product filter cardiology">
            <img src="assets/img/cardiology2.jpg" class="port-image" alt="Cardiology Image 2">
        </div>
          <div class="gallery_product filter surgery">
              <img src="assets/img/surgery1.jpeg" class="port-image" alt="Surgery Image 1">
          </div>
          <div class="gallery_product filter cardiology">
              <img src="assets/img/cardiology1.jpeg" class="port-image" alt="Cardiology Image 1">
          </div>
          <div class="gallery_product filter surgery">
              <img src="assets/img/surgery2.jpeg" class="port-image" alt="Surgery Image 2">
          </div>
          <div class="gallery_product filter neurology">
              <img src="assets/img/neurology1.jpeg" class="port-image" alt="Neurology Image 2">
          </div>
          <div class="gallery_product filter dental">
              <img src="assets/img/dental2.jpg" class="port-image" alt="Dental Image 2">
          </div>
          <div class="gallery_product filter neurology">
            <img src="assets/img/neurology2.jpeg" class="port-image" alt="Neurology Image 1">
        </div>
          <div class="gallery_product filter dental">
              <img src="assets/img/dental3.jpeg"  class="port-image" alt="Surgery Image 3">
          </div>
      </div>
  </div>
</div>

<!-- Why Choose Us Section -->
<section class="why-choose-us">
  <div class="container">
    <h2 class="section-title">Why Choose Us?</h2>
    <p class="section-subtitle">
      Discover why our hospital stands out in providing world-class healthcare with a patient-first approach, advanced technology, and personalized care.
    </p>

    <div class="features-wrapper">
      <!-- Feature 1 -->
      <div class="feature-card">
        <div class="icon-circle">
          <i class="fas fa-heartbeat"></i>
        </div>
        <h3>Comprehensive Care</h3>
        <p>All-in-one healthcare services for every stage of life.</p>
      </div>

      <!-- Feature 2 -->
      <div class="feature-card">
        <div class="icon-circle">
          <i class="fas fa-user-md"></i>
        </div>
        <h3>Experienced Team</h3>
        <p>Highly trained specialists across multiple fields.</p>
      </div>

      <!-- Feature 3 -->
      <div class="feature-card">
        <div class="icon-circle">
          <i class="fas fa-microscope"></i>
        </div>
        <h3>Advanced Technology</h3>
        <p>Latest diagnostic tools and minimally invasive treatments.</p>
      </div>

      <!-- Feature 4 -->
      <div class="feature-card">
        <div class="icon-circle">
          <i class="fas fa-hand-holding-heart"></i>
        </div>
        <h3>Patient-Centered Care</h3>
        <p>We treat every patient with compassion and respect.</p>
      </div>

      <!-- Feature 5 -->
      <div class="feature-card">
        <div class="icon-circle">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <h3>Affordable Services</h3>
        <p>High-quality healthcare at accessible prices.</p>
      </div>

      <!-- Feature 6 -->
      <div class="feature-card">
        <div class="icon-circle">
          <i class="fas fa-shield-alt"></i>
        </div>
        <h3>Safety & Trust</h3>
        <p>A safe environment with strict health protocols.</p>
      </div>
    </div>
  </div>
</section>





<!-- Health Resources Section -->
<div class="health-resources">
  <div class="container">
      <div class="inner-title">
          <h2 class="resources-title">Health Resources</h2>
          <p class="resources-description">
              Explore videos to stay informed and live healthier.
          </p>
      </div>

      <!-- First Row: Enlarged Video -->
      <div class="video-row large-video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/Vw4YpZdxMdw?si=AKabTIrF4-tF2siD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>

      <!-- Second Row: Two Smaller Videos -->
      <div class="video-row small-videos">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/zVxGCpPz-GY?si=Ro4YASAvQ5k7FPWI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

        <iframe width="560" height="315" src="https://www.youtube.com/embed/nWgf-odA50Q?si=1QpRjedD1EIgoL37" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
  </div>
</div>


<!-- Full-Width Card Section for Diseases -->
<section class="diseases-cards-section">
  <div class="container">
    <h2 class="section-title">Common Diseases, Prevention, and Treatment</h2>
    <p class="section-subtitle">Explore key information about common diseases, prevention strategies and treatments.</p>

    <?php
     // Check if any disease cards are available
        if($result->num_rows > 0) {
            // Loop through the disease cards and display them
            while(  $row = $result->fetch_assoc()){
              $id = htmlspecialchars($row['disease_id']);
              echo'

<div class="disease-card" style="height: max-content;">
  <h3 class="disease-name">' . htmlspecialchars($row['disease_name']) . '</h3>
  <div class="card-content">
    <p class="disease-description">
  ' . htmlspecialchars($row['intro_title']).' ' . ': ' .' '. htmlspecialchars($row['conclusion_text']) . '
    </p>
    <div class="disease-details">
      <div class="prevention-treatment">
        <div class="section-title">
          <h4>Symptoms</h4>
        </div>
        <ul class="info-list">
          <li>' . htmlspecialchars($row['symptom1_title']) . '</li>
          <li>' . htmlspecialchars($row['symptom2_title']) . '</li>
          <li>' . htmlspecialchars($row['symptom3_title']) . '</li>
        </ul>
      </div>
      <div class="prevention-treatment">
        <div class="section-title">
          <h4>Prevention</h4>
        </div>
        <ul class="info-list">
          <li>' . htmlspecialchars($row['prevention1_title']) . '</li>
          <li>' . htmlspecialchars($row['prevention2_title']) . '</li>
          <li>' . htmlspecialchars($row['prevention3_title']) . '</li>
        </ul>
      </div>
      <div class="prevention-treatment">
        <div class="section-title">
          <h4>Treatment</h4>
        </div>
        <ul class="info-list">
          <li>' . htmlspecialchars($row['treatment1_title']) . '</li>
          <li>' . htmlspecialchars($row['treatment2_title']) . '</li>
          <li>' . htmlspecialchars($row['treatment3_title']) . '</li>
        </ul>
      </div>
    </div>
<button class="read-more-btn" data-id="' . $id . '">Read More</button>

  </div>
</div>
';
}
}
else {
  echo "No data found for this disease ID.";
  exit();
}
?>


    <!-- View All Button -->
    <div class="view-all-wrapper">
      <button class="view-all-btn">View All</button>
    </div>
  </div>
</section>


<!-- Latest Medical News Section -->
<section class="medical-news-section">
  <div class="containers">
    <h2 class="section-titles">Latest Medical News</h2>
    <p class="section-subtitles" style="margin-bottom: 2rem; margin-top: 1rem;">Stay updated with the latest advancements and innovations in medical science and healthcare technology.</p>
    <div class="news-grid">
      <!-- News Item 1 -->
      <div class="news-item">
        <div class="news-image-wrapper">
          <img src="assets/img/news1.avif" alt="Medical News 1" class="news-image">
        </div>
        <div class="news-content">
          <h3>Innovative Heart Surgery Techniques for Better Results</h3> <!-- Adjusted for equal length -->
          <p>Our hospital provides cutting-edge techniques in minimally invasive heart surgery, leading to faster recovery and better results for patients.</p>
          <a href="latest_medical_news(read_more).php" class="read-more">Read More</a>
        </div>
      </div>

      <!-- News Item 2 -->
      <div class="news-item">
        <div class="news-image-wrapper">
          <img src="assets/img/news2.jpg" alt="Medical News 2" class="news-image">
        </div>
        <div class="news-content">
          <h3>Vaccines for Chronic Diseases: A New Era in Prevention</h3> <!-- Adjusted for equal length -->
          <p>Experts have developed vaccines to help prevent chronic illnesses, bringing hope and relief to millions of patients worldwide today.</p>
          <a href="latest_medical_news(read_more).php" class="read-more">Read More</a>
        </div>
      </div>

      <!-- News Item 3 -->
      <div class="news-item">
        <div class="news-image-wrapper">
          <img src="assets/img/news3.jpg" alt="Medical News 3" class="news-image">
        </div>
        <div class="news-content">
          <h3>AI Revolutionizing Medical Diagnostics and Healthcare</h3> <!-- Adjusted for equal length -->
          <p>Discover how artificial intelligence is changing the world of medical diagnostics, leading to faster, more accurate patient outcomes.</p>
          <a href="latest_medical_news(read_more).php" class="read-more">Read More</a>
        </div>
      </div>
    </div>

    <!-- Next Arrow -->
    <div class="next-arrow-container">
      <a href="latest_medical_news(view_all).php" class="next-arrow">
        <span class="tooltips">View All</span>
        <i class="fas fa-arrow-right"></i> <!-- Font Awesome Icon -->
      </a>
    </div>
  </div>
</section>

<!-- Information on Inventions in Medical Science Section -->
<section class="inventions-medical-science-section">
  <div class="container">
    <h2 class="inventions-title">Innovations Driving Medical Science</h2>
    <p class="inventions-subtitle">Uncover cutting-edge innovations transforming healthcare today and tomorrow.</p>
    
    <div class="invention-grid">
      <!-- Invention 1 -->
      <div class="invention-tile">
        <div class="tile-content">
          <h3>Robotic Surgical Systems</h3> <!-- 24 characters -->
          <p>Robotic systems now allow for greater precision in surgeries, lowering risk and recovery times.</p> <!-- 94 characters -->
          <a href="invention_medical_science(read_more).php" class="learn-more">Explore</a>
        </div>
        <div class="tile-image" style="background-image: url('assets/img/invention1.jpg');"></div>
      </div>

      <!-- Invention 2 -->
      <div class="invention-tile">
        <div class="tile-content">
          <h3>3D Bioprinting for Organs</h3> <!-- 25 characters -->
          <p>3D bioprinting enables the creation of organs for transplants and regenerative medicine, changing healthcare.</p> <!-- 94 characters -->
          <a href="invention_medical_science(read_more).php" class="learn-more">Explore</a>
        </div>
        <div class="tile-image" style="background-image: url('assets/img/invention2.jpeg');"></div>
      </div>

      <!-- Invention 3 -->
      <div class="invention-tile">
        <div class="tile-content">
          <h3>Wearable Health Devices</h3> <!-- 24 characters -->
          <p>Wearable tech now monitors health in real-time, helping patients and doctors manage conditions early.</p> <!-- 94 characters -->
          <a href="invention_medical_science(read_more).php" class="learn-more">Explore</a>
        </div>
        <div class="tile-image" style="background-image: url('assets/img/invention3.webp');"></div>
      </div>
      
    </div>
     <!-- Next Arrow -->
     <div class="next-arrow-container">
      <a href="invention_medical_science(view_all).php" class="next-arrow">
        <span class="tooltips">View All</span>
        <i class="fas fa-arrow-right"></i> <!-- Font Awesome Icon -->
      </a>
    </div>
  </div>
</section>




<!-- Testimonial Section -->
<h2 class="testimonial-tittle" style="margin-bottom: 3rem; text-align: center; position:relative; bottom:4rem;">Voices of Care - What Our Patients and Doctors Say</h2>
<div class="swiper mySwiper"  style="position:relative; bottom:4rem;">
  <div class="swiper-wrapper">

    <!-- Patient Testimonial -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/testimonial-1.jpg" alt="testimonial">
        <p>
          "I received excellent care and attention from the medical team. They ensured my recovery was smooth and quick. 
          The environment was comfortable, and I felt supported all throughout my appointments."
        </p>
        <h4>Sofia Khan</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>

    <!-- Doctor Testimonial -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor7.jpeg" alt="testimonial">
        <p>
          "Working here has been an incredible experience. The hospital’s focus on patient care aligns with my values. 
          It is rewarding to see patients recover with the dedication we provide every day."
        </p>
        <h4>Dr. Sarah Smith</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>

    <!-- Two Patient Testimonials -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/testimonial-2.jpg" alt="testimonial">
        <p>
          "The doctors were very supportive throughout my treatment. Their empathy made a huge difference, and I am so 
          grateful for the expert care I received. I would recommend this hospital to everyone in need."
        </p>
        <h4>Emily Johnson</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/testimonial-3.jpg" alt="testimonial">
        <p>
          "The staff were compassionate and professional, making me feel at ease during my stay. I had never imagined that 
          a hospital experience could be this reassuring, comfortable, and smooth all at once."
        </p>
        <h4>Mark Wilson</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>

    <!-- Three Doctor Testimonials -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor2.jpeg" alt="testimonial">
        <p>
          "We strive to make a positive impact on every patient we treat. Being able to witness patients recover and thrive 
          is the most rewarding part of my job. Our dedicated team helps patients achieve their health goals."
        </p>
        <h4>Dr. Ahmed Khan</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor6.jpeg" alt="testimonial" >
        <p>
          "Our team works tirelessly to deliver the highest standards of care. Every day brings new challenges, but seeing 
          the patients recover and improve makes it all worth it. We work as one to ensure the best outcomes."
        </p>
        <h4>Dr. Fatima Malik</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor9.jpeg" alt="testimonial">
        <p>
          "I have seen remarkable improvements in patient outcomes thanks to our dedicated staff and state-of-the-art 
          facilities. It is a privilege to be part of such a highly motivated team that genuinely cares for each patient."
        </p>
        <h4>Dr. Usman Ali</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>

    <!-- Additional Testimonials -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/testimonial-6.jpeg" alt="testimonial">
        <p>
          "The personalized care I received made all the difference. The staff went above and beyond to ensure that I was 
          comfortable and fully informed throughout the process, which gave me great peace of mind during my treatment."
        </p>
        <h4>John Doe</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor8.jpeg" alt="testimonial">
        <p>
          "It feels rewarding to be part of a team that genuinely cares about patient well-being. Seeing the difference we 
          make in our patients’ lives every day is incredibly satisfying and motivates me to continue working hard."
        </p>
        <h4>Dr. Maria Ahmed</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>

  </div>

  <div class="swiper-pagination"></div>
</div>


<!-- Newsletter Section -->
<div class="newsletter-section" style="position: relative; bottom:1rem;">
  <div class="newletter-container">
      <div class="content-wrapper">
          <div class="text-content" id="text-content">
              <h2>Join Our Newsletter</h2>
              <p>Get the latest healthcare tips, news, and updates delivered right to your inbox.</p>
          </div>

          <form class="newsletter-form" id="newsletter-form">
              <input type="email" placeholder="Enter your email address" required />
              <button type="submit">Subscribe</button>
          </form>
          <div id="thank-you-message" class="hidden">
            <h2 class="thankyou-heading">Thank you for subscribing!</h2>
            <p class="thankyou-line">We're excited to share our latest updates with you.</p>
          </div>
      </div>
  </div>

  <!-- Floating Circles -->
  <div class="floating-circles">
      <div class="circles circle-1"></div>
      <div class="circles circle-2"></div>
      <div class="circles circle-3"></div>
  </div>
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
