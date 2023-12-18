<?php
  $t = array("nolla", "yksi", "kaksi");
  $u = array("hedelmä" => "omena", "vilja" => "ruis", "marja" => "vadelma");

  foreach ($t as $arvo) {
    echo "$arvo<br>";
  }
  echo "<br>\n";

  foreach ($t as $avain => $arvo) {
    echo "$avain -> $arvo<br>";
  }
  echo "<br>\n";

  foreach ($u as $arvo) {
    echo "$arvo<br>";
  }
  echo "<br>\n";

  foreach ($u as $avain => $arvo) {
    echo "$avain -> $arvo<br>";
  }
?>