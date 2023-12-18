<?php

// import student id number and stop program if ID is not following rules
$id = trim(strip_tags($_GET["opiskelija"]));
if (!ctype_digit($id)) {
	echo "Numero saa sisältää vain yhden kokonaisluvun, esim. '1234'";
	exit();
}

// open file, close program if cant find or open the file
	
$students = fopen("opiskelijat.txt", "r");

if (!$students) {
	die("Unable to open 'opiskelijat.txt' file");
}

// run through all rows of file, and print info if id match, if no match, find cant find anyone

$match = false;
$activeStudent = false;

while(!feof($students)) {
	$row = explode("|", fgets($students));
	if ($row[0] == $id) {
		$match = true;
		if ($row[2] == 1) {
		$activeStudent = true;	
		}
		if ($activeStudent) {
			echo "$row[1]($row[0]): ilmoittautunut";
		}
		else {
			echo "$row[1]($row[0]): ei ole ilmoittautunut";	
		}
	}
}

if (!$match) {
	echo "Opiskelijanumerolla ei löytynyt ketään!";
}
	
?>