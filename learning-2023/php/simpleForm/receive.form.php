<!DOCTYPE html>
<html land ="fin">

<!------------- HEAD STARTS -------------------->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet" >
</head>

<!-------------- BODY STARTS --------------------->
<body>

<header>
<h1>Henkilökohtaiset tiedot</h1>
</header>

<?php 
echo "Onnistuit rekisteröitymään onnistuneesti! "
?>


</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Open file for writing
    $file = fopen('addresslist.csv', 'a');

    if (file_exists($file == false)) {
        echo "Tiedostoa 'addresslist.csv' ei ole olemassa tai sen osoite on väärä...";
    }

    // Check if file is able to open
    if ($file === false) {
        echo "Virhe: Tiedostoa 'addresslist.csv' ei voitu avata.";
        exit();
    }

    // Store the data into a variable
    $data = array($_POST['nimi'], $_POST['lahiosoite'], $_POST['postinro'], $_POST['postitp'], $_POST['sahkop']);

    // Write data into a csv file
    fputcsv($file, $data);

    // Close the csv file
    fclose($file);
}
?>
