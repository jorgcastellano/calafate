<?php
  /*
  mysql_connect("localhost","root","");
  mysql_select_db("plata");
  */
  mysql_connect("localhost","root","jorgejac");
  mysql_select_db("fvillareal_plat1");
  //session_set_cookie_params(0 , "/" , ".creativoscalafate.com.ar");
  ini_set("session.cookie_lifetime",14400);
  ini_set("session.gc_maxlifetime",14400);

?>
