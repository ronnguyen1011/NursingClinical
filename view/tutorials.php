<?php
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
                <!-- Video Tutorials in cards NO accordion -->
                <!-- <div class="card p-3 my-1">
                    <h2 class="text-center">Video One</h2>
                    <div style="text-align: center">
                        <iframe width="400" height="225" src="https://www.youtube.com/embed/BHACKCNDMW8?si=WIQpL48arvwzleYU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="card p-3 my-1">
                    <h2 class="text-center">Video Two</h2>
                    <div style="text-align: center">
                        <iframe width="400" height="225" src="https://www.youtube.com/embed/mdoZdXBpYzU?si=r9yQgkkDJ0w9GjQq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                </div> -->

                <div class="card col-12 my-2 p-3 d-none" id="collapse-tutorials-container">
                    <button id="collapse-tutorials" class="btn btn-success w-100 py-2 border">
                        Collapse All Tutorials
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-expand" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                        </svg>
                    </button>
                </div>
                <div class="accordion mb-2 my-2" id="tutorials-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header text-center">
                            <button class="accordion-button collapsed" type="button" id="collapse-video-0" data-bs-toggle="collapse" data-bs-target="#video-0" aria-expanded="false" aria-controls="video-0">
                                Video One
                            </button>
                        </h2>
                        <div id="video-0" class="accordion-collapse collapse" style="text-align: center">
                            <div class="accordion-body">
                            <iframe width="400" height="225" src="https://www.youtube.com/embed/mdoZdXBpYzU?si=r9yQgkkDJ0w9GjQq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header text-center">
                            <button class="accordion-button collapsed" type="button" id="collapse-video-1" data-bs-toggle="collapse" data-bs-target="#video-1" aria-expanded="false" aria-controls="video-1">
                                Video Two
                            </button>
                        </h2>
                        <div id="video-1" class="accordion-collapse collapse" style="text-align: center">
                            <div class="accordion-body">
                                <iframe width="400" height="225" src="https://www.youtube.com/embed/BHACKCNDMW8?si=WIQpL48arvwzleYU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    // display site footer
    require_once(LAYOUTS_PATH . "/nursing-footer.Controller");
    ?>

    <!--Include script that sets up "Collapse All" tutorials button-->
    <script src="../js/collapse-accordion-items.js"></script>
</body>
</html>
