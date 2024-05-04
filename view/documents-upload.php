<?php
// store the current page's title for dynamic HTML generation
$currPageTitle = "Upload Documents"; // Update the page title accordingly
require "nav.php";
?>
<body>
<main class="container" id="contact">
    <div class="row">
        <div class="col-md-2 col-lg-3">
        </div>
        <!-- Page Title -->
        <div class="col-12 col-md-8 col-lg-6">
            <h1 class="card col-12 py-3 mb-1 text-center">
                Documents Upload Form
            </h1>
            <!-- Page description -->
            <div class="card my-2 notes">
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item text-break px-2">
                        <strong>
                            Use this form to upload your documents for the Green River College Nursing Program.
                            Please ensure all fields are filled out accurately.
                        </strong>
                    </li>
                </ul>
            </div>
            <!--Upload File Form -->
            <form action="" method="post" enctype="multipart/form-data"> <!-- TODO add form action page-->
                <!-- First and Last Name -->
                <div class="row g-1">
                    <div class="col-md-6">
                        <div class="card p-3">
                            <div class="contact form-floating">
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" required>
                                <label for="firstName">First Name <?php echo displayRequired(); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-3">
                            <div class="contact form-floating">
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" required>
                                <label for="lastName">Last Name <?php echo displayRequired(); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student ID number -->
                <div class="card p-3 my-1">
                    <div class="contact form-floating">
                        <input type="text" class="form-control" id="studentId" name="studentId" placeholder="">
                        <label for="studentId">Student ID<?php echo displayRequired(); ?></label>
                    </div>
                </div>
                <!-- Email Address -->
                <div class="card p-3 my-1">
                    <div class="contact form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                        <label for="email">Email Address <?php echo displayRequired(); ?></label>
                    </div>
                </div>
                <!-- Phone number -->
                <div class="card p-3 my-1">
                    <div class="contact form-floating">
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="" onkeydown="formatPhoneNumber1()"">
                        <label for="phone">Phone Number</label>
                    </div>
                </div>


                <!-- Document Title -->
                <div class="card p-3 my-1">
                    <div class="contact form-floating">
                        <input type="text" class="form-control" id="documentTitle" name="documentTitle" placeholder=""">
                        <label for="phone">Document Title</label>
                        <label for="documentTitle">Document Title <?php echo displayRequired(); ?></label>
                    </div>
                </div>

                <!-- Document Description -->
                <div class="card p-3 my-1">
                    <div class="contact form-floating">
                        <textarea class="form-control" id="documentDescription" name="documentDescription" placeholder=""></textarea>
                        <label for="documentDescription">Notes</label>
                    </div>
                </div>
                <!-- File Upload -->
                <div class="card p-3 my-1">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Document(s): <?php echo displayRequired(); ?></label>
                        <input class="form-control" type="file" id="fileToUpload" name="fileToUpload[]" multiple required>

                    </div>
                </div>
                <!-- Submit Form Button -->
                <div class="card p-3 my-1">
                    <input type="submit" value="Upload" name="submit" class="btn btn-success py-2 border">
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</main>
<?php
// display site footer
require_once(LAYOUTS_PATH . "/nursing-footer.php");
?>
</body>

</html>
