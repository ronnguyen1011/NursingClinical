<?php 
    // get access to all helper methods
    require_once("../php/helpers.php");

    // save the current pages name to session
    setCurrentPage("Contact");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        // include standard nursing header metadata
        require "../php/layouts/nursing-metadata.php";
    ?>
</head>
<body>
    <?php 
        // display site navigation
        require_once("../php/layouts/navigation.php");
    ?>
    <main class="container" id="contact">
        <div class="row">
            <div class="col-md-2 col-lg-3">
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <h1 class="col-12 mb-3 text-center">
                    Contact
                </h1>
                <form action="/php/contact.php" method="post">
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="" required>
                            <label for="name">
                                Name <span class="text-danger">*</span>
                            </label>
                        </div>
                    </div>
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                        <input type="email" class="form-control" id="email" name="email" 
                            placeholder="" required>
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                    </div>
                    </div>
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                placeholder="" 
                                pattern="[0-9]{3} [0-9]{3} [0-9]{4}|[0-9]{3}-[0-9]{3}-[0-9]{4}|[0-9]{3}[0-9]{3}[0-9]{4}">
                            <label for="phone">Phone Number</label>
                        </div>
                    </div>
                    <div class="card p-3 my-1">
                        <div class="contact form-floating">
                            <textarea class="form-control" id="message" name="message"
                                placeholder="" required></textarea>
                            <label for="message">
                                Message <span class="text-danger">*</span>
                            </label>
                        </div>
                    </div>
                    <div class="card p-3 my-1">
                        <button class="btn btn-success py-2 border" id="submit-contact">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-lg-3">
            </div>
        </div>
    </main>
</body>
</html>