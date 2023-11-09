<?php 
    // connect to DB 
    require '/home/geckosgr/db-connect-nursing.php';

    // setup SELECT Query
    $selectQuery = "SELECT * FROM ClinicalRequirements";

    // execute SELECT Query
    $allRequirements = mysqli_query($dbConnection, $selectQuery);

    // run through rows returned from query
    while ($currRow = mysqli_fetch_assoc($allRequirements)) {
        $title = $currRow["RequirementTitle"];
        $option1 = $currRow["Option1"];

        // echo $option1 . "\n";
    }

    function accordionItem($title, $targetID, $note, $option1, $option2 = "") {
        $accordionContent = "<div class='accordion-item'>";
        
        $accordionContent .= accordionHeader($title, $targetID) . "<div class='accordion-collapse collapse' id='{$targetID}-info'>" . accordionBody($note, $option1, $option2) . "</div>" ;
       
        return $accordionContent .= "</div>";
    }

    function accordionHeader($title, $targetID) {
        $headerContent = "<h2 class='accordion-header'>
                            <button class='accordion-button collapsed' type='button'
                                    data-bs-toggle='collapse' data-bs-target='#{$targetID}-info'
                                    aria-expanded='false' aria-controls='{$targetID}-info'>
                                {$title}
                            </button>
                        </h2>";

        return $headerContent;
    }

    function accordionBody($note, $option1, $option2 = "") {
        $bodyContent = "<div class='accordion-body p-0'>";
        
        if($note != "") {
            $bodyContent .= requirementNotes($note);
        }

        $bodyContent .= requirementData($option1, $option2);

        $bodyContent .= "</div>";

        return $bodyContent;
    }

    function requirementNotes($note) {
        $noteContent = "<div class='requirement-notes'>
                            <ul class='list-group list-group-flush text-center'>
                                <li class='list-group-item'>
                                    {$note}
                                </li>
                            </ul>
                        </div>";

        return $noteContent;
    }

    function requirementData($option1, $option2) {
        $dataContent = "<div class='px-3 m-0 align-middle requirement-data'>";
        $dataContent .= requirementOption($option1);

        if($option2 != "") {
            $dataContent .= "<h3 class='or-row text-center py-2 m-0'>
                                <b>OR</b>
                            </h3>";
            $dataContent .= requirementOption($option2);
        }

        $dataContent .= "</div>";

        return $dataContent;
    }

    function requirementOption($option) {
        $optionTitle = "";
        $optionText = "";
    
        $optionLines = explode("\n", $option);
    
        $optionTitle = trim(array_shift($optionLines));
    
        $optionText = implode("\n", $optionLines);
    
        $optionContent = "<ul class='list-group list-group-flush'>
                            <li class='list-group-item h5 mb-0'>
                                {$optionTitle}
                            </li>";
    
        if ($optionText != "") {
            $optionContent .= "<li class='list-group-item'>
                                    {$optionText}
                                </li>";
        }
    
        $optionContent .= "</ul>";
    
        return $optionContent;
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical Requirements</title>
    <link rel="icon" type="image/x-icon" href="/nursing-images/nursing-logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/nursing-sprint-2.css">

    <!--Implement theme switcher-->
    <script src="/js/theme-switcher.js"></script>
</head>
<body>
    <!--Start of Nav-->
    <nav class="navbar sticky-top navbar-expand-md mb-3 border-bottom">
        <div class="container">
            <div class="navbar-brand">
                <img src="/nursing-images/nursing-logo.png" height="60" alt="GRC Nursing Program founded 1965">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-nav"
                    aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbar-nav">
                <div class="navbar-nav">
                    <a class="nav-link active disabled" href="/sprint-2/requirements.html" aria-current="page">
                        Clinical Requirements
                    </a>
                    <a class="nav-link" href="/sprint-2/experience.html">
                        Experience Survey
                    </a>
                    <a class="nav-link" href="/sprint-2/contact.html">
                        Contact
                    </a>
                    <a class="nav-link" id="theme-switcher">
                        <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
                            <path id="theme-icon" d="M 27.9999 51.9063 C 41.0546 51.9063 51.9063 41.0781 51.9063 28 C 51.9063 14.9453 41.0312 4.0937 27.9765 4.0937 C 14.8983 4.0937 4.0937 14.9453 4.0937 28 C 4.0937 41.0781 14.9218 51.9063 27.9999 51.9063 Z M 27.9999 47.9219 C 16.9374 47.9219 8.1014 39.0625 8.1014 28 C 8.1014 16.9609 16.9140 8.0781 27.9765 8.0781 C 39.0155 8.0781 47.8983 16.9609 47.9219 28 C 47.9454 39.0625 39.0390 47.9219 27.9999 47.9219 Z M 34.7030 33.2031 C 27.6014 33.2031 23.0546 28.75 23.0546 21.6484 C 23.0546 20.1719 23.4530 18.0859 23.8749 16.9844 C 23.9921 16.6797 24.0155 16.4922 24.0155 16.3750 C 24.0155 16.0234 23.7343 15.6250 23.2421 15.6250 C 23.0780 15.6250 22.7968 15.6484 22.4921 15.7656 C 17.6405 17.6875 14.3827 22.9375 14.3827 28.4453 C 14.3827 36.1563 20.2655 41.6641 27.9765 41.6641 C 33.6014 41.6641 38.4530 38.1953 40.1405 33.9531 C 40.2577 33.6484 40.2812 33.3437 40.2812 33.25 C 40.2812 32.7578 39.8827 32.4297 39.5077 32.4297 C 39.3671 32.4297 39.2030 32.4531 38.9452 32.5234 C 37.9609 32.8750 36.3202 33.2031 34.7030 33.2031 Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!--End of Nav-->
    <main class="container" id="requirements">
        <div class="row">
            <div class="col-md-1 col-lg-2">
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <h1 class="col-12 mb-3 text-center">
                    Green River College
                    <br>
                    Nursing Program Clinical Requirements
                </h1>
                <div class="card my-2 notes">
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item text-break px-2">
                            <strong>2660*All vaccination proof must include full name, date of birth, and date of vaccine, titer (blood draw), or test</strong>
                        </li>
                    </ul>
                </div>

                <div class="accordion mb-3 my-2" id="requirements-accordion">
                <?php echo accordionItem("Tuberculosis Test", "tuberculosis-test", "Expires Yearly", "2-step PPD\n- Must be two separate 2-step PPD tests done initially done approximately 2 weeks apart\n- Document must show induration in millimeter, date placed, and date read", "QuantiFERON\n- Results must be negative"); ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#hepatitis-b-titer-info"
                                    aria-expanded="false" aria-controls="hepatitis-b-titer-info">
                                Hepatitis B Titer
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="hepatitis-b-titer-info">
                            <div class="accordion-body p-0">
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item h5 mb-0">
                                            Titer
                                        </li>
                                        <li class="list-group-item">
                                            - Only Anti-HBs or HepB SaB test are accepted
                                        </li>
                                    </ul>
                                    <h3 class="or-row text-center py-2 m-0">
                                        <strong>OR</strong>
                                    </h3>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item h5 mb-0">
                                            Declination Form
                                        </li>
                                        <li class="list-group-item">
                                            - If currently in process of vaccine series or titer, or if non-converter
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#mmr-vaccine-titer-info"
                                    aria-expanded="false" aria-controls="mmr-vaccine-titer-info">
                                MMR Vaccine or Titer
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="mmr-vaccine-titer-info">
                            <div class="accordion-body p-0">
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item h5 mb-0">
                                            2 documented vaccine dates
                                        </li>
                                    </ul>
                                    <h3 class="or-row text-center py-2 m-0">
                                        <strong>OR</strong>
                                    </h3>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item h5 mb-0">
                                            Titer
                                        </li>
                                        <li class="list-group-item">
                                            - Separate titer needed for Measles, Mumps, and Rubella
                                            <br>
                                            - If result is negative/low/equivocal must get booster dose
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#varicella-vaccine-titer-info"
                                    aria-expanded="false" aria-controls="varicella-vaccine-titer-info">
                                Varicella Vaccine or Titer
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="varicella-vaccine-titer-info">
                            <div class="accordion-body p-0">
                                <div class="requirement-notes">
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item">
                                            History of Chickenpox not accepted
                                        </li>
                                    </ul>
                                </div>
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item h5 mb-0">
                                            2 documented vaccine dates
                                        </li>
                                    </ul>
                                    <h3 class="or-row text-center py-2 m-0">
                                        <strong>OR</strong>
                                    </h3>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item h5 mb-0">
                                            Titer
                                        </li>
                                        <li class="list-group-item">
                                            - If result is negative/low/equivocal must get booster dose
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#tdap-vaccine-info"
                                    aria-expanded="false" aria-controls="tdap-vaccine-info">
                                Tdap Vaccine
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="tdap-vaccine-info">
                            <div class="accordion-body p-0">
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            - Date must be within last 10 years
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flu-vaccine-info"
                                    aria-expanded="false" aria-controls="flu-vaccine-info">
                                Flu Vaccine
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="flu-vaccine-info">
                            <div class="accordion-body p-0">
                                <div class="requirement-notes">
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item">
                                            Expires Yearly
                                        </li>
                                    </ul>
                                </div>
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            - Vaccine must be for current season (Sept thru August)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#covid19-vaccine-info"
                                    aria-expanded="false" aria-controls="covid19-vaccine-info">
                                Covid 19 Vaccine Series
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="covid19-vaccine-info">
                            <div class="accordion-body p-0">
                                <div class="requirement-notes">
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item">
                                            Proof must include manufacturer
                                        </li>
                                    </ul>
                                </div>
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            - Pfizer, Moderna, and Janssen are the only ones we accept currently
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#covid-booster-info"
                                    aria-expanded="false" aria-controls="covid-booster-info">
                                Covid Booster
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="covid-booster-info">
                            <div class="accordion-body p-0">
                                <div class="requirement-notes">
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item">
                                            Proof must include manufacturer
                                        </li>
                                    </ul>
                                </div>
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            - Only one dose required currently, but may change in the future
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#cpr-card-info"
                                    aria-expanded="false" aria-controls="cpr-card-info">
                                CPR Card
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="cpr-card-info">
                            <div class="accordion-body p-0">
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            - Must be American Heart Association Basic Life Support
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#professional-liability-info"
                                    aria-expanded="false" aria-controls="professional-liability-info">
                                Professional Liability
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="professional-liability-info">
                            <div class="accordion-body p-0">
                                <div class="px-3 m-0 align-middle requirement-data">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            - <strong>CANNOT</strong> attend lab or clinical prior to purchasing
                                            <br>
                                            - Expires end of each school year (08/31)
                                            <br>
                                            - Purchase at <strong>Cashier’s Office</strong> 253-833-9111 ext. 3399
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card my-2 notes">
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item text-break px-2">
                            <b>If you have any questions about the requirements, you can email me at csavage@greenriver.edu</b>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-1 col-lg-2">
            </div>
        </div>
    </main>
</body>
</html>