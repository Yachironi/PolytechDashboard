<?php
	try {
		$pdo = new PDO ( 'sqlite:' . dirname ( __FILE__ ) . '/database.sqlite' );
		$pdo->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
		echo "Connection a la base de donnees SQLite reussie: ";
	
		$stmt = $pdo->prepare("SELECT name FROM  WHERE type='table'");
		$stmt->execute(array('titre' => 'Lorem ipsum'));
		$result = $stmt->fetchAll();
		print_r($result);
		$pdo = null;
		
	} catch ( Exception $e ) {
		echo "Impossible d'acceder à la base de donnees SQLite : " . $e->getMessage ();
		die ();
	}
	
	

	
?>