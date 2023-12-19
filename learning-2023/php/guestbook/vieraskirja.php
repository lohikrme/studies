<?php

// define all functions here

// -----------------------------------------------------------------------------------
// MAIN FUNCTION:
// depending on mode, save a new person/message and read or read existing persons/messages
function main() {

    // first import all get variables
    $mode = trim(strip_tags($_GET["mode"]));
    $person = trim(strip_tags($_GET["lahettaja"]));
    $message = trim(strip_tags($_GET["viesti"]));

    $person = str_replace("|", "", $person);
    $message = str_replace("|", "", $message);

    if (strlen($person) < 1 or strlen($message) < 1) {
        echo "Nimi tai viesti jäi puuttumaan eikä siksi niitä tallenneta vieraskirjaan.";
        exit();
    }

    if ($mode == "save") {
        // save only
        saveMessage($person, $message);
    }
    else {
        // print file, no save new message
        printFile();
    }
}


// save person and message here
function saveMessage($person, $message) {
    $f = fopen("vieraskirja.txt", "a") or die ("Unable to open 'vieraskirja.txt' file!");
    fwrite($f, "$person|$message\n" );
    fclose($f);
}


// do the printing here
function printFile() {
    $f = fopen("vieraskirja.txt", "r") or die ("Unable to open 'vieraskirja.txt' file!");
    while (!feof($f)) {
        $line = fgets($f, 1024);
        if ($line == "") {
            exit();
        }
        else {
            $row = explode("|", $line);
            $localPerson = $row[0];
            $localMessage = $row[1];
            echo "$localPerson: $localMessage <br>";
        }
    }
    fclose($f);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // start script
    main();
    ?>
</body>
</html>