<?php
// Start session only if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

// Include database connection
include 'db.php';

// Fetch existing content if disease_id is provided
$disease_id = $_GET['id'] ?? null;
$disease = null;

if ($disease_id) {
    $query = "SELECT * FROM disease WHERE disease_id = $disease_id";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $disease = $result->fetch_assoc();
    }
}

// Update logic when form is submitted
if(isset($_POST["add"])) {
    // Collecting form data
    $disease_name = $_POST['disease_name'];
    $intro_title = $_POST['intro_title'];
    $intro_text1 = $_POST['intro_text1'];
    $intro_text2 = $_POST['intro_text2'];
    $symptom1_title = $_POST['symptom1_title'];
    $symptom1_detail = $_POST['symptom1_detail'];
    $symptom2_title = $_POST['symptom2_title'];
    $symptom2_detail = $_POST['symptom2_detail'];
    $symptom3_title = $_POST['symptom3_title'];
    $symptom3_detail = $_POST['symptom3_detail'];
    $prevention1_title = $_POST['prevention1_title'];
    $prevention1_detail = $_POST['prevention1_detail'];
    $prevention2_title = $_POST['prevention2_title'];
    $prevention2_detail = $_POST['prevention2_detail'];
    $prevention3_title = $_POST['prevention3_title'];
    $prevention3_detail = $_POST['prevention3_detail'];
    $treatment1_title = $_POST['treatment1_title'];
    $treatment1_detail = $_POST['treatment1_detail'];
    $treatment2_title = $_POST['treatment2_title'];
    $treatment2_detail = $_POST['treatment2_detail'];
    $treatment3_title = $_POST['treatment3_title'];
    $treatment3_detail = $_POST['treatment3_detail'];
    $conclusion_heading = $_POST['conclusion_heading'];
    $conclusion_text = $_POST['conclusion_text'];
    $conclusion_point1 = $_POST['conclusion_point1'];
    $conclusion_point2 = $_POST['conclusion_point2'];
    $conclusion_point3 = $_POST['conclusion_point3'];


   
    $insert_query = "
    INSERT INTO disease (
        disease_name, intro_title, intro_text1, intro_text2,
        symptom1_title, symptom1_detail, symptom2_title, symptom2_detail,
        symptom3_title, symptom3_detail, prevention1_title, prevention1_detail,
        prevention2_title, prevention2_detail, prevention3_title, prevention3_detail,
        treatment1_title, treatment1_detail, treatment2_title, treatment2_detail,
        treatment3_title, treatment3_detail, conclusion_heading, conclusion_text,
        conclusion_point1, conclusion_point2, conclusion_point3
    ) VALUES (
        '$disease_name', '$intro_title', '$intro_text1', '$intro_text2',
        '$symptom1_title', '$symptom1_detail', '$symptom2_title', '$symptom2_detail',
        '$symptom3_title', '$symptom3_detail', '$prevention1_title', '$prevention1_detail',
        '$prevention2_title', '$prevention2_detail', '$prevention3_title', '$prevention3_detail',
        '$treatment1_title', '$treatment1_detail', '$treatment2_title', '$treatment2_detail',
        '$treatment3_title', '$treatment3_detail', '$conclusion_heading', '$conclusion_text',
        '$conclusion_point1', '$conclusion_point2', '$conclusion_point3'
    )
";

    $final = mysqli_query($conn, $insert_query);

    if($final) {
        header("Location: manage_user_site_content.php");
    } else {
        echo "Error inserting data";
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> New Disease Entry</title>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin_home.css?v=1.0">
  <!-- favicon -->
  <link
      rel="shortcut icon"
      href="assets/img/logo.png"
      type="image/x-icon"
    />

        
<style>
    .form-container {
        margin-top: 7rem;
        width: 900px;
        margin-right: 250px;
        padding: 2rem;
        background: #fdfdfd;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 4rem;
    }

    h2 {
        font-size: 2em;
        color: #EA4E37;
        text-align: center;
        font-weight: bold;
        margin-bottom: 3rem;
        margin-top: 2rem;
    }

    /* Tabs */
    .tabs {
        display: flex;
        gap: 1rem;
        border-bottom: 2px solid #ddd;
        margin-bottom: 2rem;
    }

    .tab {
        padding: 0.8rem 1.5rem;
        background: #f5f5f5;
        border: none;
        cursor: pointer;
        color: #EA4E37;
        font-weight: bold;
        border-radius: 8px 8px 0 0;
        transition: background 0.3s;
        text-decoration: none;
    }

    .tab.active, .tab:hover {
        background: #EA4E37;
        color: #fff;
    }

    /* Form Sections */
    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
    }

    .form-card {
        background: #fff;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    h3 {
        font-size: 1.4em;
        color: #d43b26;
        margin-bottom: 1rem;
        border-bottom: 2px solid #EA4E37;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    label {
        font-weight: 600;
        color: #EA4E37;
    }

    input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid rgba(234, 78, 55, 0.5);
            background: #f1f1f1;
            font-size: 1em;
            color: #333;
            margin-top: 8px;
            outline: none;
            transition: all 0.3s ease;
            margin-top: 0.8rem;
            margin-bottom: 2rem;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: rgb(234, 78, 55);
            background: #ffffff;
            box-shadow: 0px 2px 6px rgba(234, 78, 55, 0.3);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

    .submit-btn {
        display: block;
        width: 100%;
        max-width: 300px;
        padding: 1rem;
        margin: 2rem auto 0;
        font-size: 1.2em;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(
    280deg,
    rgb(247, 247, 247) 0%,
    rgb(234, 78, 55) 1%,
    rgb(195, 26, 10) 100%
  );
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
        box-shadow: 0 6px 16px rgba(234, 78, 55, 0.2);
    }

    .submit-btn:hover {
        transform: scale(1.1);
    }
</style>
    </style>
</head>

<body>
<div class="dashboard-container">
        <div class="user-info">
            <button class="user-btn" style="background-color: rgb(234, 78, 55); color: white;">
                <i class="fas fa-user-circle"></i> 
                <?php echo $_SESSION['admin']; ?>
            </button>
            <a href="admin_logout.php" class="logout-btn">Logout</a>
    </div>


    <div class="actions">
    <h3>Admin Controls</h3>
    <a href="admin_home.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin_home.php' ? 'active' : ''; ?>">Dashboard</a>
    <a href="doctor_form.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'doctor_form.php' ? 'active' : ''; ?>">Register Doctor</a>
    <a href="user_form.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'user_form.php' ? 'active' : ''; ?>">Register Patient</a>
    <a href="manage_doctor.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_doctor.php' ? 'active' : ''; ?>">Manage Doctor Details</a>
    <a href="manage_patients.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'manage_patients.php' ? 'active' : ''; ?>">Manage  Patient Record</a>
<a href="manage_user_site_content.php" class="active">Site Content Studio</a>

</div>
</div>


<div class="form-container">
    <h2>Health Insight: Add New Disease Entry</h2>
    
    <!-- Tabs -->
    <div class="tabs">
        <div class="tab active" data-tab="introduction">Introduction</div>
        <div class="tab" data-tab="symptoms">Symptoms</div>
        <div class="tab" data-tab="preventions">Preventions</div>
        <div class="tab" data-tab="treatments">Treatments</div>
        <div class="tab" data-tab="conclusion">Conclusion</div>
    </div>
    
    <!-- Sections -->
    <div class="form-sections">
       
        <!-- Introduction Section -->
        <div id="introduction" class="form-section active">
            <h3>Introduction</h3>
             <form method="POST">
            <label for="disease_name">Disease Name</label>
            <input type="text" id="disease_name" name="disease_name">

            <label for="intro_title">Introduction Title</label>
            <input type="text" id="intro_title" name="intro_title">

            <label for="intro_text1">Introduction Text 1</label>
            <textarea id="intro_text1" name="intro_text1" rows="4"></textarea>

            <label for="intro_text2">Introduction Text 2</label>
            <textarea id="intro_text2" name="intro_text2" rows="4"></textarea>
        </div>

        <!-- Symptoms Section -->
        <div id="symptoms" class="form-section">
            <h3>Symptoms</h3>
            <label for="symptom1_title">Symptom 1 Title</label>
            <input type="text" id="symptom1_title" name="symptom1_title">

            <label for="symptom1_detail">Symptom 1 Detail</label>
            <textarea id="symptom1_detail" name="symptom1_detail" rows="3"></textarea>

            <label for="symptom2_title">Symptom 2 Title</label>
            <input type="text" id="symptom2_title" name="symptom2_title">

            <label for="symptom2_detail">Symptom 2 Detail</label>
            <textarea id="symptom2_detail" name="symptom2_detail" rows="3"></textarea>

            <label for="symptom3_title">Symptom 3 Title</label>
            <input type="text" id="symptom3_title" name="symptom3_title">

            <label for="symptom3_detail">Symptom 3 Detail</label>
            <textarea id="symptom3_detail" name="symptom3_detail" rows="3"></textarea>
        </div>

        <!-- Preventions Section -->
        <div id="preventions" class="form-section">
            <h3>Preventions</h3>
            <label for="prevention1_title">Prevention 1 Title</label>
            <input type="text" id="prevention1_title" name="prevention1_title">

            <label for="prevention1_detail">Prevention 1 Detail</label>
            <textarea id="prevention1_detail" name="prevention1_detail" rows="3"></textarea>

            <label for="prevention2_title">Prevention 2 Title</label>
            <input type="text" id="prevention2_title" name="prevention2_title">

            <label for="prevention2_detail">Prevention 2 Detail</label>
            <textarea id="prevention2_detail" name="prevention2_detail" rows="3"></textarea>

            <label for="prevention3_title">Prevention 3 Title</label>
            <input type="text" id="prevention3_title" name="prevention3_title">

            <label for="prevention3_detail">Prevention 3 Detail</label>
            <textarea id="prevention3_detail" name="prevention3_detail" rows="3"></textarea>
        </div>

        <!-- Treatments Section -->
        <div id="treatments" class="form-section">
            <h3>Treatments</h3>
            <label for="treatment1_title">Treatment 1 Title</label>
            <input type="text" id="treatment1_title" name="treatment1_title">

            <label for="treatment1_detail">Treatment 1 Detail</label>
            <textarea id="treatment1_detail" name="treatment1_detail" rows="3"></textarea>

            <label for="treatment2_title">Treatment 2 Title</label>
            <input type="text" id="treatment2_title" name="treatment2_title">

            <label for="treatment2_detail">Treatment 2 Detail</label>
            <textarea id="treatment2_detail" name="treatment2_detail" rows="3"></textarea>

            <label for="treatment3_title">Treatment 3 Title</label>
            <input type="text" id="treatment3_title" name="treatment3_title">

            <label for="treatment3_detail">Treatment 3 Detail</label>
            <textarea id="treatment3_detail" name="treatment3_detail" rows="3"></textarea>
        </div>

        <!-- Conclusion Section -->
        <div id="conclusion" class="form-section">
            <h3>Conclusion</h3>
            <label for="conclusion_heading">Conclusion Heading</label>
            <input type="text" id="conclusion_heading" name="conclusion_heading">

            <label for="conclusion_text">Conclusion Text</label>
            <textarea id="conclusion_text" name="conclusion_text" rows="4"></textarea>

            <label for="conclusion_point1">Conclusion Point 1</label>
            <input type="text" id="conclusion_point1" name="conclusion_point1">

            <label for="conclusion_point2">Conclusion Point 2</label>
            <input type="text" id="conclusion_point2" name="conclusion_point2">

            <label for="conclusion_point3">Conclusion Point 3</label>
            <input type="text" id="conclusion_point3" name="conclusion_point3">
        </div>
        <button type="submit"  class="submit-btn" name="add" style="width: 30%; margin-top: 5px; margin-bottom: 25px; position: relative; left: 280px" >Add Disease</button>
        </form>
    </div>
</div>





 
    <script>
    // JavaScript to handle tab switching
    const tabs = document.querySelectorAll('.tab');
    const sections = document.querySelectorAll('.form-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            sections.forEach(section => section.classList.remove('active'));

            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');
        });
    });
