<?php
include 'utility.php'
?>

<!DOCTYPE html>
<html>
<head>
	<title>PSE FP</title>
</head>
<body>
	<?php
		printf("<p>Latest capture on %s %s</p>".PHP_EOL, $dataJson->latest->date, $dataJson->latest->time);
		printf("<IMG SRC='https://storage.googleapis.com/%s/Mailbox-Images/%s' /> <br>".PHP_EOL, $bucketName, $dataJson->latest->file);
	?>
	<h1>Other Dates</h1>
	<ul style="list-style-type:none; padding: 0">
		<?php
		foreach (get_directories() as $dir) {
			printf("<li><a href='directory.php?directory=%s'>%s</a></li>".PHP_EOL, $dir, $dir);
		}
	?>
	</ul>
	
</body>
</html>