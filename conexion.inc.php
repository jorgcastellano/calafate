<?php
/*
mysql_connect("localhost","root","");
mysql_select_db("plata");
*/
mysql_connect("localhost","root","jorgejac");
mysql_select_db("fvillareal_plat1");

session_set_cookie_params(0, "/" , ".creativoscalafate.com.ar");

header("P3P: CP='CAO PSA OUR'");
header("Cache-control: private"); // IE 6 Fix.
?>
