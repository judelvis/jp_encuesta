<?php

define('BASE_PATH','http://localhost/jp_encuesta/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'encuestas');
define('DB_USER','root');
define('DB_PASSWORD','123');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Error al conectar: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Error al conectar: " . mysql_error());

?>
