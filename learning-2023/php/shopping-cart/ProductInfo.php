<?php
  $tiedosto = 'products.txt';
  if (!file_exists($tiedosto)) die('Tuoteluetteloa ei löydy!');
  $TUOTTEET = lue_tuotteet($tiedosto);
  
  function lue_tuotteet($tied) {
    $tuotteet = array();
    // avataan tiedosto lukemista varten
    $viite = fopen($tied, 'r');
    // fgets palauttaa arvon FALSE, jos tiedosto on lopussa
    while ($rivi = fgets($viite, 1024)) {
      $rivi = trim($rivi);
      if ($rivi == '') continue;
      // jaetaan rivi taulukoksi
      $rivi = explode(';', trim($rivi));
      $tunnus = (int) $rivi[0];
      $nimi = $rivi[1];
      $hinta = (float) $rivi[2];
      // siirretään tiedot tuotetaulukkoon
      $tuotteet[$tunnus] = array('nimi' => $nimi, 'hinta' => $hinta);
    }
    return $tuotteet;
  }
?>