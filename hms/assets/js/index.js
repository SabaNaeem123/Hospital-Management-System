// header js
function openMenu() {
  const menu = document.getElementById("fullscreenMenu");
  menu.style.display = "flex";
  setTimeout(() => {
    menu.style.opacity = "1"; // fade-in effect
  }, 10); // slight delay for smooth transition
}
// Dropdown JavaScript
document.addEventListener("DOMContentLoaded", function () {
  const dropdown = document.querySelector(".dropdown");

  dropdown.addEventListener("mouseover", function () {
    const dropdownMenu = this.querySelector(".dropdown-menu");
    dropdownMenu.style.display = "block";

    // Add a slight delay for animation
    setTimeout(() => {
      dropdownMenu.style.opacity = "1";
      dropdownMenu.style.transform = "translateY(0)";
    }, 10);
  });

  dropdown.addEventListener("mouseleave", function () {
    const dropdownMenu = this.querySelector(".dropdown-menu");

    // Start the fade-out and slide-up animation
    dropdownMenu.style.opacity = "0";
    dropdownMenu.style.transform = "translateY(-20px)";

    // Hide after the transition completes
    setTimeout(() => {
      dropdownMenu.style.display = "none";
    }, 400); // Match the transition duration (0.4s)
  });
});

function closeMenu() {
  const menu = document.getElementById("fullscreenMenu");
  menu.style.opacity = "0"; // fade-out effect
  setTimeout(() => {
    menu.style.display = "none";
  }, 400); // delay to match the transition duration
}
//js for tooltip
document.querySelectorAll(".user-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const tooltip = button.querySelector(".tooltip");

    // Toggle tooltip visibility
    if (tooltip.classList.contains("active")) {
      tooltip.classList.remove("active");
      tooltip.classList.add("hide");
    } else {
      tooltip.classList.remove("hide");
      tooltip.classList.add("active");
    }
  });
});

// Close tooltip when the close button is clicked
document.querySelectorAll(".tooltip-close").forEach((closeBtn) => {
  closeBtn.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent closing when clicking inside the tooltip
    const tooltip = closeBtn.closest(".tooltip");
    tooltip.classList.remove("active");
    tooltip.classList.add("hide");
  });
});
// banner js
// Smooth scroll to appointment section
document.querySelector(".cta-btn").addEventListener("click", function (e) {
  e.preventDefault();
  document.querySelector("#appointment").scrollIntoView({ behavior: "smooth" });
});

//team slider js
const sliderData = [
  {
    title: "Our Trusted Experts",
    description:
      "Meet our highly qualified experts who are dedicated to providing exceptional care and  treatment to all patients. Their experience ensures top-tier medical services, making  trusted name in healthcare.",
    img: "assets/img/trusted_experts.jpg",
  },
  {
    title: "Our Oncology Team",
    description:
      "Our oncology specialists provide advanced cancer care with empathy and precision. They work tirelessly to offer the latest treatments and a holistic approach, ensuring the best outcomes for all our patients.",
    img: "assets/img/oncology_team.png",
  },
  {
    title: "Our Cardiology Team",
    description:
      "Our skilled cardiologists are experts in heart health, focusing on prevention and advanced care. Using cutting-edge technology, they provide comprehensive cardiac services with a compassionate touch.",
    img: "assets/img/cardiology_team.jpg",
  },
];

let currentIndex = 0;
const titleElement = document.getElementById("slider-title");
const descriptionElement = document.getElementById("slider-description");
const imageElement = document.getElementById("slider-image");

document.getElementById("next-button").addEventListener("click", () => {
  changeSlide(1, "flip-next");
});

document.getElementById("prev-button").addEventListener("click", () => {
  changeSlide(-1, "flip-prev");
});

function changeSlide(direction, animationClass) {
  // Apply flip animation to image and fade-out to text
  imageElement.classList.add(animationClass);
  titleElement.classList.add("hidden-text");
  descriptionElement.classList.add("hidden-text");

  setTimeout(() => {
    // Update the current index
    currentIndex =
      (currentIndex + direction + sliderData.length) % sliderData.length;

    // Update content
    titleElement.textContent = sliderData[currentIndex].title;
    descriptionElement.textContent = sliderData[currentIndex].description;
    imageElement.src = sliderData[currentIndex].img;

    // Reset animations and apply fade-in to text
    imageElement.classList.remove(animationClass);
    titleElement.classList.remove("hidden-text");
    descriptionElement.classList.remove("hidden-text");
  }, 600); // Match the transition duration
}

//gallery js
document.addEventListener("DOMContentLoaded", () => {
  const filterButtons = document.querySelectorAll(".filter-button");
  const galleryItems = document.querySelectorAll(".gallery_product");

  // Display only the first 6 images on page load
  galleryItems.forEach((item, index) => {
    if (index < 6) {
      item.classList.add("show"); // Show only the first 6 images
    }
  });

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      document
        .querySelector(".filter-button.active")
        .classList.remove("active");
      button.classList.add("active");

      const filter = button.getAttribute("data-filter");

      galleryItems.forEach((item, index) => {
        item.classList.remove("show"); // Hide all images first

        // Apply filter logic and show images matching the filter
        if (filter === "all" || item.classList.contains(filter)) {
          setTimeout(() => {
            if (index < 6 || filter !== "all") {
              item.classList.add("show"); // Show matching images
            }
          }, 50);
        }
      });
    });
  });

  // Ensure the first 6 images are shown by default when 'All' filter is active
  filterButtons[0].click();
});

//js for diseases section
document.querySelector(".view-all-btn").addEventListener("click", () => {
  window.location.href =
    "Common Diseases, Prevention, and Treatment(view_all).php"; // Link to a separate page for all diseases
});

//testimonial js
function startSwiper(entries, observer) {
  entries.forEach((entry) => {
    if (entry.isIntersecting && !swiperAutoplayStarted) {
      swiper.autoplay.start(); // Start autoplay
      swiperAutoplayStarted = true;
    } else if (!entry.isIntersecting && swiperAutoplayStarted) {
      swiper.autoplay.stop(); // Stop autoplay
    }
  });
}

// Target the swiper container
const swiperContainer = document.querySelector(".mySwiper");

// Create an intersection observer to monitor the swiper container
const observer = new IntersectionObserver(startSwiper);
observer.observe(swiperContainer);

// Initialize Swiper with custom animations
let swiperAutoplayStarted = false;
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 3000,
  },
  speed: 800,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
  },
  on: {
    slideChangeTransitionStart: function () {
      const activeSlide = document.querySelector(".swiper-slide-active");
      activeSlide.classList.add("slide-in-animation");
    },
    slideChangeTransitionEnd: function () {
      const allSlides = document.querySelectorAll(".swiper-slide");
      allSlides.forEach((slide) =>
        slide.classList.remove("slide-in-animation")
      );
    },
  },
});

// Handle the newsletter form submission
document
  .getElementById("newsletter-form")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting

    // Hide the form
    document.getElementById("newsletter-form").style.display = "none";
    document.getElementById("text-content").style.display = "none";

    // Show the thank-you message with animation
    const thankYouMessage = document.getElementById("thank-you-message");
    thankYouMessage.classList.add("show-thank-you");
  });
