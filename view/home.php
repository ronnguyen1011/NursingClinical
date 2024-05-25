<?php
// store the current page's title for dynamic HTML generation
$currPageTitle = "Home";
require "nav.php";
?>
<?php
session_start(); // Ensure session is started to check the Admin session variable

// Function to handle file removal
if (isset($_POST["submit_remove"]) && isset($_POST["fileToRemove"])) {
    $slideshow_folder = $_SERVER['DOCUMENT_ROOT'] . '/public_html/NursingClinical/nursing-images/slideshow/';
    $fileToRemove = $_POST["fileToRemove"];
    $file_path = $slideshow_folder . $fileToRemove;

    // Check if the file exists and remove it
    if (file_exists($file_path)) {
        unlink($file_path);
        echo "<script>alert('File removed successfully');</script>";
    } else {
        echo "<script>alert('File does not exist');</script>";
    }
}

$status = "";

// Function to handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_upload"])) {
    $target_dir = $_SERVER['DOCUMENT_ROOT'].'/public_html/NursingClinical/nursing-images/slideshow/';
    $validTypes = array('jpg', 'jpeg', 'png', 'gif');
    $uploadOk = 1;

    foreach ($_FILES["fileToUpload"]["name"] as $key => $name) {
        $target_file = $target_dir . basename($name);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file type is valid
        if (!in_array($imageFileType, $validTypes)) {
            $status = '<p class="text-danger">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>';
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $status = '<p class="text-danger">Sorry, file already exists.</p>';
            $uploadOk = 0;
        }

        // Check file size (optional)
        if ($_FILES["fileToUpload"]["size"][$key] > 5000000) { // 5MB limit
            $status = '<p class="text-danger">Sorry, your file is too large.</p>';
            $uploadOk = 0;
        }

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
                $status = '<p class="text-danger">The file '. htmlspecialchars(basename($name)). ' has been uploaded.</p>';
            } else {
                $status = '<p class="text-danger">Sorry, there was an error uploading your file.</p>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $currPageTitle; ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css">
    <script>
        function validateFiles() {
            const fileInput = document.getElementById('fileToUpload');
            const files = fileInput.files;
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];

            for (let i = 0; i < files.length; i++) {
                if (!validTypes.includes(files[i].type)) {
                    alert('Only JPG, JPEG, PNG & GIF files are allowed.');
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
<main class="container" id="requirements">
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
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
            if (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == 1) {
                $slideshow_folder = $_SERVER['DOCUMENT_ROOT'] . '/public_html/NursingClinical/nursing-images/slideshow/';
                $slideshow_files = array_diff(scandir($slideshow_folder), array('.', '..'));

                echo '<link rel="stylesheet" type="text/css" href="styles.css">
                    <div class="container">
                        <div class="row justify-content-center form-container">
                            <div class="col-md-6">
                                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateFiles()">
                                    <h5 for="fileToUpload" class="label-text text-center">Choose files to upload to slideshow:</h5>
                                    <input type="file" name="fileToUpload[]" id="fileToUpload" class="file-input" accept="image/*" multiple><br>'
                                . $status .
                                '<input type="submit" value="Upload Files" name="submit_upload" class="btn btn-primary btn-block mt-3">
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center">Remove Pictures from Slideshow</h5>
                                <form action="home.php" method="post" onsubmit="return confirmFileRemoval()">
                                    <div class="form-group">
                                        <label for="fileToRemove">Select a file to remove:</label>
                                        <select name="fileToRemove" id="fileToRemove" class="form-control" onchange="updateViewPictureLink()">';
                            $picture_view= "https://" . $_SERVER['HTTP_HOST'] . "/NursingClinical/nursing-images/slideshow/";
                            $selected_option = isset($_POST['fileToRemove']) ? $_POST['fileToRemove'] : '';
                            foreach ($slideshow_files as $file) {
                                echo '<option value="' . $file . '">' . $file . '</option>';
                            }
                            echo '</select>
                                </div>
                                <input type="submit" value="Remove File" name="submit_remove" class="btn btn-danger btn-block">
                                <div id="viewPictureLink">
                                    <p>Select an option to view picture</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
        <div class="col-md-1 col-lg-2"></div>
        <script>
            function updateViewPictureLink() {
                const fileSelect = document.getElementById('fileToRemove');
                const selectedFile = fileSelect.options[fileSelect.selectedIndex].value;
                const pictureView = 'https://' + window.location.host + '/NursingClinical/nursing-images/slideshow/';
                const viewPictureLink = document.getElementById('viewPictureLink');
                viewPictureLink.innerHTML = '<a href="' + pictureView + selectedFile + '" target="_blank">View Picture:</a>'+ " " +selectedFile;
            }
        </script>
    </div>
</main>
<?php
// display site footer
require_once(LAYOUTS_PATH . "/nursing-footer.php");
?>
<!--Include script that sets up "Collapse All" requirements button-->
<script src="/js/collapse-accordion-items.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmFileRemoval() {
        if (confirm('Do you want to delete the picture?')) {
            return true;
        }
        return false;
    }
</script>
</body>
</html>
