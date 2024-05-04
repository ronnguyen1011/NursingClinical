<?php
    // get access to all PHP helpers
    require_once($_SERVER['DOCUMENT_ROOT'] . "/initial.php");

    // store the current page's title for dynamic HTML generation
    $currPageTitle = "View Entries";

	/**
	 * The name of the current view site
	 */
	$currClinicalSite = "";
	
	/**
	 * The number of submissions processed from DB belonging to the current view site
	 */
	$currSubmissionCount = 0;

	/**
	 * The total number of submissions processed from DB
	 */
	$totalSubmissionCount = 0;

	/**
	 * An array containing the total ratings for each aspect of the current view site:
	 * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
	 */
	$ratingTotals = array(0, 0, 0, 0, 0);

	/**
	 * An array containing formatted submission rows belonging to the current view site
	 */
	$formattedSubmissionRows = array(); 

	/**
     * An array containing the Names of all Clinical Sites that have submission stored in DB
     */
    $allClinicalSiteNames = array();

	/**
     * An array containing a Bootstrap Card for each Clinical Site that has a submission in the DB
     * Each card contains a table with a row for each submission, along with a calculation of 
	 * average ratings for the site at the bottom
     */
	$allClinicalSiteCards = array();

	// get all experience form submissions from DB, ordered by view site,
	// with newest submissions at the top
	$allSubmissions = executeQuery("SELECT * 
									FROM ExperienceFormSubmissions 
									ORDER BY SiteAttended, Seen");

	// run through all returned submissions
	while ($currSubmission = mysqli_fetch_assoc($allSubmissions)) {
		// get the current submission's corresponding view site
		$siteAttended = $currSubmission["SiteAttended"];

		/**
		 * All ratings containing within the current submission:
		 * 0 -> Enjoyed Site
		 * 1 -> Staff Supportive
		 * 2 -> Site Learning Objectives
		 * 3 -> Preceptor Learning Objectives
		 * 4 -> Recommend Site
		 */
		$submissionRatings = array(
			$currSubmission["EnjoyedSite"],
			$currSubmission["StaffSupportive"],
			$currSubmission["SiteLearningObjectives"],
			$currSubmission["PreceptorLearningObjectives"],
			$currSubmission["RecommendSite"]
		);

		// if the current row is the first one being received from DB
		if($totalSubmissionCount == 0) {
			$currClinicalSite = $siteAttended;
		}

		// if the current row belongs to a different 
		// view site than the one tracked
		if($currClinicalSite != $siteAttended) {
			// save the name of the current view site to be used for scrollspy
			$allClinicalSiteNames[] = $currClinicalSite;

			//  save the data for the previous view site in a generated display card
			$allClinicalSiteCards[] = generateClinicalSiteDisplay($formattedSubmissionRows
																	, $currClinicalSite
																	, $currSubmissionCount);

			// track the new site
			$currClinicalSite = $siteAttended;

			// reset other trackers
			$formattedSubmissionRows = array(); 
			$currSubmissionCount = 0;
			resetRatingTotals();
		}

		// update the rating totals with the current submissions ratings
		updateRatingTotals($submissionRatings);

		// a new submission has been tracked
		$currSubmissionCount++;
		$totalSubmissionCount++;

		// update the current submission to be "seen" in the DB, as it is about to be displayed
        executeQuery("UPDATE ExperienceFormSubmissions 
						SET Seen = 1
						WHERE SubmissionID = {$currSubmission['SubmissionID']}");

		// format the data of the current submission row, 
		// and track with other rows belonging to the current view site
		$formattedSubmissionRows[] = generateFormattedSubmissionRow($currSubmission);
	}

	// save the name of the current view site to be used for scrollspy
	$allClinicalSiteNames[] = $currClinicalSite;

	// save the data for the previous view site in a generated display card
	$allClinicalSiteCards[] = generateClinicalSiteDisplay($formattedSubmissionRows
															, $currClinicalSite
															, $currSubmissionCount);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
        // include standard nursing header metadata
        require_once(LAYOUTS_PATH . "/nursing-metadata.php");
    ?>
</head>
<body data-bs-spy='scroll' data-bs-target='#scrollspy' data-bs-smooth-scroll='true'>
	<main class="container mt-3">
		<div class="row">
			<?php if($_SESSION["Admin"]) { ?>
				<div class="col-md-3 col-lg-3">
					<!--Button only accessible on mobile layout, used to toggle scrollspy-->
					<div class="card col-12 d-md-none mb-3 p-3">
						<button id="scrollspy-toggler" class="btn btn-success w-100 py-2 border">
							Go to Clinical Site
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-expand" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
							</svg>
						</button>
					</div>
					<?php 
						// setup "download .csv" button
						$exportButton = "<a class='col-12 btn btn-success py-2 mt-3 w-100 border' id='export-spreadsheet'>
											Export to Spreadsheet
											<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-download' viewBox='0 0 16 16'>
												<path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5'/>
												<path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
											</svg>
										</a>";

						// generate scrollspy to track and link view sites, including the
						// export button above the links
						echo generateBootstrapScrollspy($allClinicalSiteNames
														, "/NursingClinical/view/home.php"
														, $exportButton);
					?>
				</div>
				<div class="col-12 col-md-9 col-lg-9">
					<?php
						/**
						 * Global counter of # of HTML elements tracked by scrollspy
						 */
						$scrollspyElementsCount = 0;

						// run through and display all generated view site cards
						foreach ($allClinicalSiteCards as $currClinicalSiteCard) {
							echo $currClinicalSiteCard;
						}
					?>
				</div>
			</div>
			<?php 
				} 
			
				else {
					echo "<div class='col-md-3 col-lg-3'>
						</div>
						<div class='col-12 col-md-6 col-lg-6'>" 
							. displayAccessDenied("login.php", "Login") .
						"</div>
						<div class='col-md-3 col-lg-3'>
						</div>";
				}
			?>
		</div>
	</main>

	<!--Include dynamic scrollspy for mobile-->
	<script src="/js/responsive-scrollspy-toggle.js"></script>

	<!--Include export to spreadsheet functionality-->
	<script src="/NursingClinical/js/export-to-spreadsheet.js"></script>
</body>
</html>

<?php
	/**
	 * Adds the values in the given $ratings array to the corresponding rating total in $ratingTotals
	 * @param array $ratings An array containing the rating columns of the current experience form submission
	 * @global array $ratingTotals An array containing the total ratings for each aspect of the current view site:
	 * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
	 */
	function updateRatingTotals($ratings) {
		/**
		 * An array containing the total ratings for each aspect of the current view site:
	 	 * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
		 */
		global $ratingTotals;

		for ($i = 0; $i < count($ratings); $i++) {
			$ratingTotals[$i] += $ratings[$i];
		}
	}

	/**
	 * Sets all values in the $ratingTotals array to 0 in preparation to track the totals of a new submission
	 *
	 * @global array $ratingTotals An array containing the total ratings for each aspect of the current view site:
	 * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
	 */
	function resetRatingTotals() {
		/**
		 * An array containing the total ratings for each aspect of the current view site:
	 	 * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
		 */
		global $ratingTotals;

		for ($i = 0; $i < count($ratingTotals); $i++) {
			$ratingTotals[$i] = 0;
		}
	}

	/**
	 * Takes in the given array of data and returns an HTML table row containing the data formatted appropriately
	 * @param array $currSubmission the current experience form submission received from the DB
	 * @return string an HTML table row containing the data formatted appropriately
	 */
	function generateFormattedSubmissionRow($currSubmission) {		
		// format and store the remaining given data in array,
		// each column formatted in a <td>
		$formattedColumns = array(
			"<td class='rating-column value-{$currSubmission["EnjoyedSite"]}'>" 
				. generateStars($currSubmission["EnjoyedSite"]) .          
			"</td>",
			"<td class='rating-column value-{$currSubmission["StaffSupportive"]}'>" 
				. generateStars($currSubmission["StaffSupportive"]) . 
			"</td>",
			"<td class='rating-column value-{$currSubmission["SiteLearningObjectives"]}'>" 
				. generateStars($currSubmission["SiteLearningObjectives"]) . 
			"</td>",
			"<td class='rating-column value-{$currSubmission["PreceptorLearningObjectives"]}'>" 
				. generateStars($currSubmission["PreceptorLearningObjectives"]) . 
			"</td>",
			"<td class='rating-column value-{$currSubmission["RecommendSite"]}'>" 
				. generateStars($currSubmission["RecommendSite"]) . 
			"</td>",
			"<td class='feedback-column'>" 
				. displayFeedback($currSubmission["SiteOrStaffFeedback"], 
								  $currSubmission["InstructorFeedback"]) . 
			"</td>"
		);

		// add all columns to row
		$rowContent = implode("", $formattedColumns);

		// if the current row has not been displayed to an admin user before, setup notifiers
		$seenStatusDisplay = displaySeenStatus($currSubmission["Seen"]);
		$newSubmissionClass = $currSubmission["Seen"] ? "" : " bg-warning";

		// return all <td>'s wrapped in a <tr>
		return "<tr class='text-center{$newSubmissionClass}'>{$seenStatusDisplay}" . $rowContent . "</tr>";
	}

	/**
	 * Generates and returns an HTML td containing a Bootstrap badge if the current submission row has 
	 * not been seen, otherwise an empty td 
	 * @param boolean $seen Whether the current submission has been displayed and seen by an admin before
	 * @return string an HTML td containing a Bootstrap badge if not seen, otherwise an empty td
	 */
    function displaySeenStatus($seen) {
		if(!$seen) {
			return "<td>
						<span class='badge rounded-pill bg-success border'>
							NEW
						</span>
					</td>";
		}

		return "<td></td>";
    }

	/**
	 * Generates a Bootstrap Modal displaying the given feedback (if any). As both fields are optional, only the sections given (not empty) are displayed. If both fields are given as empty, a simple "N/A" is displayed instead
	 * @param string $siteOrStaffFeedback Feedback regarding the view site or the staff working there (Optional)
	 * @param string $instructorFeedback Feedback regarding the students instructor at the view site (Optional)
	 * @global int $totalSubmissionCount Used for Modal ID
	 * @return string a Bootstrap modal displaying the given feedback (if any), along with a corresponding toggle button; otherwise "N/A"
	 */
	function displayFeedback($siteOrStaffFeedback, $instructorFeedback) {
		// grab the view site count for the modal ID
		global $totalSubmissionCount;

		// if feedback was given
		if(!empty($siteOrStaffFeedback) || !empty($instructorFeedback)) {
			// generate and return the modal and corresponding toggle button
			return generateFeedbackModal($siteOrStaffFeedback, $instructorFeedback);
		}

		// otherwise, display a "no feedback" indicator
		else {
			return "N/A";
		}
	}

	/**
	 * Generates and returns a Bootstrap card containing the following content, generated using the given data:
	 * A header displaying the site name, a table containing the given submission rows, and a section of average ratings for the current view site at the bottom
	 * @param array $formattedSubmissionRows The submission rows pulled from the DB belonging to the current view site, formatted appropriately within HTML table rows
	 * @param string $clinicalSiteName The name of the current view site
	 * @param int $submissionCount The number of submissions belonging to the current view site
	 * @return string
	 */
	function generateClinicalSiteDisplay($formattedSubmissionRows, $clinicalSiteName, $submissionCount) {
		/**
		 * An array containing the total ratings for each aspect of the current view site:
	     * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
		 */
		global $ratingTotals;

		/**
         * Global counter of # of HTML elements tracked by scrollspy
         */
        global $scrollspyElementsCount; 

		// add all formatted submission rows together
		$tableContent = implode("", $formattedSubmissionRows);
        
        // another element is tracked by scrollspy
        $scrollspyElementsCount++;

		// generate view site averages using given data
		$averageRatings = generateRatingAverages($ratingTotals, $submissionCount);

		$editModal = generateEditSiteNameModal($clinicalSiteName);

		// generate and return table using given data
		return "<div class='card mb-3 p-3 table-responsive view-site-container' id='spy-{$scrollspyElementsCount}'>
					<div class='container submission-container'>
						<div class='d-flex justify-content-center align-items-center mb-3 gap-1'>
							<h1 class='text-center mb-0'>
								<strong>{$clinicalSiteName}</strong>
							</h1>
							{$editModal}
						</div>
						<table class='table table-bordered table-striped-columns align-middle m-0'>
							<thead>
								<tr class='text-center'>
									<th>Status</th>
									<th>Enjoyed Site</th>
									<th>Staff Supportive</th>
									<th>Site Learning <br> Objectives</th>
									<th>Preceptor Learning <br> Objectives</th>
									<th>Recommend Site</th>
									<th>Feedback</th>
								</tr>
							</thead>
							<tbody>
								{$tableContent}
							</tbody>
						</table>
					</div>
					{$averageRatings}
				</div>";
	}

	/**
	 * 
	 */
	function generateEditSiteNameModal($clinicalSiteName) {
		global $scrollspyElementsCount;

		$modalID = "submission-{$scrollspyElementsCount}-edit-name";
		
		$editButton = "<button type='button' class='btn rounded-5 mt-1' 
							data-bs-toggle='modal' data-bs-target='#{$modalID}'>
							<svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
								<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
								<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
							</svg>
						</button>";

        $editForm = "<form action='/Controller/admin/update-database.php?operation=edit-site-name' method='post'>
						<input type='hidden' name='old-name' value='{$clinicalSiteName}'>
						<div class='input-group'>
							<input type='text' name='new-name' class='form-control' 
								value='{$clinicalSiteName}' aria-label='Clinical Site Name'>
							<button type='submit' class='btn btn-success border'>
								Submit
							</button>
						</div>
					</form>";

        return generateBootstrapModal($modalID, displayStrong("Edit Site Name")
										, $editForm, $editButton);
	}

	/**
	 * Generates a Bootstrap Modal displaying the given feedback. As both fields are optional, only the sections given (not empty) are displayed
	 * @param string $siteOrStaffFeedback Feedback regarding the view site or the staff working there (Optional)
	 * @param string $instructorFeedback Feedback regarding the students instructor at the view site (Optional)
	 * @global int $totalSubmissionCount Used for Modal ID
	 * @return string a Bootstrap modal displaying the given feedback
	 */
	function generateFeedbackModal($siteOrStaffFeedback, $instructorFeedback) {
		global $totalSubmissionCount;
		
		if(empty($siteOrStaffFeedback)) {
			$siteOrStaffFeedback = "N/A";
		}

		if(empty($instructorFeedback)) {
			$instructorFeedback = "N/A";
		}

        $bodyContent = "<h6>" . displayStrong("Site or Staff Feedback") . "</h6>
                        <p>{$siteOrStaffFeedback}</p>
                        <h6>" . displayStrong("Instructor Feedback") . "</h6>
                        <p>{$instructorFeedback}</p>";

        return generateBootstrapModal("submission-{$totalSubmissionCount}-feedback"
										, displayStrong("Feedback")
										, $bodyContent);
	}

	/**
	 * Takes the total rating values for each aspect of a view site, calculates the average for each rating using the calculateRatingAverages function, and formats the result as follows:
	 * A heading of "Average Ratings", a table with column headers, and a single row containing the average ratings for each aspect of the view site
	 * 
	 * @param int $submissionCount The number of submissions belonging to the current view site
	 * @param array $ratingTotals An array containing the total ratings for each aspect of the current view site:
	 * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
	 * @return string HTML content representing the average ratings for each aspect of the view site
	 */
	function generateRatingAverages($ratingTotals, $submissionCount) {
		// calculate and generate the average for each rating, format as a corresponding string of ★'s
		$formattedAverages = calculateRatingAverages($ratingTotals, $submissionCount);

		// place each rating average inside a <td>
		$averagesContent = "";
		for($i = 0; $i < count($formattedAverages); $i++) {
			$averagesContent .= "<td>{$formattedAverages[$i]}</td>";
		}

		// add and return the average ratings in the following HTML structure
		return "<div class='averages-container'>
					<h1 class='text-center my-3'>
						<strong>Average Ratings</strong>
					</h1>
					<table class='table table-bordered table-striped-columns align-middle m-0'>
						<thead>
							<tr class='text-center'>
								<th>Enjoyed Site</th>
								<th>Staff Supportive</th>
								<th>Site Learning <br> Objectives</th>
								<th>Preceptor Learning <br> Objectives</th>
								<th>Recommend Site</th>
							</tr>
						</thead>
						<tbody>
							<tr class='text-center'>
								{$averagesContent}
							</tr>
						</tbody>
					</table>
				</div>";
	}

	/**
	 * Calculates the average rating given to each aspect of the current view site based on the total of each rating and the number of submissions
	 * 
	 * Returns an array containing a string made up of ★'s corresponding to each calculated rating average
	 * For example an average rating of 3 would result in "★★★"
	 * @param array $ratingTotals An array containing the total ratings for each aspect of the current view site:
	 * [Enjoyed Site, Staff Supportive, Site Learning Objectives, Preceptor Learning Objectives, Recommend Site]
	 * @param int $submissionCount The number of submissions belonging to the current view site
	 * @return array an array containing a string made up of ★'s corresponding to each calculated rating average
	 */
	function calculateRatingAverages($ratingTotals, $submissionCount) {
		return array(
			generateStars( round($ratingTotals[0] / $submissionCount) ),
			generateStars( round($ratingTotals[1] / $submissionCount) ),
			generateStars( round($ratingTotals[2] / $submissionCount) ),
			generateStars( round($ratingTotals[3] / $submissionCount) ),
			generateStars( round($ratingTotals[4] / $submissionCount) ),
		);
	}
?>