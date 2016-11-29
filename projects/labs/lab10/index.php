<?php
include 'install.php';

function migrate() {
	// Copy records from lab9's database into this one.
	$result = "";
	
	$db_mysql = new PDO('mysql:host=localhost:3306', 'root', '');
	$db_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$db_postgresql = pg_connect('host=localhost dbname=aquina-websyslab10 user=root password=root');
	
	// Migrate courses.
	$selectCourses = $db_mysql->query(
		"SELECT * FROM `aquina-websyslab9`.courses;"
	);
	$coursesArray = $selectCourses->fetchAll();
	
	foreach ($coursesArray as $course) {
		$courseValues = array(
			$course['crn'],
			$course['prefix'],
			$course['number'],
			$course['title'],
			$course['section'],
			$course['year']
		);
		pg_prepare(
			$db_postgresql,
			"",
			"INSERT INTO courses (crn, prefix, number, title, section, year) VALUES ($1, $2, $3, $4, $5, $6) ON CONFLICT DO NOTHING;"
		);
		$insertCourse = pg_execute($db_postgresql, "", $courseValues);
		
		if (!$insertCourse) {
			$error = "Could not insert course #".$courseValues[2]."<br/>";
			break;
		}
	}
	
	$result .= "10 courses migrated successfully!<br/>";
	
	// Migrate grades.
	$selectGrades = $db_mysql->query(
		"SELECT * FROM `aquina-websyslab9`.grades;"
	);
	$gradesArray = $selectGrades->fetchAll();
	
	foreach ($gradesArray as $grade) {
		$gradeValues = array(
			$grade['id'],
			$grade['crn'],
			$grade['rin'],
			$grade['grade']
		);
		pg_prepare(
			$db_postgresql,
			"",
			"INSERT INTO grades (id, crn, rin, grade) VALUES ($1, $2, $3, $4) ON CONFLICT DO NOTHING;"
		);
		$insertGrade = pg_execute($db_postgresql, "", $gradeValues);
		
		if (!$insertGrade) {
			$error = "Could not insert grade with ID ".$gradeValues[0]."<br/>";
			break;
		}
	}
	
	$result .= "25 grades migrated successfully!<br/>";
	
	// Migrate students.
	$selectStudents = $db_mysql->query(
		"SELECT * FROM `aquina-websyslab9`.students;"
	);
	$studentsArray = $selectStudents->fetchAll();
	
	foreach ($studentsArray as $student) {
		$studentValues = array(
			$student['rin'],
			$student['rcsID'],
			$student['first_name'],
			$student['last_name'],
			$student['alias'],
			$student['phone'],
			$student['street'],
			$student['city'],
			$student['state'],
			$student['zip'],
		);
		pg_prepare(
			$db_postgresql,
			"",
			"INSERT INTO students (rin, rcsID, first_name, last_name, alias, phone, street, city, state, zip) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10) ON CONFLICT DO NOTHING;"
		);
		$insertStudent = pg_execute($db_postgresql, "", $studentValues);
		
		if (!$insertStudent) {
			$error = "Could not insert student with RIN ".$studentValues[0]."<br/>";
			break;
		}
	}
	
	$result .= "10 student records migrated successfully!<br/>";
	
	if (isset($error)) {
		return $error;
	}
	else if (isset($result)) {
		return $result;	
	}
	
	return "ERROR: migrate() failed<br/>";
}

function select() {
	// Query the PostgreSQL database
	$dbconn = pg_connect('host=localhost dbname=aquina-websyslab10 user=root password=root');

	// SELECT all students (first and last name) who have an A(90+) grade in at least one class, and the class (course name) they have the most A's in. You may break ties however you wish
	
	$selectStudents =<<<EOF
		SELECT * FROM (
			SELECT s.first_name, s.last_name, COUNT(g.grade) a_count, MAX(c.title) course_name
				FROM students s
				INNER JOIN grades g ON s.rin = g.rin
				INNER JOIN courses c ON c.crn = g.crn
				WHERE g.grade >= 90
				GROUP BY s.rin
		) AS gradeCount;
EOF;
	
	$resultSelect = pg_query($dbconn, $selectStudents);
	
	if (!$resultSelect) {
		$error = "Error selecting students: ".pg_last_error();
	}
	
	// TODO Display the data in a table
	$result = pg_fetch_all($resultSelect);
	
	if (isset($error)) {
			return $error;
	}
	else if (isset($result)) {
		return $result;	
	}

	return "ERROR: select() failed<br/>";
}

if (isset($_POST['install']) && $_POST['install'] == 'Install') {
	$resultInstall = install();
}

if (isset($_POST['migrate']) && $_POST['migrate'] == 'Migrate') {
	$resultMigrate = migrate();
}

if (isset($_POST['select']) && $_POST['select'] == 'Select') {
	$resultSelect = select();
}
?>

<!doctype html>
<html>
	<head>
		<title>Lab 10 | CSCI-2960 Web Systems Development</title>
		<link rel="stylesheet" href="lab10.css" type="text/css">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<h1>Lab 10</h1>
		<h2>CSCI-2960 Web Systems Development</h2>
		
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h3>Create Database</h3>
					<form method="post">
						<button type="submit" name="install" value="Install" class="btn btn-primary">Install</button>
					</form>
				</div>
				
				<div class="col-md-4">
					<h3>Migrate Content from lab9</h3>
					<form method="post">
						<button type="submit" name="migrate" value="Migrate" class="btn btn-success">Migrate</button>
					</form>
				</div>
				
				<div class="col-md-4">
					<h3>Superior Students</h3>
					<form method="post">
						<button type="submit" name="select" value="Select" class="btn btn-info">Select</button>
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<h3>PostgreSQL Results</h3>
					<?php
						if (isset($resultInstall)): echo "<p>$resultInstall</p>";
					?>
					<?php
						elseif (isset($resultMigrate)): echo "<p>$resultMigrate</p>";
					?>
					<?php	elseif (isset($resultSelect)): ?>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>
											Student
										</th>
										<th>
											Number of "A" Grades
										</th>
										<th>
											Course with Most As
										</th>
									</tr>
								</thead>
								<tbody>
									<?php	foreach ($resultSelect as $row): ?>
										<tr>
											<td>
												<?php echo $row['first_name']." ".$row['last_name']; ?>
											</td>
											<td>
												<?php echo $row['a_count']; ?>
											</td>
											<td>
												<?php echo $row['course_name']; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>	
							</table>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</body>
</html>