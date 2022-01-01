<?php
session_start();
$cookie_name = "User";
if(isset($_COOKIE[$cookie_name])){setcookie($cookie_name, "NOTACOOKIE", time());}
header('Location: index.php'); //AMORE PER QUESTA FUNZIONE
?>