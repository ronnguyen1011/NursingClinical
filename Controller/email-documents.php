<?php
// get access to all PHP helpers
require_once($_SERVER['DOCUMENT_ROOT'] . "/initial.php");

// store the current page's title for dynamic HTML generation
$currPageTitle = "Send Email - Uploaded Documents";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // include standard nursing header metadata
    require_once(LAYOUTS_PATH . "/nursing-metadata.php");
    ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-12 col-md-8">
            <div class="my-3">

                <!-- TODO: will implement sending an email to client with all the form inputs and documents that were uploaded
                -->

                <?php

                // setup php variables to hold Documents upload form inputs
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $studentId = $_POST['studentId'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $documentTitle = $_POST['documentTitle'];
                $documentDescription = $_POST['documentDescription'];

                // FOR TESTING - print php variables from Documents upload form
                echo ("<b>Name:</b> $firstName $lastName <br>");
                echo ("<b>Student ID:</b> $studentId <br>");
                echo ("<b>Email:</b> $email <br>");
                if (!empty($phone)) {
                    echo ("<b>Phone Number:</b> $phone <br>");
                }
                echo ("<b>Document title:</b> $documentTitle <br>");
                if (!empty($documentDescription)) {
                    echo ("<b>Notes:</b> $documentDescription <br>");
                }

                ?>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

</body>

</html>





