<?php
session_start();
session_destroy();
header( 'Location: http://192.168.1.116/encuesta/index.php' ) ;
?>
