<?php
  $tiedosto = 'data.txt';
  if (!file_exists($tiedosto)) die('Tuoteluetteloa ei löydy!');
  $TUOTTEET = lue_tuotteet($tiedosto);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <title>Tuoteluettelo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </head>

  <body>
    <h1>Tuoteluettelo</h1>
    <table border="1">
      <thead><tr><th>Tuotenro</th><th>Nimi</th><th>Hinta</th></tr></thead>

      <tbody>
      <?php
        // tulostetaan tuotteet yksi kerrallaan
        foreach($TUOTTEET as $nro => $tuote) {
          echo "<tr><td>$nro</td>";
          echo "<td>$tuote[nimi]</td>";
          echo "<td>$tuote[hinta] </td></tr>\n";
        }
      ?>

      </tbody>
    </table>
  </body>
</html>
<?php
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
      $tunnus = $rivi[0];
      $nimi = $rivi[1];
      $hinta = $rivi[2];
      // siirretään tiedot tuotetaulukkoon
      $tuotteet[$tunnus] = array('nimi' => $nimi, 'hinta' => $hinta);
    }
		fclose($viite);
    return $tuotteet;
  }
?>