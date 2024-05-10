<?php
// store the current page's title for dynamic HTML generation
$currPageTitle = "Home";
require "nav.php";
?>
<?php
//$folder = $_SERVER['DOCUMENT_ROOT'].'/NursingClinical/nursing-images/slideshow';
//echo $folder;
//$files = scandir($folder);
//$imageFilenames = array_diff($files, array('..', '.')); // Exclude . and .. from the list
?>

<body>
    <main class="container" id="requirements">
        <div class="row">
            <div class="col-md-1 col-lg-2">
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <!-- Welcome Message -->
                <h1 class="card col-12 py-3 mb-1 text-center">
                    Welcome to the Green River College Nursing Program Portal
                </h1>
                <!-- Carousel slideshow -->
                <div id="carouselExample" class="carousel slide card col-12 my-2 text-center">
                    <div class="carousel-indicators">
                        <?php
                        $folder = $_SERVER['DOCUMENT_ROOT'].'/public_html/NursingClinical/nursing-images/slideshow/';
                        $file_list = glob($folder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                        $total_files = count($file_list);

                        for ($i = 0; $i < $total_files; $i++) {
                            $active_class = ($i == 0) ? 'active' : '';
                            echo '<button type="button" data-bs-target="#carouselExample" data-bs-slide-to="' . $i . '" class="' . $active_class . '"></button>';
                        }
                        ?>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        foreach ($file_list as $index => $file) {
                            $trimmed_file = str_replace($_SERVER['DOCUMENT_ROOT'].'/public_html', '', $file);
                            $active_class = ($index == 0) ? 'active' : '';
                            echo '<div class="carousel-item ' . $active_class . '">';
                            echo '<img src="' . $trimmed_file . '" class="d-block w-100" alt="Slide ' . ($index + 1) . '">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Card with content -->
                <div class="card col-12 my-2">
                    <div class="card-body text-center">
                        <p class="card-text">Here to provide a wide variety of health career training opportunities to
                            improve patient care through training for individuals to advance in their nursing profession journey.</p>
                    </div>
                </div>
                <?php
                if ($_SESSION["Admin"] == 1) {
                    $slideshow_folder = $_SERVER['DOCUMENT_ROOT'] . '/public_html' . '/NursingClinical/nursing-images/slideshow/';
                    $slideshow_files = array_diff(scandir($slideshow_folder), array('.', '..'));

                    echo '<link rel="stylesheet" type="text/css" href="styles.css">
                            <div class="container">
                                <div class="row justify-content-center form-container">
                                    <div class="col-md-6">
                                        <form action="upload.php" method="post" enctype="multipart/form-data">
                                            <h5 for="fileToUpload" class="label-text text-center">Choose files to upload to slideshow:</h5>
                                            <input type="file" name="fileToUpload[]" id="fileToUpload" class="file-input" multiple><br>
                                            <input type="submit" value="Upload Files" name="submit" class="btn btn-primary btn-block mt-3">
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-center">Remove Pictures from Slideshow</h5>
                                        <form method="post">
                                            <div class="form-group">
                                                <label for="fileToRemove">Select a file to remove:</label>
                                                <select name="fileToRemove" id="fileToRemove" class="form-control">';
                                                foreach ($slideshow_files as $file) {
                                                    echo '<option value="' . $file . '">' . $file . '</option>';
                                                }
                                                echo '</select>
                                            </div>
                                            <input type="submit" value="Remove File" name="submit" class="btn btn-danger btn-block">
                                        </form>
                                    </div>
                                </div>
                            </div>';

                    if (isset($_POST["submit"]) && isset($_POST["fileToRemove"])) {
                        $fileToRemove = $_POST["fileToRemove"];
                        $file_path = $slideshow_folder . $fileToRemove;

                        // Check if the file exists
                        if (file_exists($file_path)) {
                            echo '<script>
                                    if (confirm("Do you want to remove ' . $fileToRemove . '?")) {
                                        // If user confirms, perform file deletion
                                        window.location.reload();
                                    }
                                  </script>';

                            // Perform file deletion if confirmed
                            unlink($file_path);
                        }
                    }
                }
                ?>


                <!-- End of Card with content -->
            </div>
            <div class="col-md-1 col-lg-2">
            </div>
        </div>
    </main>
    <?php
    // display site footer
    require_once(LAYOUTS_PATH . "/nursing-footer.php");
    ?>

    <!--Include script that sets up "Collapse All" requirements button-->
    <script src="/js/collapse-accordion-items.js"></script>
    </body>
    </html>
