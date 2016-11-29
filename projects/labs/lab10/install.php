<?php
// Using the PHP Postgres API, create tables that have the same structure as those in the MySQL database yourRCSid-websyslab9 from Lab 9.
function install() {
	$dbconn = pg_connect('host=localhost dbname=aquina-websyslab10 user=root password=root');
	
	if (!$dbconn) {
		$error = 'Could not connect to database.';
	}
	else {
		$createCourses =<<<EOF
			CREATE TABLE IF NOT EXISTS courses (
				crn int PRIMARY KEY NOT NULL,
				prefix varchar(4) NOT NULL,
				number smallint NOT NULL,
				title varchar(255) NOT NULL,
				section int NOT NULL,
				year int NOT NULL
			);
EOF;
		
		$resultCreateCourses = pg_query($dbconn, $createCourses);

		if (!$resultCreateCourses) {
			$error = 'Failed to create courses table: '.pg_last_error();
		}

		$createGrades =<<<EOF
			CREATE TABLE IF NOT EXISTS grades (
				id int PRIMARY KEY NOT NULL,
				crn int DEFAULT NULL,
				rin int DEFAULT NULL,
				grade int NOT NULL
			);
EOF;
		
		$resultCreateGrades = pg_query($createGrades);

		if (!$resultCreateGrades) {
			$error = 'Failed to create grades table: '.pg_last_error();	
		}

		$createStudents =<<<EOF
			CREATE TABLE IF NOT EXISTS students (
				rin int PRIMARY KEY NOT NULL,
				rcsID char(7) DEFAULT NULL,
				first_name varchar(100) NOT NULL,
				last_name varchar(100) NOT NULL,
				alias varchar(100) NOT NULL,
				phone int DEFAULT NULL,
				street varchar(100) DEFAULT NULL,
				city varchar(100) DEFAULT NULL,
				state varchar(100) DEFAULT NULL,
				zip int DEFAULT NULL
			);
EOF;
		
		$resultCreateStudents = pg_query($createStudents);

		if (!$resultCreateStudents) {
			$error = 'Failed to create students table: '.pg_last_error();
		}
	}
	
	if (isset($error)) {
		return $error;
	}
	
	return 'Created lab10 tables successfully!';
}
?>