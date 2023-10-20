<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="icon" type="image/x-icon" href="/gecko-images/geckos-logo.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/practice.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2 col-lg-4">
        </div>
        <div class="col-12 col-md-8 col-lg-4">
            <div class="card text-center mt-3">
                <?php
                // Get the customer name and pizza size inputs
                $customerName = $_POST["customer-name"];
                $pizzaSize = $_POST["pizza-size"];

                // Check if order data is present in $_POST
                if( isset($customerName) && isset($pizzaSize)) {
                ?>
                    <ul class="list-group list-group-flush">
                        <!--Display customer name-->
                        <?php echo "<li class='list-group-item h1 mb-0'>" . $customerName . "</li>" ?>

                        <!--Display pizza size-->
                        <?php echo "<li class='list-group-item h3 mb-0'> Pizza Size: " . $pizzaSize . "</li>"  ?>

                        <!--Display selected toppings-->
                        <li class='list-group-item'>
                            <h3>Toppings:</h3>
                            <ul class="list-group list-group-flush">
                                <?php
                                // if the customer wanted no cheese
                                if( isset($_POST["no-cheese"]) ) {
                                    // display cheese
                                    echo "<li class='list-group-item'>" . "No Cheese" . "</li>";
                                }

                                // if the customer wanted half cheese
                                if( isset($_POST["half-cheese"]) ) {
                                    // display cheese
                                    echo "<li class='list-group-item'>" . "Half Cheese" . "</li>";
                                }

                                // if the customer wanted cheese
                                if( isset($_POST["cheese"]) ) {
                                    // display cheese
                                    echo "<li class='list-group-item'>" . "Cheese" . "</li>";
                                }

                                // if the customer wanted parmesan
                                if( isset($_POST["parmesan"]) ) {
                                    // display parmesan
                                    echo "<li class='list-group-item'>" . "Parmesan" . "</li>";
                                }
                                ?>
                            </ul>
                        </li>

                        <!--Display pizza cost-->
                        <?php
                        echo "<li class='list-group-item h3 mb-0'>Total Cost: $";
                        if($pizzaSize == "S") {
                            echo "20.99";
                        }
                        elseif($pizzaSize == "M") {
                            echo "35.99";
                        }
                        elseif($pizzaSize == "L") {
                            echo "55.99";
                        }
                        echo "</li>";
                        ?>
                    </ul>
                <?php
                }

                else {
                    echo "<li class='list-group-item h2 p-3 mb-0'><a class='nav-link' href='/practice/pizza-ordering'>" . "Click here to order" . "</a></li>";
                }
                ?>
            </div>
        </div>
        <div class="col-md-2 col-lg-4">
        </div>
    </div>
</div>
</body>
</html>