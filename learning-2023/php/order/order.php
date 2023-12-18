<?php

$lukujono = "8,65,5,32,76,8,43,32,47,9,34,432,8,9,54,2,54,67,7,332,76,8";
$taulukko = explode(',',$lukujono);

    echo "Järjestys aluksi: $lukujono\n";

	
$jarjestettyTaulukko = array(); // Uusi taulukko, johon siirretään arvot

while (count($taulukko) > 0) {
    $pienin = $taulukko[0];
    $pieninIndeksi = 0;
    
    for ($i = 1; $i < count($taulukko); $i++) {
        if ($taulukko[$i] < $pienin) {
            $pienin = $taulukko[$i];
            $pieninIndeksi = $i;
        }
    }
    
    $jarjestettyTaulukko[] = $pienin;
    unset($taulukko[$pieninIndeksi]);
    $taulukko = array_values($taulukko);
}

# alusta muuttujat ja lisää niihin arvot pienimmästä isoimpaan

$pienin_suurin = "";
$suurin_pienin = "";

foreach($jarjestettyTaulukko as $arvo) {
    $pienin_suurin = $pienin_suurin . $arvo . ",";
}

$jarjestettyTaulukko2 = array_reverse($jarjestettyTaulukko);

foreach($jarjestettyTaulukko2 as $arvo) {
    $suurin_pienin = $suurin_pienin . $arvo . ",";
}

$pienin_suurin = substr($pienin_suurin, 0, -1);
$suurin_pienin = substr($suurin_pienin, 0, -1);


echo "Suurimmasta pienimpään: $suurin_pienin\n";
echo "Pienimmästä suurimpaan: $pienin_suurin\n";

?>