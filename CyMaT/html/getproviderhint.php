<?php
$a[] = "West Biking";
$a[] = "Taurus";
$a[] = "Bike 4 Ride";
$a[] = "X Cycle";
$a[] = "Bloom";
$a[] = "Joyride";
$a[] = "Movatic";
$a[] = "Moqo";
$a[] = "Sycube";
$a[] = "Mobility";

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