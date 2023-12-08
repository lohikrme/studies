<!DOCTYPE html>
<html land ="fin">

<!------------- HEAD STARTS -------------------->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet" >
</head>

<!-------------- BODY STARTS --------------------->
<body>

<header>
<h1>Henkilökohtaiset tiedot</h1>
</header>

<?php 
echo "Päivitä henkilötietosi seuraavaan lomakkeeseen: "
?>

<form class="form1" action="receive.form.php" method="post">

  <p class="text"> Nimi: </p>
  <input class="writingArea" type="text" name="nimi"><br>
    
  <p class="text"> Lähiosoite:  </p>
  <input class="writingArea" type="text" name="lahiosoite"><br>
  
  <p class="text"> Postinumero: </p>
  <input class="writingArea" type="text" name="postinro" size="6"><br>

  <p class="text"> Postitoimipaikka:  </p>
  <input class="writingArea" type="text" name="postitp" size="20"><br>

  <p class="text"> Sähköposti: </p>  
  <input class="writingArea" type="text" name="sahkop"><br>
  
  <input class="sendButton" type="submit" value="Lähetä">
  <input class="emptyButton" type="reset" value="Tyhjennä">

</form>



</body>
</html>