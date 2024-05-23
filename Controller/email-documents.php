<!------


NOTE: Documents Upload Feature REMOVED due to security and HIPAA and FERPA concerns


----->


<?php
//// get access to all PHP helpers
//require_once($_SERVER['DOCUMENT_ROOT'] . "/initial.php");
//
//// store the current page's title for dynamic HTML generation
//$currPageTitle = "Send Email - Uploaded Documents";
//?>
<!---->
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    --><?php
//    // include standard nursing header metadata
//    require_once(LAYOUTS_PATH . "/nursing-metadata.php");
//    ?>
<!--</head>-->
<!--<body>-->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-md-2">-->
<!--        </div>-->
<!--        <div class="col-12 col-md-8">-->
<!--            <div class="my-3">-->
<!--                --><?php
//
//                // file upload handling
//                $target_dir = "../uploads/";
//                $uploadOk = 1;
//
//                // array to hold file paths
//                $filePaths = [];
//
//                // loop through each uploaded file
//                foreach ($_FILES["fileToUpload"]["name"] as $key => $value) {
//                    // generate unique file name for target file
//                    $original_filename = $_FILES["fileToUpload"]["name"][$key]; // file name
//                    $timestamp = time(); // current timestamp
//                    $new_filename = $timestamp . "_" . $original_filename; // new file name = concatenate timestamp and file name
//                    $target_file = $target_dir . $new_filename;
//                    array_push($filePaths, $target_file); // push target directory and new file name into array
//                    // check if file already exists
//                    if (file_exists($target_file)) {
//                        echo generateMessage("Sorry, file already exists.");
//                        $uploadOk = 0;
//                    }
//
//
//                    // upload the file
//                    if ($uploadOk == 0) { // error
//                        echo generateMessage("Sorry, your file was not uploaded.");
//                    } else { // success
//                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
//                            echo generateMessage(htmlspecialchars(basename($_FILES["fileToUpload"]["name"][$key])) . " has been uploaded.");
//                        } else { //  error
//                            echo generateMessage("Sorry, there was an error uploading your file.");
//                        }
//                    }
//                }
//
//                // setup php variables to hold Documents upload form inputs
//                $firstName = $_POST['firstName'];
//                $lastName = $_POST['lastName'];
//                $studentId = $_POST['studentId'];
//                $email = $_POST['email'];
//                $phone = $_POST['phone'];
//                $documentTitle = $_POST['documentTitle'];
//                $documentDescription = $_POST['documentDescription'];
//
//
//                // send email -------------------
//                // check that all required inputs were submitted on the documents upload form
//                if (!empty($firstName) && !empty($lastName) && !empty($studentId) && !empty($email) && !empty($documentTitle)) {
//                    // setup sending and receiving addresses
//                    $sendToAddress = "david.jasmine@student.greenriver.edu"; // TODO: change this to the client's preferred email
//                    $sendFromAddress = "NursingNucleus@greenriverdev.com";
//
//                    // set up headers for email
//                    $boundary = uniqid('np');
//                    $headers = "From: $sendFromAddress\r\n";
//                    $headers .= "MIME-Version: 1.0\r\n";
//                    $headers .= "Content-Type: multipart/mixed; boundary=$boundary\r\n";
//
//                    $subject = "Nursing Nucleus: New File Uploaded by $firstName $lastName - $documentTitle";
//
//                    // message body
//                    $message = generateEmailContent($firstName, $lastName, $studentId, $email, $phone, $documentTitle, $documentDescription);
//                    $message_body = "--$boundary\r\n";
//                    $message_body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//                    $message_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
//                    $message_body .= $message . "\r\n\r\n";
//
//                    // attach the uploaded files
//                    foreach ($filePaths as $filePath) {
//                        $file_attachment = chunk_split(base64_encode(file_get_contents($filePath)));
//                        $file_mime_type = mime_content_type($filePath);
//                        $message_body .= "--$boundary\r\n";
//                        $message_body .= "Content-Type: $file_mime_type; name=\"" . basename($filePath) . "\"\r\n";
//                        $message_body .= "Content-Transfer-Encoding: base64\r\n";
//                        $message_body .= "Content-Disposition: attachment\r\n\r\n";
//                        $message_body .= $file_attachment . "\r\n\r\n";
//                    }
//                    $message_body .= "--$boundary--";
//
//                    // attempt to send email with given data and attachment(s)
//                    if (mail($sendToAddress, $subject, $message_body, $headers)) { // success
//                        echo generateMessage("Thank you! File(s) have been uploaded and sent successfully.");
//                    } else { // error
//                        echo generateMessage("Email sending failed.");
//                    }
//                }
//                // otherwise display error and link to documents upload form
//                else {
//                    echo generateMessageWithLink("/NursingClinical/view/documents-upload.php", "Documents Upload Form",
//                        "Please fill out the form and try again",
//                        "ERROR: No submission received from Documents Upload Form");
//                }
//                ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-md-2">-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--</body>-->
<!---->
<!--</html>-->
<!---->
<?php
//
///**
// * Generates the HTML content for the email message based on the documents upload form data and upload(s).
// *
// * @param string $firstName First name
// * @param string $lastName Last name
// * @param string $studentId Student ID
// * @param string $email Email
// * @param string $phone Phone
// * @param string $documentTitle Document title
// * @param string $documentDescription Document description
// * @return string HTML content for the email message
// */
//function generateEmailContent($firstName, $lastName, $studentId, $email, $phone, $documentTitle, $documentDescription) {
//    // setup email content
//    $message = "<!DOCTYPE html>
//    <html lang='en'>
//    <head>
//        <meta charset='UTF-8'>
//        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
//        <title>New File Uploaded</title>
//        <style>
//            .center {
//                text-align: center;
//            }
//            .left-align {
//                text-align: left;
//            }
//            .container{
//                width: 100%;
//            }
//        </style>
//    </head>
//    <body>
//    <div class='container'>
//        <div class='center'>
//            <h2>Green River College Nursing Program</h2>
//            <h2>Nursing Nucleus</h2>
//            <img src='https://www.greenriver.edu/media/content-assets/images/students/academics/degrees-amp-programs/nursing/Nursing-Pic.png'
//            height='70px' alt='Nursing Logo'>
//        </div>
//        <div class='left-align'>
//                        ";
//
//    // check if multiple files have been uploaded
//    if (count($_FILES["fileToUpload"]["name"]) > 1){
//        // if multiple files uploaded, add message for multiple files
//        $message .= "<p>New documents have been uploaded to the Nursing Nucleus.</p>";
//    } else {
//        // if only one file uploaded, add message for 1 file
//        $message .= " <p>A new document has been uploaded to the Nursing Nucleus.</p>";
//    }
//
//    // common message for both one and multiple file uploads
//    $message .= "
//                        <b>Name:</b> $firstName $lastName<br>
//                        <b>Student ID:</b> $studentId<br>
//                        <b>Email:</b> $email<br>";
//
//    // only add the phone number to the message if it was provided
//    if (!empty($phone)) {
//        $message .= "<b>Phone Number:</b> $phone<br>";
//    }
//
//    $message .= "<b>Document Title:</b> $documentTitle<br><br>";
//
//    // only add the document description to the message if it was provided
//    if (!empty($documentDescription)) {
//        $message .= "<b>Notes:</b> $documentDescription<br>";
//    }
//
//    $message .= "
//                </div>
//            </div>
//        </div>
//    </body>
//    </html>";
//
//    return $message;
//}
//
//?>
<!---->
<!---->
<!---->
<!---->
