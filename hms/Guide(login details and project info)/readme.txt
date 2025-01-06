Project Title:
Hospital Management System

Project Description:
The Hospital Management System is a comprehensive web-based application designed to streamline hospital operations, improve patient care, and enhance user 
experience. The system provides distinct functionalities for administrators, doctors, and patients, enabling seamless management of appointments, patient 
records, and hospital-related information.
Key features include user registration and authentication, appointment scheduling, disease information management, and access to the latest medical news 
and innovations. The platform is equipped with intuitive dashboards for each role, allowing users to manage their tasks efficiently.
This system aims to bridge the gap between medical professionals and patients, ensuring effective communication and organization within the hospital environment.

Prerequisites:
Install XAMPP web server.
A text editor (Recommended: VS Code).
A modern web browser (latest version preferred).

Languages and Technologies Used:
HTML5/CSS3 – For structuring and styling the interface.
JavaScript – To enable dynamic and interactive content.
Bootstrap – A framework for responsive web design.
XAMPP – A package containing Apache server, PHP, and MySQL.
PHP – For server-side programming.
MySQL – A relational database management system.


Steps to Run the Project:
Install XAMPP on your system.
Clone or download the project repository.
Extract the files and place them in the htdocs folder of the XAMPP directory.
Launch the XAMPP Control Panel and start both the Apache and MySQL modules.
Open your web browser and navigate to localhost/phpmyadmin.
Create a new database named myhmsdb in phpMyAdmin.
Import the myhmsdb.sql file into the newly created database.
In a new browser tab, type localhost/foldername in the URL to access the project.
Congratulations! The system is now ready to use.

Software Utilized:
XAMPP: Installed on an Ubuntu 19.04 system, utilizing the Apache2 server and MySQL. Files are stored in opt/lampp/htdocs/myhmsp.
VS Code Editor :  used for code editing.
Google Chrome:  used for project testing (accessed via localhost/myhmsp).
Starting Apache and MySQL in XAMPP
The XAMPP Control Panel allows for manual activation of Apache and MySQL services. Use the ‘Start’ button in the control panel to enable these services.

Accessing the Project
Home Page: Access via http://localhost/hms/. Patients and doctors can log in from this page by selecting their respective tabs.
Admin Login: Accessible at http://localhost/hms/admin_login.php. Admin can log in from this page.

Website Modules:
The Hospital Management System supports three main roles, each with distinct permissions and functionalities:

1. Administrator (Admin)
Dashboard: Access the admin dashboard to manage the hospital system.
Manage Doctors: Add, edit, delete, and view doctor profiles.
Manage Patients: Add, edit, delete, and view patient details.
Disease Information: Add, edit, and delete information about diseases and their treatments.
Site Content Management: Update the website's content, including medical news, FAQs, and contact information.
Cleanup: Remove outdated or unused records to maintain the system's performance.
Login Info: Username : Admin  , Password : admin123.

2. Doctor
Dashboard: View a personalized dashboard with appointment and patient management tools.
Patient Management: Add, edit, or delete patient records and manage patient profiles.
Appointment Management: View, edit, and cancel patient appointments.
Availability Management: Set and update available appointment slots.
Profile Management: Update personal profile details.
Login Info: Email : doctor@gmail.com  , Password : doctor123!@#.

3. Patient/User
Registration: Register for an account and log in to access personalized features.
Dashboard: View a user-friendly dashboard to manage interactions with the hospital.
Appointment Booking: Book, view, and cancel appointments with doctors.
Profile Management: Update personal details and manage account settings.
Information Access: View disease prevention and treatment details, read medical news, and stay updated on medical science inventions.
Login Info: Email : patient@gmail.com  , Password : patient123!@#.
