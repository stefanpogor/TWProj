<?php
$a[] = "Pedale";
$a[] = "Scaun";
$a[] = "Roata fata";
$a[] = "Roata spate";
$a[] = "Lant";
$a[] = "Ghidon";
$a[] = "Coarne";
$a[] = "Frane";
$a[] = "Claxon";
$a[] = "Spite";
$a[] = "Antifurt";

$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {

  $q = strtolower($q);
  $len=strlen($q);

  foreach($a as $name) {

    if (stristr($q, substr($name, 0, $len))) {

      if ($hint === "") {
        $hint = $name;
      } 
      else {
        $hint .= ", $name";
      }
    }
  }
}

echo $hint === "" ? "nici o sugestie" : $hint;
?>