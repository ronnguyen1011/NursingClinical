<?php
// Store the current page's title for dynamic HTML generation
$currPageTitle = "Discussion Board"; // Update the page title accordingly
require "nav.php";
?>

<body>
<main class="container" id="discussion-board">
    <div class="row">
        <div class="col-md-2 col-lg-3">
        </div>
        <!-- Page Title -->
        <div class="col-12 col-md-8 col-lg-6">
            <h1 class="card col-12 py-3 mb-1 text-center">
                Green River College Nursing Program Discussion Board
            </h1>
            <!-- Page description -->
            <div class="card my-2 notes">
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item text-break px-2">
                        <strong>
                            Welcome to the Green River College Nursing Program Discussion Board! This platform is
                            designed for students, faculty, and staff to engage in discussions, ask questions, and
                            share insights related to the Nursing Program.
                        </strong>
                    </li>
                </ul>
            </div>
            <!-- Categories -->
            <section id="categories" class="my-2">
                <h2>Categories</h2>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#general">General Discussion</a></li>
                    <li class="list-group-item"><a href="#coursework">Coursework</a></li>
                    <li class="list-group-item"><a href="#clinical">Clinical Experiences</a></li>
                    <li class="list-group-item"><a href="#career">Career Opportunities</a></li>
                    <li class="list-group-item"><a href="#support">Support and Resources</a></li>
                </ul>
            </section>
            <!-- Featured Discussion -->
            <section id="featured-discussion" class="my-2">
                <h2>Featured Discussion</h2>
                <div class="discussion card">
                    <h3>[Topic Title]</h3>
                    <p>[Brief description or snippet of the discussion]</p>
                </div>
            </section>
            <!-- Recent Discussions -->
            <section id="recent-discussions" class="my-2">
                <h2>Recent Discussions</h2>
                <div class="discussion card">
                    <h3>[Topic 1]</h3>
                    <p>[Brief description or snippet of the discussion]</p>
                </div>
                <div class="discussion card">
                    <h3>[Topic 2]</h3>
                    <p>[Brief description or snippet of the discussion]</p>
                </div>
                <div class="discussion card">
                    <h3>[Topic 3]</h3>
                    <p>[Brief description or snippet of the discussion]</p>
                </div>
            </section>
        </div>
    </div>
    <div class="col-md-3"></div>
</main>
<?php
// Display site footer
require_once(LAYOUTS_PATH . "/nursing-footer.php");
?>
</body>
</html>
