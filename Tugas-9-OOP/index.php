<?php
require_once('animal.php');
require_once('ape.php');
require_once('frog.php');

$sheep = new Animal('shaun');
echo 'Name : ' . $sheep->name . '<br>';
echo 'Legs : ' . $sheep->legs . '<br>';
echo 'Cold Bloaded : ' . $sheep->cold_bloaded . '<br>';

echo '<br>';

$kodok = new Frog("buduk");
echo 'Name : ' . $kodok->name . '<br>';
echo 'Legs : ' . $kodok->legs . '<br>';
echo 'Cold Bloaded : ' . $kodok->cold_bloaded . '<br>';
echo 'Yell : ';
$kodok->jump(); // "hop hop"

echo '<br> <br>';

$sungokong = new Ape("kera sakti");
echo 'Name : ' . $sungokong->name . '<br>';
echo 'Legs : ' . $sungokong->legs . '<br>';
echo 'Cold Bloaded : ' . $sungokong->cold_bloaded . '<br>';
echo 'Yell : ';
$sungokong->yell(); // "Auooo"