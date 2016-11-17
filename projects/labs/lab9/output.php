<?php
	function listStudentsByName ($config) {
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.<br/>";
			}
			
			// List all students in alphabetical order, by last name, and then firstname
			$resultListByName = $connection->query(
				"SELECT * FROM `aquina-websyslab9`.`students`
				ORDER BY `last_name`, `first_name`;"
			);
			$listByNameArray = $resultListByName->fetchAll();
			$result .= '<h4>All Students, in Alphabetical Order</h4>';
			foreach ($listByNameArray as $student) {
				$result .= $student['first_name'].' '.$student['last_name'].'<br/>';
			}
		}
		catch (PDOException $e) {
			$error = 'PDO ERROR: '.$e->getMessage().'<br/>';
		}
		
		if (isset($result)) {
			return $result;	
		}
		else if (isset($error)) {
			return $error;
		}
		
		return "ERROR: listStudentsByName failed<br/>";
	}

	function listStudentsByGrade ($config, $cutoffGrades) {
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.<br/>";
			}

			$result .= "<h4>Student Count by Grade Distribution</h4>";
			
			for ($g = 0; $g < count($cutoffGrades); $g++) {
				// Make a query for grades below the lowest cutoff,
				if ($g == 0) {
					$range = "Below ".$cutoffGrades[0];
					$statementListByGrade = $connection->prepare(
						"SELECT COUNT(*) FROM (
							SELECT
								s.rin,
								AVG(g.grade) averageGpa
							FROM `aquina-websyslab9`.students s
							INNER JOIN `aquina-websyslab9`.grades g on s.rin = g.rin
							GROUP BY s.rin
						) AS gpas
						WHERE gpas.averageGpa < :cutoff;"
					);
					$statementListByGrade->bindParam(':cutoff', $cutoffGrades[$g], PDO::PARAM_INT);
					$statementListByGrade->execute();
					$count = $statementListByGrade->fetch()[0];
				}
				else {
					// intermediate grade cutoffs,
					$range = "Between ".$cutoffGrades[$g - 1]." and ".$cutoffGrades[$g];
					$statementListByGrade = $connection->prepare(
						"SELECT COUNT(*) FROM (
							SELECT
								s.rin,
								AVG(g.grade) averageGpa
							FROM `aquina-websyslab9`.students s
							INNER JOIN `aquina-websyslab9`.grades g on s.rin = g.rin
							GROUP BY s.rin
						) AS gpas
						WHERE gpas.averageGpa > :cutoff1 AND gpas.averageGpa < :cutoff2;"
					);
					$statementListByGrade->bindParam(':cutoff1', $cutoffGrades[$g - 1]);
					$statementListByGrade->bindParam(':cutoff2', $cutoffGrades[$g]);
					$statementListByGrade->execute();
					$count = $statementListByGrade->fetch()[0];
				}
				
				$result .= $range.": ".$count."<br/>";
				
				// and grades above the highest cutoff.
				if ($g == count($cutoffGrades) - 1) {
					$statementListByGrade = $connection->prepare(
						"SELECT COUNT(*) FROM (
							SELECT
								s.rin,
								AVG(g.grade) averageGpa
							FROM `aquina-websyslab9`.students s
							INNER JOIN `aquina-websyslab9`.grades g on s.rin = g.rin
							GROUP BY s.rin
						) AS gpas
						WHERE gpas.averageGpa > :cutoff;"
					);
					$statementListByGrade->bindParam(':cutoff', $cutoffGrades[$g]);
					$statementListByGrade->execute();
					$count = $statementListByGrade->fetch()[0];
					
					$result .= "Above ".$cutoffGrades[$g].": ".$count."<br/>";
				}
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
		
		return "ERROR: listStudentsByGrade failed<br/>";
	}
?>