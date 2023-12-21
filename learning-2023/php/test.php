<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$array = [
    ["12345", "Lohikäärme", "Laavaluola 5"],
    ["12346", "Papukaija", "Hedelmäpuu 2"],
    ["12347", "Koala", "Eukalyptuspuu 7"]
];

foreach ($array as $key => $row) {
    echo $key;
    echo $row;
}

?>