<?php
    // store the current page's title for dynamic HTML generation
    $currPageTitle = "Contact";
    require "nav.php";
?>
    <main class="container" id="contact">
        <div class="row">
            <div class="col-md-2 col-lg-3">
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <h1 class="card col-12 py-3 mb-1 text-center">
                    Contact
                </h1>
                <form action="/NursingClinical/Controller/send-email.php" method="post" id="contact-form">
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="" required>
                            <label for="name">
                                Name <?php echo displayRequired(); ?>
                            </label>
                        </div>
                    </div>
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="" required>
                        <label for="email">
                            Email Address <?php echo displayRequired(); ?>
                        </label>
                    </div>
                    </div>
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder=""
                                   onkeydown="formatPhoneNumber1()"
                            >
                            <label for="phone">Phone Number</label>
                        </div>
                    </div>
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                            <label for="programName"></label><input type="text" class="form-control" id="programName" name="programName" placeholder="Program Name" required>
                            <label for="Program Name">
                                Program Name <?php echo displayRequired(); ?>
                            </label>
                        </div>
                    </div>
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                            <textarea class="form-control" id="message" name="message"
                                placeholder="" required></textarea>
                            <label for="message">
                                Message <?php echo displayRequired(); ?>
                            </label>
                        </div>
                    </div>
                    <div class="card p-3 my-1">
                        <button class="btn btn-success py-2 border" id="submit-contact">Submit</button>
                    </div>

                    <!-- Display Current Email Addresses for Contact Form-->
                    <?php if (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == 1): ?>
                    <div class="card p-3 mt-3 my-1">
                        <?php
                        $filePath = $_SERVER['DOCUMENT_ROOT'].'/public_html/NursingClinical/Controller/emailContact.json';
                        $emailConfig = json_decode(file_get_contents($filePath), true);

                            // Display the email addresses from the JSON file
                            echo "<div><strong>Sent To:</strong> " . $emailConfig["sendToAddress"] . "<br></div>";
                            echo "<div><strong>Send From:</strong> " . $emailConfig["sendFromAddress"] . "<br></div>";
                        ?>
                    </div>

                </form>
                <?php
                // Function to update the JSON file with new email addresses
                function updateEmailConfig($newSendToAddress, $newSendFromAddress) {
                    // Read the JSON file
                    $filePath = $_SERVER['DOCUMENT_ROOT'].'/public_html/NursingClinical/Controller/emailContact.json';
                    $emailConfig = json_decode(file_get_contents($filePath), true);

                    // Update email addresses
                    $emailConfig['sendToAddress'] = $newSendToAddress;
                    $emailConfig['sendFromAddress'] = $newSendFromAddress;

                    // Write updated data back to the JSON file
                    file_put_contents($filePath, json_encode($emailConfig, JSON_PRETTY_PRINT));
                }

                // Check if the form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get new email addresses from the form
                    $newSendToAddress = $_POST["newSendToAddress"];
                    $newSendFromAddress = $_POST["newSendFromAddress"];

                    // Update the JSON file with new email addresses
                    updateEmailConfig($newSendToAddress, $newSendFromAddress);
                }
                ?>

                <!-- Change email address form -->
                <div class="card p-3 my-1">
                    <form id="emailForm" action="contact.php" method="post">
                        <div class="mb-3">
                            <label for="newSendToAddress" class="form-label">
                                <strong>Sent To</strong>
                                <small class="form-text text-muted">(Email Address to Receive Contact Form Messages)</small>
                            </label>
                            <input type="email" class="form-control" id="newSendToAddress" name="newSendToAddress" value="<?php echo htmlspecialchars($emailConfig['sendToAddress']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="newSendFromAddress" class="form-label">
                                <strong>Send From</strong>
                                <small class="form-text text-muted">(Email Address to Send Messages From)</small>
                            </label>
                            <input type="email" class="form-control" id="newSendFromAddress" name="newSendFromAddress" value="<?php echo htmlspecialchars($emailConfig['sendFromAddress']); ?>" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="text-center mx-auto btn btn-primary">Update Email Addresses</button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>


                <script>
                    document.getElementById('emailForm').addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission

                        const sendToAddress = document.getElementById('newSendToAddress').value;
                        const sendFromAddress = document.getElementById('newSendFromAddress').value;

                        // Basic email validation
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(sendToAddress) || !emailPattern.test(sendFromAddress)) {
                            alert('Please enter valid email addresses.');
                            return;
                        }

                        const formData = new FormData(this);

                        // Use fetch API to submit the form data
                        fetch('contact.php', {
                            method: 'POST',
                            body: formData
                        }).then(response => {
                            if (response.ok) {
                                // Reload the page after successful form submission
                                location.reload();
                            } else {
                                // Handle errors if needed
                                alert('There was an issue with the form submission.');
                            }
                        }).catch(error => {
                            // Handle errors if needed
                            console.error('Error:', error);
                        });
                    });
                </script>


            </div>
            <div class="col-md-2 col-lg-3">
            </div>
        </div>
    </main>
    <?php
        // display site footer
        require_once(LAYOUTS_PATH . "/nursing-footer.php");
    ?>
</body>
</html>