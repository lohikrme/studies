<?php
  $kiinnostukset = array('kalastus', 'metsästys', 'puutarhanhoito', 'huilaus');
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <title>Henkilötiedot</title>

  </head>
  <body>
    <form action="esikatselu.php" method="post">
      <table>
        <tr>
          <td>Nimi:</td>

          <td><input type="text" name="nimi"></td>
        </tr>
        <tr>
          <td>Lähiosoite:</td>
          <td><input type="text" name="lahiosoite"></td>

        </tr>
        <tr>
          <td>Postinumero:</td>
          <td><input type="text" name="postinro" size="6">
            Toimipaikka: <input type="text" name="postitp" size="20">

          </td>
        </tr>
        <tr>
          <td>Sähköposti:</td>
          <td><input type="text" name="sahkop"></td>

        </tr>
      </table>
      <p>
        Kiinnostuksen kohteesi:<br>
        <?php
          for ($i = 0; $i < count($kiinnostukset); $i++) {
            echo "<input type=\"checkbox\" name=\"kiinnostus$i\">\n";
            echo $kiinnostukset[$i] . "<br>\n";
          }
        ?>

      </p>
      <p>
        <input type="submit" value="Lähetä">
        <input type="reset" value="Tyhjennä">
      </p>
    </form>

  </body>
</html>