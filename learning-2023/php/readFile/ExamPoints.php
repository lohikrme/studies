<?php

	
// open the file
	
$f = fopen("koe.txt", "r") or die("Unable to open 'koe.txt'!");


// calculate amount of ssstudents and average points (ussing total points)

$studentAmount = 0;
$totalPoints = 0;

while (!feof($f)) {
	$line = fgets($f);
	if (trim($line) != "") {
		
		$studentAmount += 1;
		
		$row = explode("|", $line);
		$points = $row[1] + $row[2] + $row[3] + $row[4] + $row[5];
		$totalPoints += $points;
	}
}

fclose($f);

// now we do the final printing, sshowing amount of students and average

echo "Opiskelijoita oli $studentAmount: \n";

$f = fopen("koe.txt", "r") or die("Unable to open 'koe.txt'!");

while (!feof($f)) {
	$line = fgets($f);
	if (trim($line) != "") {
	
		$row = explode("|", $line);
		$points = $row[1] + $row[2] + $row[3] + $row[4] + $row[5];
		$id = $row[0];
		
		echo "$id: $points pistettä \n";
	
	}
}

$average = $totalPoints / $studentAmount;

echo "Opiskelijoiden keskiarvo oli $average pistettä."
	
?>