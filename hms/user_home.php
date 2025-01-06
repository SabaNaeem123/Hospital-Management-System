<?php
include 'db.php';
session_start();

$loggedIn = isset($_SESSION['user']);

if (isset($_SESSION['user'])) {
$email = $_SESSION['user'];

// Escape the email to prevent SQL injection
$email = mysqli_real_escape_string($conn, $email);

// Modify the query to use the properly escaped email value
$query = "SELECT full_name FROM users WHERE email='$email'";

$query_run = mysqli_query($conn, $query);

if ($query_run && mysqli_num_rows($query_run) > 0) {
    // Fetch the result as an associative array
    $result = mysqli_fetch_assoc($query_run);
    
    // Store the full_name in a variable
    $full_name = $result['full_name'];
    

} else {
    // Handle the case where no result is found
    echo "No user found with that email.";
}
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
    <link rel="stylesheet" href="assets/css/user_home.css">
    <style>
        .login {
  background-color: rgb(234, 78, 55);
  padding: 1px 1px;
  border-radius: 8px;
  font-weight: bolder;
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
          <li><a href="#" class="actives home active">Home</a></li>
          <li><a href="#" class="actives">About Us</a></li>
          <li><a href="#" class="actives">Services</a></li>
          <li><a href="#" class="actives">Career</a></li>
          <li><a href="#" class="actives">Contact Us</a></li>
          <li><a href="#" class="actives">Book Appointment</a></li>
        </ul>
      </nav>
      <div class="login">
      <?php if ($loggedIn): ?> 
                <button class="user-btn">
                    <a href="user_profile.php" class="tooltip"> <i class="fas fa-user-circle"></i> 
                    <?php echo htmlspecialchars($_SESSION['name']); ?>
                    <span class="tooltip-text">Update Profile</span>
                </a>
                   
                </button>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="user_login.php" class="login-btn">Login</a>
                <a href="user_register.php" class="register-btn">Register</a>
            <?php endif; ?>
      </div>
            <style>
.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltip-text {
    visibility: hidden;
    width: 130px;
    background: linear-gradient(180deg, rgba(240, 98, 80, 0.9), rgba(255, 150, 136, 0.9)); /* Slightly darker gradient */
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
</style>

      <div class="hamburger" onclick="openMenu()">
        <i class="fas fa-bars"></i>
      </div>
    </header>

    <!-- Fullscreen Menu -->
    <div class="fullscreen-menu" id="fullscreenMenu">
      <span class="close-menu" onclick="closeMenu()">&times;</span>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Career</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Book Appointment</a></li>
        <li style="display: flex;">
        <?php if ($loggedIn): ?> 
        <button class="user-btn">
                    <a href="edit_profile.php" class="tooltip"> <i class="fas fa-user-circle"></i> 
                    <?php echo htmlspecialchars($_SESSION['name']); ?>
                    <span class="tooltip-text">Update Profile</span>
                </a>
                   
                </button>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="user_login.php" class="login-btn">Login</a>
                <a href="user_register.php" class="register-btn">Register</a>
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
              <p>We offer advanced heart diagnostics, treatments, and long-term care for managing heart diseases effectively.</p>
              <a href="#cardiology" class="learn-more">Learn More</a>
          </div>
          
          <!-- Service 2 -->
          <div class="service-item">
              <div class="icon-background">
                  <i class="fas fa-brain service-icon"></i> <!-- Example icon -->
              </div>
              <h3>Neurology</h3>
              <p>Our neurology department provides specialized care for neurological conditions, with a focus on innovation and recovery.</p>
              <a href="#neurology" class="learn-more">Learn More</a>
          </div>
          
          <!-- Service 3 -->
          <div class="service-item">
              <div class="icon-background">
                  <i class="fas fa-bone service-icon"></i> <!-- Example icon -->
              </div>
              <h3>Orthopedics</h3>
              <p>We specialize in bone, joint, and muscle care, including treatments for fractures, joint replacements, and trauma recovery.</p>
              <a href="#orthopedics" class="learn-more">Learn More</a>
          </div>
          
          <!-- Service 4 -->
          <div class="service-item">
              <div class="icon-background">
                  <i class="fas fa-stethoscope service-icon"></i> <!-- Example icon -->
              </div>
              <h3>Pediatrics</h3>
              <p>Our pediatric services provide comprehensive healthcare for children, offering preventive care  for various conditions.</p>
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



<!-- Testimonial Section -->
<h2 class="testimonial-tittle" style="margin-bottom: 3rem; text-align: center;">Voices of Care - What Our Patients and Doctors Say</h2>
<div class="swiper mySwiper">
  <div class="swiper-wrapper">

    <!-- Patient Testimonial -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/testimonial-1.jpg" alt="testimonial">
        <p>
          "I received excellent care and attention from the medical team. They ensured my recovery was smooth and quick. 
          The environment was comfortable, and I never felt rushed during my appointments."
        </p>
        <h4>John Doe</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>

    <!-- Doctor Testimonial -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor1.jpeg" alt="testimonial" style="height: 7rem; max-width: 110px;">
        <p>
          "Working here has been an incredible experience. The hospital's focus on patient care aligns perfectly with my 
          values. It's rewarding to see patients recover with our dedicated efforts."
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
          "The doctors were very supportive throughout my treatment. Their empathy and expertise made all the difference, 
          and I am truly grateful for the care I received."
        </p>
        <h4>Emily Johnson</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/testimonial-3.jpg" alt="testimonial">
        <p>
          "The staff was compassionate and professional, making me feel comfortable during my stay. I never imagined a 
          hospital experience could be this smooth and reassuring."
        </p>
        <h4>Mark Wilson</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>

    <!-- Three Doctor Testimonials -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor2.jpeg" alt="testimonial" style="height: 7rem; max-width: 110px;">
        <p>
          "We strive to make a positive impact on every patient we treat. Being able to witness patients recover and thrive 
          is the most rewarding part of my job."
        </p>
        <h4>Dr. Ahmed Khan</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor3.jpeg" alt="testimonial" style="height: 7rem; max-width: 110px;">
        <p>
          "Our team works tirelessly to deliver the highest standards of care. Every day presents new challenges, but the 
          outcome makes it all worth it."
        </p>
        <h4>Dr. Fatima Malik</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor4.jpeg" alt="testimonial" style="height: 7rem; max-width: 110px;">
        <p>
          "I have seen remarkable improvements in patient outcomes thanks to our dedicated staff and state-of-the-art 
          facilities. It’s a privilege to be part of this team."
        </p>
        <h4>Dr. Usman Ali</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>

    <!-- Additional Testimonials -->
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/testimonial-4.jpg" alt="testimonial" style="height: 7rem; max-width: 110px;">
        <p>
          "The personalized care I received made all the difference. I never felt like just another patient – the staff 
          truly cared about my well-being."
        </p>
        <h4>Adam Williams</h4>
        <p class="testimonial-role">Patient</p>
      </div>
    </div>
    <div class="swiper-slide">
      <div class="testimonial__card">
        <img src="assets/img/doctor5.jpeg" alt="testimonial" style="height: 7rem; max-width: 110px;">
        <p>
          "It feels rewarding to be part of a team that genuinely cares about patient well-being. Seeing the difference we 
          make is incredibly satisfying."
        </p>
        <h4>Dr. Maria Ahmed</h4>
        <p class="testimonial-role">Doctor</p>
      </div>
    </div>

  </div>

  <div class="swiper-pagination"></div>
</div>


<!-- Newsletter Section -->
<div class="newsletter-section">
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
        <div class="opening-hours" style="position: relative; bottom: 20px">
          <h3>Opening Hours</h3>
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
  </body>
</html>
 