</script>
    <script>
    // Regular Expressions for validation based on requirements
    const regexPatterns = {
        disease_name: /^[A-Z][a-zA-Z0-9]*\s?[A-Z]?[a-zA-Z0-9]{0,20}$/, // Only two words with first letter capitalized
        intro_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Up to three words, each starting with a capital letter
        intro_text1: /^[A-Z][\s\S]{399,500}$/, // Allows any character after the first uppercase letter
        intro_text2: /^[A-Z][\s\S]{399,500}$/,


        symptom1_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title
        symptom2_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title
        symptom3_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title

        symptom1_detail: /^[A-Z][\s\S]{119,159}$/, // 120-160 characters, any character allowed after the first uppercase
       symptom2_detail: /^[A-Z][\s\S]{119,159}$/,
       symptom3_detail: /^[A-Z][\s\S]{119,159}$/,

        prevention1_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title
        prevention2_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title
        prevention3_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title

        prevention1_detail: /^[A-Z][\s\S]{119,159}$/,
       prevention2_detail: /^[A-Z][\s\S]{119,159}$/,
       prevention3_detail: /^[A-Z][\s\S]{119,159}$/,

        treatment1_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title
        treatment2_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title
        treatment3_title: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title

        treatment1_detail: /^[A-Z][\s\S]{119,159}$/,
       treatment2_detail: /^[A-Z][\s\S]{119,159}$/,
       treatment3_detail: /^[A-Z][\s\S]{119,159}$/,

        conclusion_heading: /^[A-Z][a-zA-Z0-9]*(\s[A-Z][a-zA-Z0-9]*){0,2}$/, // Same as intro_title
        conclusion_text: /^[A-Z][\s\S]{110,120}$/ , // 150-200 characters, first letter uppercase

        conclusion_point1:/^[A-Z][\s\S]{55,70}$/,
        conclusion_point2:/^[A-Z][\s\S]{55,70}$/,
        conclusion_point3:/^[A-Z][\s\S]{55,70}$/


    };

    // Error Messages for each field
    const errorMessages = {
        disease_name: "Disease name must be 1-2 words, each starting with a capital letter and containing only alphanumeric characters.",
        intro_title: "Introduction title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        intro_text1: "Introduction text 1 must be 400-500 characters and start with a capital letter.",
        intro_text2: "Introduction text 2 must be 400-500 characters and start with a capital letter.",

        symptom1_title: "Symptom title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        symptom2_title: "Symptom title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        symptom3_title: "Symptom title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",

        symptom1_detail: "Symptom detail must be 120-160 characters and start with a capital letter.",
        symptom2_detail: "Symptom detail must be 120-160 characters and start with a capital letter.",
        symptom3_detail: "Symptom detail must be 120-160 characters and start with a capital letter.",

        prevention1_title: "Prevention title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        prevention2_title: "Prevention title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        prevention3_title: "Prevention title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",

        prevention1_detail: "Prevention detail must be 120-160 characters and start with a capital letter.",
        prevention2_detail: "Prevention detail must be 120-160 characters and start with a capital letter.",
        prevention3_detail: "Prevention detail must be 120-160 characters and start with a capital letter.",

        treatment1_title: "Treatment title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        treatment2_title: "Treatment title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        treatment3_title: "Treatment title must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",

        treatment1_detail: "Treatment detail must be 120-160 characters and start with a capital letter.",
        treatment2_detail: "Treatment detail must be 120-160 characters and start with a capital letter.",
        treatment3_detail: "Treatment detail must be 120-160 characters and start with a capital letter.",

        conclusion_heading: "Conclusion heading must be 1-3 words, each starting with a capital letter and containing only alphanumeric characters.",
        conclusion_text: "Conclusion text must be 110-120 characters and start with a capital letter.",

        conclusion_point1: "Conclusion point must be 55-70 characters and start with a capital letter.",
        conclusion_point2: "Conclusion point must be 55-70 characters and start with a capital letter.",
        conclusion_point3: "Conclusion point must be 55-70 characters and start with a capital letter."
    };

    // Function to validate input and display error
    function validateInput(input) {
        const field = input.name;
        const value = input.value.trim();
        const pattern = regexPatterns[field];
        const errorMessage = errorMessages[field];
        let error = input.nextElementSibling;

        if (!error || !error.classList.contains('error-message')) {
            error = document.createElement('div');
            error.classList.add('error-message');
            input.parentNode.insertBefore(error, input.nextSibling);
        }

        if (pattern && !pattern.test(value)) {
            error.textContent = errorMessage;
            error.style.color = 'red';
            error.style.marginTop = '1px';
            error.style.fontSize = '0.9em';
            error.style.animation = 'fadeIn 0.3s ease';
            input.style.borderColor = 'red';
            error.style.position = 'relative'; // Set position to relative
            error.style.bottom = '25px';   
            return false;
        } else {
            error.textContent = '';
            input.style.borderColor = '';
            return true;
        }
    }

    // Event listener for all inputs
    document.querySelectorAll('input[type="text"], textarea').forEach(input => {
        input.addEventListener('blur', () => validateInput(input));
    });

    function validateForm(event) {
    let hasError = false;
    let errorFields = [];

    // Loop through each input field
    document.querySelectorAll('input[type="text"], textarea').forEach(input => {
        if (input.value.trim() === '') {
            // If field is empty, add to errorFields and set hasError to true
            errorFields.push(`${input.name} is required.`);
            hasError = true;
        } else if (!validateInput(input)) {
            // If input is invalid, add to errorFields and set hasError to true
            errorFields.push(`Error in ${input.name}: ${errorMessages[input.name]}`);
            hasError = true;
        }
    });

    if (hasError) {
        event.preventDefault(); // Prevent form submission
        alert(`Please address the following:\n\n${errorFields.join('\n')}`);
    }
}


    // Attach submit event listener
    document.querySelector('form').addEventListener('submit', validateForm);
</script>



</body>
</html> 