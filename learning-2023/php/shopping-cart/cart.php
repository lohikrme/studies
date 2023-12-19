<?php
  require('ProductInfo.php');
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
        // tulostetaan tuotteet yksi kerrallaan käyttäen Heredoc syntaksia
        foreach($TUOTTEET as $nro => $tuote) {
          echo <<<LOMAKE
          <tr><td>$nro</td>
            <td>$tuote[nimi]</td>
            <td>$tuote[hinta] </td>

            <td>
              <form action="purchase.php" method="post">
                <input type="hidden" name="nro" value="$nro">
                <input type="text" name="lkm" size="2" value="1">
                <input type="submit" name="osta" value="Osta">
              </form>

            </td>
          </tr>
LOMAKE;
        }
      ?>
      </tbody>
    </table>
  </body>

</html>