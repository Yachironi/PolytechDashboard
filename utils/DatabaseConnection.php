<?php
	try {
		$pdo = new PDO ( 'sqlite:' . dirname ( __FILE__ ) . '/database.sqlite' );
		$pdo->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
		echo "Connection a la base de donnees SQLite reussie ";
	
		$stmt = $pdo->prepare("SELECT * FROM sqlite_master");
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		// afficher le détail des tables de la base de donnée
		print_r($result);
		
		// fermeture de la connexion
		$pdo = null;
		
	} catch ( Exception $e ) {
		echo "Impossible d'acceder à la base de donnees SQLite : " . $e->getMessage ();
		die ();
	}	
?>