<?php
session_start();
if($_GET["cerrar"]=="si"){
session_destroy();
//echo "<script>history.go(-1)</script>";
echo "<script>location.href='index.php'</script>";
}

?>