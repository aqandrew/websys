<?php
	session_start();
	include 'install.php';
	include 'insert.php';
	include 'output.php';

	$config = array(
		'DB_HOST'			=> 'localhost',
		'DB_USERNAME'	=> 'root',
		'DB_PASSWORD' => ''
	);

	// Display a webpage which will provide the user with 4 options:

	// Choice 1, Install
	// Call install.php
	if (isset($_POST['install']) && $_POST['install'] == 'Install') {
		$resultInstall = install($config);
	}

	// Choice 2, Load
	// Call insert.php
	if (isset($_POST['insert']) && $_POST['insert'] == 'Load') {
		$resultInsert = insert($config);
	}

	// Call output.php
	if (isset($_POST['output'])) {
		// Choice 3, Students
		if ($_POST['output'] == 'Students') {
			$resultOutput = listStudentsByName($config);
		}
		// Choice 4, Grade distribution
		else {
			$cutoffGrades = array(65, 70, 80, 90);
			$resultOutput = listStudentsByGrade($config, $cutoffGrades);
		}
	}
?>
<!doctype html>
<html>
	<head>
		<title>Lab 9 | CSCI-2960 Web Systems Development</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="lab9.css" rel="stylesheet">
	</head>
	<body>
		<h1>Lab 9</h1>
		<h2>CSCI-2960 Web Systems Development</h2>
		
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h3>Create Database</h3>
					<form method="post">
						<button type="submit" name="install" value="Install" class="btn btn-primary">Install</button>
					</form>
				</div>

				<div class="col-md-5">
					<h3>Insert Content into Database</h3>
					<form method="post">
						<button type="submit" name="insert" value="Load" class="btn btn-success">Load</button>
					</form>
				</div>

				<div class="col-md-4">
					<h3>Output Options</h3>
					<form method="post">
						<button type="submit" name="output" value="Students" class="btn btn-info">Students</button>
						<button type="submit" name="output" value="GradeDistribution" class="btn btn-info">Grade Distribution</button>
					</form>
				</div>
			</div>	
			
			<div class="row">
				<div class="col-md-12">
					<h3>PDO Results</h3>
					<?php if (isset($resultInstall)): echo "<p>$resultInstall</p>" ?>
					<?php elseif (isset($resultInsert)): echo "<p>$resultInsert</p>" ?>
					<?php elseif (isset($resultOutput)): echo "<p>$resultOutput</p>" ?>
					<?php else: echo "<p>No query made.</p>" ?>
					<?php endif; ?>
				</div>	
			</div>
		</div>	
	</body>
</html>