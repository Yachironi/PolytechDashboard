<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Database Connection</title>
    <link rel="stylesheet" href ="style.css">
    <script src="script.js"></script>
  </head>
  <body>
	<?php
	try{
	    $pdo = new PDO('sqlite:'.dirname(__FILE__).'/database.sqlite');
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
	    echo "Connection a la base de donnees SQLite reussie: ";
	     
	} catch(Exception $e) {
	    echo "Impossible d'acceder à la base de donnees SQLite : ".$e->getMessage();
	    die();
	}
	?>
  </body>
</html>

