<!doctype html>
<html>
<head>
  <title>Lecture #14 - Forms</title>
</head>
<body>
	<?php if (empty($_POST['name'])): ?>
    <!-- This form will POST to itself. -->
  <form method="post" action="lec14_forms.php">
    <!-- The variable we're looking for will exist in $_POST['name'] -->
    <input type="text" name="name" id="name" value="" />
    <input type="submit" name="submit" value="Submit" />  
  </form>
	<?php else:?>
		<h1>Hello, <?php echo htmlentities($_POST['name']); ?>!</h1>
	<?php endif;?>
  </body>
</html>