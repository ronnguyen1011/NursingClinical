<?php
session_start(); // Ensure the session is started

// Function to remove a video
function removeVideo(&$videos, $id) {
    foreach ($videos as $key => $video) {
        if ($video['id'] == $id) {
            unset($videos[$key]);
            return;
        }
    }
}

// Function to edit a video title
function editVideo(&$videos, $id, $newTitle) {
    foreach ($videos as $key => $video) {
        if ($video['id'] == $id) {
            $videos[$key]['title'] = $newTitle;
            return;
        }
    }
}

// Function to edit a video URL
function editVideoUrl(&$videos, $id, $newUrl) {
    foreach ($videos as $key => $video) {
        if ($video['id'] == $id) {
            $videos[$key]['url'] = $newUrl;
            return;
        }
    }
}

// Function to generate a new ID
function generateNewId($videos) {
    $maxId = 0;
    foreach ($videos as $video) {
        if ($video['id'] > $maxId) {
            $maxId = $video['id'];
        }
    }
    return $maxId + 1;
}

// Function to add a new video
function addVideo(&$videos, $title, $url) {
    $id = generateNewId($videos);
    $videos[] = array(
        'id' => $id,
        'title' => $title,
        'url' => $url
    );
}

// Load videos from file or initialize empty array
$filePath = 'videos.json';
if (file_exists($filePath)) {
    $videos = json_decode(file_get_contents($filePath), true);
} else {
    $videos = array();
}

// Check if remove, edit title, edit URL, or add action is requested
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'remove' && isset($_POST['id'])) {
        $id = $_POST['id'];
        removeVideo($videos, $id);
        file_put_contents($filePath, json_encode($videos));
    } elseif (($action === 'edit' || $action === 'editUrl') && isset($_POST['id'])) {
        $id = $_POST['id'];
        if ($action === 'edit' && isset($_POST['title'])) {
            $newTitle = $_POST['title'];
            editVideo($videos, $id, $newTitle);
        } elseif ($action === 'editUrl' && isset($_POST['url'])) {
            $newUrl = $_POST['url'];
            editVideoUrl($videos, $id, $newUrl);
        }
        file_put_contents($filePath, json_encode($videos));
    } elseif ($action === 'add' && isset($_POST['title']) && isset($_POST['url'])) {
        $title = $_POST['title'];
        $url = $_POST['url'];
        addVideo($videos, $title, $url);
        file_put_contents($filePath, json_encode($videos));
    }
}

// Store the current page's title for dynamic HTML generation
$currPageTitle = "Tutorials";
require "nav.php";
?>

<html>
<body>
<main class="container" id="tutorials">
    <div class="row">
        <div class="col-md-2 col-lg-3">
        </div>
        <div class="col-12 col-md-8 col-lg-6">
            <h1 class="card col-12 py-3 mb-1 text-center">
                Video Tutorials
            </h1>
            <!-- Add New Video when logged in as Admin -->
            <?php if (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == 1): ?>
                <div class="card p-3 my-1">
                    <button class="accordion-button mx-auto d-block text-center" type="button" id="collapse-add-video" data-bs-toggle="collapse" data-bs-target="#add-video" aria-expanded="true" aria-controls="add-video">
                        <h2>Add New Video</h2>
                    </button>
                    <div id="add-video" class="accordion-collapse collapse show">
                        <div class="accordion-body px-5">
                            <form method="post" action="">
                                <input type="hidden" name="action" value="add">
                                <div class="mb-3">
                                    <label for="videoTitle" class="form-label">Video Title:</label><br>
                                    <input type="text" class="mx-auto p-1 w-100" name="title" id="videoTitle" placeholder="Enter the title of the video" required>
                                </div>
                                <div class="mb-3">
                                    <label for="videoUrl" class="form-label">Video URL:</label><br>
                                    <input type="text" class="mx-auto p-1 w-100" name="url" id="videoUrl" placeholder="Paste the embedded code of the video" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn w-25 mx-auto btn-primary">Add Video</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Loop through videos and generate HTML dynamically -->
            <?php foreach($videos as $key => $video): ?>
                <div class="card p-3 my-1">
                    <h2 class="text-center">
                        <button class="accordion-button collapsed" type="button" id="collapse-video-<?php echo $key; ?>" data-bs-toggle="collapse" data-bs-target="#video-<?php echo $key; ?>" aria-expanded="false" aria-controls="video-<?php echo $key; ?>">
                            <?php echo $video['title']; ?>
                        </button>
                    </h2>
                    <div id="video-<?php echo $key; ?>" class="accordion-collapse collapse" style="text-align: center">
                        <div class="accordion-body">
                            <div class="ratio ratio-16x9">
                                <?php echo $video['url']; ?>
                            </div>
                            <?php if (isset($_SESSION["Admin"]) && $_SESSION["Admin"] == 1): ?>
                                <div class="form-tutorial">
                                    <p></p>
                                    <form id="edit-form" style="display: inline;" method="post" action="">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="id" value="<?php echo $video['id']; ?>">
                                        <input type="text" name="title" placeholder="New title">
                                        <button type="submit" onclick="return validateForm('title')">Edit Title</button><br><br>
                                    </form>
                                    <form id="editUrl-form" style="display: inline;" method="post" action="">
                                        <input type="hidden" name="action" value="editUrl">
                                        <input type="hidden" name="id" value="<?php echo $video['id']; ?>">
                                        <input type="text" name="url" placeholder="New Embedded Code">
                                        <button type="submit" onclick="return validateForm('url')">Edit URL</button><br><br>
                                    </form>

                                    <form style="display: inline;" method="post" action="">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="id" value="<?php echo $video['id']; ?>">
                                        <button type="submit">Remove</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</main>
<?php
// Display site footer
require_once(LAYOUTS_PATH . "/nursing-footer.php");
?>
<!--- Form Validation for Edit title and Edit url fields --->
<script>
    function validateForm(field) {
        var fieldValue;
        var fieldLabel;
        if (field === 'title') {
            fieldValue = document.forms["edit-form"][field].value;
            fieldLabel = "New Title";
        } else if (field === 'url') {
            fieldValue = document.forms["editUrl-form"][field].value;
            fieldLabel = "New Embedded Code";
        } // if input field is empty display alert
        if (fieldValue == '') {
            alert("Please enter a value for " + fieldLabel);
            return false;
        }
        return true;
    }
</script>
</body>
</html>
