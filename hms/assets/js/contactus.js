// header js
function openMenu() {
  const menu = document.getElementById("fullscreenMenu");
  menu.style.display = "flex";
  setTimeout(() => {
    menu.style.opacity = "1"; // fade-in effect
  }, 10); // slight delay for smooth transition
}

function closeMenu() {
  const menu = document.getElementById("fullscreenMenu");
  menu.style.opacity = "0"; // fade-out effect
  setTimeout(() => {
    menu.style.display = "none";
  }, 400); // delay to match the transition duration
}

// main content js
function showBranch(branch) {
  const addressElement = document.getElementById("branch-address");
  const mapIframe = document.getElementById("map-iframe");

  let address = "";
  let mapUrl = "";

  switch (branch) {
      case 'north':
          address = "<p>North:Block B, North Nazimabad, Karachi 74700, Pakistan.</p>";
          mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2233.301046539179!2d67.09028287268151!3d24.91458507789391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f2d6ab77321%3A0x95a3e2f1ca337c70!2sGulshan-e-Iqbal%20Flyover%2C%20Gulshan-e-Iqbal%2C%20Karachi%2C%20Karachi%20City%2C%20Sindh%2C%20Pakistan!5e1!3m2!1sen!2sus!4v1728768929869!5m2!1sen!2sus"; // Add North branch map URL here
          break;
      case 'clifton':
          address = "<p>Clifton, Karachi 75600, Pakistan.</p>";
          mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57938.98623902642!2d67.00129478266602!3d24.823290133940198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33dbbdc1875bf%3A0x6a6572ab3a66fed8!2sClifton%2C%20Karachi%2C%20Karachi%20City%2C%20Sindh%2C%20Pakistan!5e0!3m2!1sen!2sus!4v1729336108113!5m2!1sen!2sus";
          break;
      case 'boat-basin':
          address = "<p>Boat Basin, Clifton, Karachi, Pakistan.</p>";
          mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4469.96180577967!2d67.01697804999996!3d24.821639950000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33d946550d8cb%3A0x1ccba3b27a2a0f14!2sBoat%20Basin!5e1!3m2!1sen!2s!4v1728764608556!5m2!1sen!2s"; // Add Boat Basin map URL
          break;
      case 'keamari':
          address = "<p>Keamari, Karachi, Pakistan.</p>";
          mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d35759.34824677351!2d66.94145886052459!3d24.82283920573582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb316201ec81f17%3A0xfb7d6d51d138c380!2sKiamari%2C%20Sindh%2C%20Pakistan!5e1!3m2!1sen!2s!4v1728764631434!5m2!1sen!2s"; // Add Keamari map URL
          break;
      case 'cancer-hospital':
          address = "<p>Cancer Hospital, Karachi, Pakistan.</p>";
          mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2233.336504383583!2d67.09040587268139!3d24.91262657789516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f2cdc79f74b%3A0x2bf3a6f6707e70e1!2sCancer%20Foundation%20Hospital!5e1!3m2!1sen!2s!4v1728764659702!5m2!1sen!2s"; // Add Cancer Hospital map URL
          break;
      case 'gol-market':
          address = "<p>Gol Market, Karachi, Pakistan.</p>";
          mapUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2048.034751167511!2d73.05475667323465!3d33.72615807328146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbf097b0b21df%3A0xc5d879ba062e1fb6!2sGol%20Market%20(F-7)!5e1!3m2!1sen!2s!4v1728764705496!5m2!1sen!2s"; // Add Gol Market map URL
          break;
  }

  addressElement.innerHTML = address;
  mapIframe.src = mapUrl;
}

