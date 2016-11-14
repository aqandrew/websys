<?php
	require './config.php';
	
	try {
		$connection = new PDO('mysql:host=localhost:3306;dbname=websys_shop', $config['DB_USERNAME'], $config['DB_PASSWORD']);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// Part 1: select all columns and all rows in the database.
		$results = $connection->query('SELECT * FROM customers');
		foreach ($results as $row) {
			echo '<pre>';
			print_r($row);
			echo '</pre>';
			
			printf("Last name: %s\n", $row['lname']);
		}
			// Print out the entire array using print_r
		// Part 2: select only the record with id=2.
			// Print out the last name using printf.
	}
	catch (PDOException $e) {
		echo 'ERROR: '.$e->getMessage().'\n';
	}

	if ($connection) {
		echo "Connected successfully!\n";
	}
?>