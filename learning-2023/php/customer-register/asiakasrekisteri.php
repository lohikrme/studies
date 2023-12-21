<?php
	
// start script
main();
	

// depending whether mode is save, delete or other, begin corressponding function(s)
function main() {	

	$mode = trim(strip_tags($_GET["mode"]));
	$id = trim(strip_tags($_GET["asiakasnumero"])); 
	$name = trim(strip_tags($_GET["nimi"]));
	$address = trim(strip_tags($_GET["osoite"]));
    
    // some forms use 'asiakas' as id, so if id was not given via 'asiakasnumero', that that
    if ($id == "") {
        $id = trim(strip_tags($_GET["asiakas"]));
    }
		
    if ($mode == "save") {
        addNewCustomer($id, $name, $address);
    }
    elseif ($mode == "delete") {
        deleteCustomer($id);
    }
    else {
        showCustomerInformation($id);
    }
	
}

// if id does not already exist, add a customer with given id number and other information
// open file 'asiakasrekisteri.txt' and add there information of new customer
// rows in file should look like: idnumber##name##address e.g 12345##JoeBiden##WhiteHouse   
function addNewCustomer($id, $name, $address) {
    
    // read file to array
    $array = fileToArray("asiakasrekisteri.txt");

    // check if id exists already
    $idAlreadyExists = checkIfIdAlreadyExists($id, $array);

    // if id was not found, add the new customer to the end of the txt file
    if ($idAlreadyExists == false) {

        $f = fopen("asiakasrekisteri.txt", "a");
        fwrite($f, $id . "##" . $name . "##" . $address . "\n");
        fclose($f);
    }

}

// if id already exists, delete this customer's information (id included)
function deleteCustomer($id) {

    // read file to array
    $array = fileToArray("asiakasrekisteri.txt");

    // check if id exists
    $idAlreadyExists = checkIfIdAlreadyExists($id, $array);

    // if id exists, remove that row from the array, and then overwrite the file with the modified array
    // note array is next form: array = [["12345", "Lohikäärme", "Laavaluola 5"], ["12346", "Papukaija", "Hedelmäpuu 2"]] 
    if ($idAlreadyExists == true) {

        // delete from matrix index $key, which is index for the row
        foreach ($array as $key => $row) {
            if ($row[0] == $id) {
                unset($array[$key]);
            }
        }

        $f = fopen("asiakasrekisteri.txt", "w");
        foreach ($array as $row) {
            fwrite($f, $row[0] . "##" . $row[1] . "##" . $row[2] . "\n");
        }
        fclose($f);
    }
}

// if id already exists, print information of that customer
function showCustomerInformation($id) {
    
    // read file to array
    $array = fileToArray("asiakasrekisteri.txt");

    // check if id exists
    $idAlreadyExists = checkIfIdAlreadyExists($id, $array);

    if ($idAlreadyExists) {
        foreach ($array as $row) {
            if ($row[0] == $id) {
                echo "Asiakas: " . $row[1] . ", " .  $row[2];
            }
        }

    }
}

// before can add customer, check if id already exists
function checkIfIdAlreadyExists($id, $array) {
    $alreadyExists = false;
    foreach($array as $row) {
        if ($row[0] == $id) {
            $alreadyExists = true;
            return $alreadyExists;
        }
    }
    return $alreadyExists;
}

// read a txt file and return it as an array, elements separated per row by '##'
function fileToArray($filename) {
    $array = array();
    $f = fopen($filename, "r");
    while (!feof($f)) {
        $line = fgets($f, 1024);
        if ($line != "") {
            $row = explode("##", $line);
            $array[] = $row;
        }
    }
    fclose($f);
    return $array;
}

?>