document.getElementById("form").addEventListener("submit", function (event) {
  let isValid = true;

  // Full name validation (only alphabets, spaces, and each word starts with a capital letter)
  const name = document.getElementById("name").value;
  const nameRegex = /^[A-Z][a-z]*(\s[A-Z][a-z]*)*$/; // Each word must start with a capital letter
  if (!nameRegex.test(name)) {
    document.getElementById("name-error").innerText =
      "Full name must contain only alphabets and spaces, and each word should start with a capital letter.";
    isValid = false;
  } else {
    document.getElementById("name-error").innerText = ""; // Clears the error message if the name is valid
  }

  // Email validation
  const email = document.getElementById("email").value;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    document.getElementById("email-error").innerText =
      "Email must be valid and contain @ and a domain.";
    isValid = false;
  } else {
    document.getElementById("email-error").innerText = "";
  }

  // Password validation (at least 10 characters, including letters, numbers, and special characters)
  const password = document.getElementById("password").value;
  const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).{10,}$/;
  if (!passwordRegex.test(password)) {
    document.getElementById("password-error").innerText =
      "Password must be at least 10 characters long and include letters, numbers, and special characters.";
    isValid = false;
  } else {
    document.getElementById("password-error").innerText = "";
  }

  // Confirm password validation (must match password)
  const confirmPassword = document.getElementById("confirm_password").value;
  if (confirmPassword !== password) {
    document.getElementById("confirm-password-error").innerText =
      "Passwords do not match.";
    isValid = false;
  } else {
    document.getElementById("confirm-password-error").innerText = "";
  }

  // Phone number validation (must be exactly 11 digits)
  const phone = document.getElementById("phone").value;
  const phoneRegex = /^\d{11}$/; // Exactly 11 digits
  if (!phoneRegex.test(phone)) {
    document.getElementById("phone-error").innerText =
      "Phone number must be exactly 11 digits.";
    isValid = false;
  } else {
    document.getElementById("phone-error").innerText = "";
  }

  // Address validation (must contain only letters, numbers, and spaces)
  const address = document.getElementById("address").value;
  const addressRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9\s]+$/;
  if (!addressRegex.test(address)) {
    document.getElementById("address-error").innerText =
      "Address must contain only letters, numbers, and spaces.";
    isValid = false;
  } else {
    document.getElementById("address-error").innerText = "";
  }

  // Prevent form submission if any validation fails
  if (!isValid) {
    event.preventDefault();
  }
});
