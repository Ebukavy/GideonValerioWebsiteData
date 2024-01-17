<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars for Sale</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        section {
            padding: 20px;
        }

        .car-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .car-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            width: 30%;
            box-sizing: border-box;
            background-color: #fff;
            position: relative;
        }

        .car-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .details-section {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            z-index: 1;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .button {
            width: 48%;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            position: relative;
            z-index: 2;
            background-color: #4CAF50;
        }

        .buy {
            width: 48%;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            position: relative;
            z-index: 2;
            background-color: #008CBA;
        }

        .back-button {
            display: block;
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 10px;
            background-color: #444;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <h1>Available Cars for Sale</h1>
        <a href="home.php" class="back-button">Back</a>
    </header>

    <section>
        <div class="car-container">

        <?php
$cars = array(
    array("Model" => "BMW 3 Series", "Price" => "$2,000/y", "Details" => "details1.php", "Rent" => "buy1.php", "Image" => "car1.png", "Year" => 2023, "LicensePlate" => "ABC123", "Availability" => "In Stock"),
    array("Model" => "AUDI TT", "Price" => "$2,500/y", "Details" => "details2.php", "Rent" => "buy2.php", "Image" => "car2.png", "Year" => 2022, "LicensePlate" => "XYZ789", "Availability" => "Sold Out"),
    array("Model" => "Mercedes-Benz GLK-Class", "Price" => "$3,000/y", "Details" => "details3.php", "Rent" => "buy3.php", "Image" => "car3.png", "Year" => 2023, "LicensePlate" => "DEF456", "Availability" => "In Stock"),
    array("Model" => "Mercedes-Benz C-Class", "Price" => "$2,000/y", "Details" => "details4.php", "Rent" => "buy4.php", "Image" => "car4.png", "Year" => 2022, "LicensePlate" => "GHI789", "Availability" => "In Stock"),
    array("Model" => "Lightning Mc-Queen", "Price" => "$999,999/d", "Details" => "details5.php", "Rent" => "buy5.php", "Image" => "car5.png", "Year" => "N/A", "LicensePlate" => "N/A", "Availability" => "In Stock"),
    array("Model" => "Mercedes-Benz GLS", "Price" => "$1,800/y", "Details" => "details6.php", "Rent" => "buy6.php", "Image" => "car6.png", "Year" => 2022, "LicensePlate" => "JKL012", "Availability" => "In Stock")
);
foreach ($cars as $car) {
    echo '<div class="car-card">';
    echo '<img src="' . $car["Image"] . '" alt="' . $car["Model"] . '" class="car-image">';
    echo '<h2>' . $car["Model"] . '</h2>';
    echo '<div class="details-section">';
    echo '<p><strong>Details for ' . $car["Model"] . ':</strong></p>';
    echo '<p>Price: ' . $car["Price"] . '</p>';
    echo '<p>Model: ' . $car["Model"] . '</p>';
    echo '<p>Year: ' . $car["Year"] . '</p>';
    echo '<p>License Plate: ' . $car["LicensePlate"] . '</p>';
    echo '<p>Availability: ' . $car["Availability"] . '</p>';
    echo '</div>';
    echo '<div class="button-container">';
    echo '<a href="#" class="button buy" onclick="getRentalDates(\'' . $car["Model"] . '\', \'' . $car["Price"] . '\')">Rent</a>';
    echo '<a href="#" class="button details" onclick="toggleDetails(this)">Details</a>';
    echo '</div>';
    echo '</div>';
}
?>
</div>
    </section>
    <script>
    function toggleDetails(button) {
        var card = button.closest('.car-card');
        var detailsSection = card.querySelector('.details-section');
        detailsSection.style.display = (detailsSection.style.display === "block") ? "none" : "block";
        event.preventDefault();
    }

    function getRentalDates(model, price) {
        var startDate = prompt("Enter the starting date (DD-MM-YYYY):", "");
        var endDate = prompt("Enter the ending date (DD-MM-YYYY):", "");
        if (startDate !== null && endDate !== null && isValidDate(startDate) && isValidDate(endDate)) {
            alert("You have rented " + model + " from " + startDate + " to " + endDate + " for " + price);
            window.location.href = "bought.php?action=buy&model=" + encodeURIComponent(model) + "&price=" + encodeURIComponent(price) + "&startDate=" + encodeURIComponent(startDate) + "&endDate=" + encodeURIComponent(endDate);
        } else {
            alert("Please provide valid dates in the DD-MM-YYYY format. Example date: 01-01-2024");
        }
    }

    function isValidDate(dateString) {
        var regex = /^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-\d{4}$/;
        if (!regex.test(dateString)) {
            return false;
        }
        var exampleDate = new Date("2024-01-01");
        var inputDate = new Date(dateString.split("-").reverse().join("-"));
        return inputDate >= exampleDate;
    }
</script>



</body>

</html>