<?php
//session_start();
//
///**
// * @return void
// * This will redirect to home page after 5 second.
// * If not working, user can click on the link to navigate back to homepage.
// */
//function redirectHomePage()
//{
//    echo '<meta http-equiv="refresh" content="5;url=home.php">';
//    echo '<p>If you are not redirected automatically to home page after 5 seconds, <a href="home.php">click here</a>.</p>';
//}
//
//if ($_SESSION["Admin"] == 1 && isset($_FILES["fileToUpload"])) {
//    $target_dir = $_SERVER['DOCUMENT_ROOT'].'/NursingClinical/nursing-images/slideshow/';
//
//    foreach ($_FILES["fileToUpload"]["name"] as $key => $name) {
//        $target_file = $target_dir . basename($name);
//
//        if (file_exists($target_file)) {
//            echo "Sorry, file already exists: " . htmlspecialchars($name) . "<br>";
//        } else {
//            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
//                echo "The file " . htmlspecialchars($name) . " has been uploaded to the slideshow.<br>";
//            } else {
//                echo "Sorry, there was an error uploading your file: " . htmlspecialchars($name) . "<br>";
//            }
//        }
//    }
//
//    redirectHomePage();
//} else {
//    echo "You are not authorized to upload files.";
//}
//?>
<!---->
<!---->
