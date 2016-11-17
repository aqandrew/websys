<?php
	function install ($config) {
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.<br/>";
			}

			// Create a database named yourRCSid-websyslab9 checking to make sure it does not already exist.
			$resultCreate = $connection->exec(
				"CREATE DATABASE IF NOT EXISTS `aquina-websyslab9`;"
			);

			if ($resultCreate === 1) {
				$result .= "Lab 9 database successfully created.<br/>";
			}
			else {
				$result .= "Lab 9 database already exists.<br/>";
			}

			// Create a table named courses if it does not already exist. It should contain the same structure as in lab 8.
			$resultCourses = $connection->exec(
				"CREATE TABLE IF NOT EXISTS `aquina-websyslab9`.`courses` (
					`crn` int(11) NOT NULL,
					`prefix` varchar(4) NOT NULL,
					`number` smallint(4) NOT NULL,
					`title` varchar(255) NOT NULL,
					`section` int(2) DEFAULT NULL,
					`year` int(4) DEFAULT NULL
				)
				COLLATE utf8_unicode_ci;
				ALTER TABLE `aquina-websyslab9`.`courses` ADD PRIMARY KEY (`crn`);"
			);

			if ($resultCourses === 0) {
				$result .= "courses table successfully created.<br/>";
			}
			else {
				$result .= "courses table already exists.<br/>";
			}

			// Create a table named students if it does not already exist. It should contain the same structure as in lab 8.
			$resultStudents = $connection->exec(
				"CREATE TABLE IF NOT EXISTS `aquina-websyslab9`.`students` (
					`rin` int(9) NOT NULL,
					`rcsID` char(7) DEFAULT NULL,
					`first_name` varchar(100) NOT NULL,
					`last_name` varchar(100) NOT NULL,
					`alias` varchar(100) NOT NULL,
					`phone` int(10) DEFAULT NULL,
					`street` varchar(100) DEFAULT NULL,
					`city` varchar(100) DEFAULT NULL,
					`state` varchar(100) DEFAULT NULL,
					`zip` int(5) DEFAULT NULL
				)
				COLLATE utf8_unicode_ci;
				ALTER TABLE `aquina-websyslab9`.`students` ADD PRIMARY KEY (`rin`);"
			);

			if ($resultStudents === 0) {
				$result .= "students table successfully created.<br/>";
			}
			else {
				$result .= "students table already exists.<br/>";
			}

			// Create a table named grades, if it does not already exist, containing the same fields as in lab 8.
			$resultGrades = $connection->exec(
				"CREATE TABLE IF NOT EXISTS `aquina-websyslab9`.`grades` (
					`id` int(11) NOT NULL,
					`crn` int(11) DEFAULT NULL,
					`rin` int(9) DEFAULT NULL,
					`grade` int(3) NOT NULL,
					PRIMARY KEY (`id`)
				)
				COLLATE utf8_unicode_ci;
				ALTER TABLE `aquina-websyslab9`.`grades`
					ADD PRIMARY KEY (`id`);
				ALTER TABLE `aquina-websyslab9`.`grades`
					MODIFY `id` AUTO_INCREMENT,
					ADD KEY `crn` (`crn`),
					ADD KEY `rin` (`rin`);
				ALTER TABLE `aquina-websyslab9`.`grades`
					ADD CONSTRAINT `grade_crn2` FOREIGN KEY (`crn`) REFERENCES `aquina-websyslab9`.`courses` (`crn`),
					ADD CONSTRAINT `grade_rin2` FOREIGN KEY (`rin`) REFERENCES `aquina-websyslab9`.`students` (`rin`);"
			);

			if ($resultGrades === 0) {
				$result .= "grades table successfully created.<br/>";
			}
			else {
				$result .= "grades table already exists.<br/>";
			}
		}
		catch (PDOException $e) {
			$error = 'PDO ERROR: '.$e->getMessage().'<br/>';
		}
		
		if (isset($error)) {
			return $error;
		}
		else if (isset($result)) {
			return $result;	
		}
		
		return "ERROR: Install failed<br/>";
	}
?>