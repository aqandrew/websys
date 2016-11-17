<?php
	function insert ($config) {
		try {
			$connection = new PDO('mysql:host=localhost:3306', $config['DB_USERNAME'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if ($connection) {
				$result = "";
			}
			else {
				$error = "Unable to connect to database.<br/>";
			}
			
			// INSERT at least 10 courses into the courses table
			$resultCoursesInsert = $connection->exec(
				"INSERT INTO `aquina-websyslab9`.`courses` (
					`crn`, `prefix`, `number`, `title`, `section`, `year`
				) VALUES
				(35301, 'ARTS', 1020, 'Media Studio: Imaging', 1, 2017),
				(35303, 'ARTS', 1020, 'Media Studio: Imaging', 4, 2017),
				(35356, 'ARTS', 2020, 'Music and Technology I', 1, 2017),
				(37876, 'ARTS', 1200, 'Basic Drawing', 1, 2017),
				(37880, 'ARTS', 4220, 'Painting', 1, 2017),
				(38182, 'ARTS', 1040, 'Art for Interactive Media', 1, 2017),
				(38611, 'ARTS', 1010, 'Introduction to Music and Sound', 1, 2017),
				(39027, 'ARTS', 1030, 'Digital Filmmaking', 1, 2017),
				(39117, 'ARTS', 1050, 'Art History: Paleolithic to Contemporary', 1, 2017),
				(39271, 'ARTS', 1050, 'Art History: Paleolithic to Contemporary', 2, 2017);"
			);
			
			if ($resultCoursesInsert == 10) {
				$result .= "10 courses added successfully.<br/>";
			}
			else {
				$result .= "There was an error adding one or more courses.<br/>";
			}
			
			// INSERT at least 10 students into the students table
			$resultStudentsInsert = $connection->exec(
				"INSERT INTO `aquina-websyslab9`.`students` (
					`rin`, `rcsID`, `first_name`, `last_name`, `alias`, `phone`, `street`, `city`, `state`, `zip`
				) VALUES
				(218967210, 'tuckep7', 'Phyllis', 'Tucker', 'Warfarin Sodium', 2147483647, '8089 Kipling Way', 'Peoria', 'IL', 61640),
				(358570031, 'wilsoa3', 'Arthur', 'Wilson', 'Aveeno Eczema Therapy Moisturizing', 2147483647, '6 Delaware Court', 'Shreveport', 'LA', 71115),
				(383075255, 'romerw5', 'William', 'Romero', 'WU YANG BRAND MEDICATED PLASTER', 2147483647, '009 Magdeline Street', 'Baltimore', 'MD', 21203),
				(400149295, 'bishoa3', 'Angela', 'Bishop', 'childrens wal tap', 2147483647, '31 Hollow Ridge Place', 'Sacramento', 'CA', 94250),
				(492222908, 'jenkip8', 'Paul', 'Jenkins', 'Cold Sore Complex', 2147483647, '82 Tomscot Drive', 'Irving', 'TX', 75062),
				(560588858, 'freemb2', 'Barbara', 'Freeman', 'LEVOFLOXACIN', 2147483647, '6 Hintze Plaza', 'Long Beach', 'CA', 90831),
				(647433053, 'perkia', 'Antonio', 'Perkins', 'Benicar', 2147483647, '29730 Village Hill', 'Miami', 'FL', 33158),
				(851067762, 'lewisj', 'Jeremy', 'Lewis', 'BuPROPion Hydrochloride', 2147483647, '68 Tony Alley', 'Austin', 'TX', 78715),
				(859439651, 'webbh', 'Harry', 'Webb', 'Prednisolone', 2147483647, '6 Northport Street', 'Salem', 'OR', 97312),
				(861826167, 'howelg6', 'Gary', 'Howell', 'Exuviance CoverBlend Concealing Treatment Makeup', 2147483647, '1 Crest Line Lane', 'Northridge', 'CA', 91328);"
			);
			
			if ($resultStudentsInsert == 10) {
				$result .= "10 students added successfully.<br/>";
			}
			else {
				$result .= "There was an error adding one or more students.<br/>";
			}
			
			// ADD 25 grades into the grades table
			$resultGradesInsert = $connection->exec(
				"INSERT INTO `aquina-websyslab9`.`grades` (
					`id`, `crn`, `rin`, `grade`
				) VALUES
				(1, 35301, 218967210, 7),
				(2, 35301, 851067762, 420),
				(3, 35301, 492222908, 666),
				(4, 35301, 400149295, 311),
				(5, 35301, 383075255, 911),
				(6, 37876, 218967210, 0),
				(7, 37876, 560588858, 0),
				(8, 37876, 851067762, 0),
				(9, 37876, 492222908, 0),
				(10, 37876, 400149295, 0),
				(11, 39271, 218967210, 6),
				(12, 39271, 358570031, 5),
				(13, 39271, 560588858, 4),
				(14, 39271, 851067762, 3),
				(15, 39271, 492222908, 33),
				(16, 37880, 218967210, 67),
				(17, 37880, 560588858, 99),
				(18, 37880, 851067762, 69),
				(19, 37880, 358570031, 5),
				(20, 37880, 851067762, 1),
				(21, 37876, 851067762, 100),
				(22, 35303, 851067762, 1),
				(23, 35303, 851067762, 1),
				(24, 35303, 851067762, 1),
				(25, 35303, 851067762, 1);"
			);
			
			if ($resultGradesInsert == 25) {
				$result .= "25 grades added successfully.<br/>";
			}
			else {
				$result .= "There was an error adding one or more grades.<br/>";
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
		
		return "ERROR: Insert failed<br/>";
	}
?>