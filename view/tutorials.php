<?php
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

// Load videos from file or initialize empty array
$filePath = 'videos.json';
if (file_exists($filePath)) {
    $videos = json_decode(file_get_contents($filePath), true);
} else {
    $videos = array();
}

// Check if remove, edit title, or edit URL action is requested
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
    }
}

// store the current page's title for dynamic HTML generation
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
                                    <form style="display: inline;" method="post" action="">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="id" value="<?php echo $video['id']; ?>">
                                        <input type="text" name="title" placeholder="New title">
                                        <button type="submit">Edit Title</button><br><br>
                                    </form>
                                    <form style="display: inline;" method="post" action="">
                                        <input type="hidden" name="action" value="editUrl">
                                        <input type="hidden" name="id" value="<?php echo $video['id']; ?>">
                                        <input type="text" name="url" placeholder="New Embedded Code">
                                        <button type="submit">Edit url</button><br><br>
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
// display site footer
require_once(LAYOUTS_PATH . "/nursing-footer.php");
?>
</body>
</html>

