<?php
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM disease WHERE disease_id=$id";
    $final = mysqli_query($conn, $query);
    if($final){
        header("Location: manage_user_site_content.php");
    } else {
        echo "Not deleted";
    }
}
?>
