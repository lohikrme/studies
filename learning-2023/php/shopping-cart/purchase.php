<?php
  require('ProductInfo.php');
  session_start();
  $ostettu = false;
  // onko määritelty ostettava tuote
  if (isset($_POST['nro']) and isset($_POST['lkm'])) {
    // onko numero oikein
    $tuotenro = (int) $_POST['nro'];
    $lkm = (int) $_POST['lkm'];
    if (array_key_exists($tuotenro, $TUOTTEET)) {
      // tehdään ostos
      $_SESSION['ostoskori'][$tuotenro] = $lkm;
      $ostettu = true;
    }
  }
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Osta tuote</title>

  </head>

  <body>
    <h1>Ostoskori</h1>

<?php
  if ($ostettu) {
    $nimi = $TUOTTEET[$tuotenro]['nimi'];
    echo "<p>Ostettu $lkm tuotetta \"$nimi\".</p>\n";
  }
?>

    <table border="1">
      <tr><th>Nimi</th><th>À</th><th>Kpl</th><th>Hinta</th></tr>

<?php
  // lasketaan tähän kaikkien ostosten summa
  $summa = 0;
  foreach ($_SESSION['ostoskori'] as $tuotenro => $lkm) {
    $tuote = $TUOTTEET[$tuotenro];
    echo "<tr><td>$tuote[nimi]</td>";
    echo "<td>$tuote[hinta]</td>";
    echo "<td>$lkm</td>";
    $hinta = $tuote['hinta'] * $lkm;
    echo "<td>$hinta</td></tr>\n";
    $summa += $hinta;
  }
?>

    </table>
    <p>Yhteensä: <?= $summa ?> </p>
  </body>
</html>