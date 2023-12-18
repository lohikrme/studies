<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>

  <head><title>Näytä lomakkeen tiedot</title></head>
  <body>
    <p>
      Lomake:
      <strong><?php
        echo $_SERVER['HTTP_REFERER'];
      ?></strong>

    </p>
    <?php 
      if (count($_GET) > 0) {
    ?>
    <table border="1">
      <caption>GET</caption>
      <tbody>

      <?php
        foreach ($_GET as $nimi => $arvo) {
          $arvo = htmlspecialchars($arvo);
          echo "<tr><td>$nimi</td><td>$arvo</td></tr>\n";
        }
      ?>
      </tbody>

    </table>
    <?php
      }
      if (count($_POST) > 0) {
    ?>
    <table border="1">
      <caption>POST</caption>
      <tbody>

      <?php
        foreach ($_POST as $nimi => $arvo) {
          $arvo = htmlspecialchars($arvo);
          echo "<tr><td>$nimi</td><td>$arvo</td></tr>\n";
        }
      ?>
      </tbody>

    </table>
    <?php
      }
     ?>
  </body>
</html>