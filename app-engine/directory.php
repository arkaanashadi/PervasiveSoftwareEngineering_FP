<!DOCTYPE html>
<html>
<head>
	<p><a href="index.php">Home</a></p>
	<?php
	printf("<title>%s</title>".PHP_EOL, $_GET['directory']);
	?>
</head>
<body>
	<?php
		include "utility.php";
		// list_objects("Mailbox-Images/".$_GET['directory']);
		show_all("Mailbox-Images/".$_GET['directory']);
	?>
</body>
</html>