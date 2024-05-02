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
                                pattern="[0-9]{3} [0-9]{3} [0-9]{4}|[0-9]{3}-[0-9]{3}-[0-9]{4}|[0-9]{3}[0-9]{3}[0-9]{4}">
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
                </form>
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