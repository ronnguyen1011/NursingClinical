<?php
// get access to all PHP helpers
require_once($_SERVER['DOCUMENT_ROOT'] . "/initial.php");

// store the current page's title for dynamic HTML generation
$currPageTitle = "Send Email";
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
                    <?php
                    // setup variables to hold Contact form inputs
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $phone = $_POST["phone"];
                    $programName = $_POST["programName"];
                    $message = $_POST["message"];

                    // check that all required inputs were submitted on the Contact form
                    if( isset($name) && isset($email) && isset($message) && isset($programName)) {
                        // setup sending and receiving addresses
                        $sendToAddress = "david.jasmine@student.greenriver.edu"; // TODO: change this to the clients preferred email
                        $sendFromAddress = "NursingNucleus@greenriverdev.com";

                        // setup headers for html email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= "From: $sendFromAddress" . "\r\n";

                        $subject = "Nursing Nucleus Contact Page";

                        // attempt to send email with given data
                        $messageSent = mail($sendToAddress, $subject, generateEmailContent(), $headers);

                        // if the message was sent, display success
                        if($messageSent) {
                            echo generateMessage("Thank you! Your message was sent successfully.");
                        }

                        // if message was not sent, display error
                        else {
                            echo generateMessage("Please try again later",
                                "ERROR: Your message could not be sent at this time");
                        }
                    }

                    // otherwise display error and link to contact form
                    else {
                        echo generateMessageWithLink("/NursingClinical/view/contact.php", "Contact Form",
                            "Please fill out the form and try again",
                            "ERROR: No submission received from Contact Form");
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

<?php
/**
 * Generates and returns HTML content for the email message based on contact form data
 * @return string HTML content for the email message
 */
function generateEmailContent() {
    // retrieve form variables from global scope
    global $name, $email, $phone, $programName, $message;

    // setup most of email content
    $emailContent = "<html lang='en'>
                        <head>
                            <title>Nursing Nucleus Contact Page</title>
                            <style>
                                ul {
                                    list-style-type: none;
                                }
                            </style>
                        </head>
                        <body>
                        <ul>
                            <li><b>Name:</b> $name</li>
                            <li><b>Email:</b> $email</li>
                           ";
    // only add the phone number to the message if it was provided
    if ( !empty($phone) ) {
        $emailContent .= "<li><b>Phone:</b> $phone </li>";
    }

    // Add the message to the end of email content
    $emailContent .= "<li><b>Program Name:</b> $programName </li> <br>
                           <li><b>Message:</b> $message</li>
                        
                        </ul>
                    </body>
                  </html>";

    // Return the generated email content
    return $emailContent;
}
?>