<?php
# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';
# Instantiates a client
use Google\Cloud\Storage\StorageClient;

$storage = new StorageClient([
    	'projectId' =>   "rich-ripple-262608",
        'keyFilePath' => "PSE-FP-0b45c33ca06e.json",
]);
// $PROJECT_ID = "rich-ripple-262608";
// $GOOGLE_STORAGE_BUCKET = "pse-oit-mailbox";
// $API_KEY_PATH = "/Users/o_o/Documents/Pervasive Software engineering/Pervasive_FP/code/app-engine/PSE-FP-0b45c33ca06e.json";
/**
 * List Cloud Storage bucket objects.
 *
 * @param string $bucketName the name of your Cloud Storage bucket.
 *
 * @return void
 */
function list_objects($bucketName, $directoryName = '')
{
	global $storage;
    $bucket = $storage->bucket($bucketName);
    $objects = $bucket->objects([
    	'prefix' => $directoryName,
    ]);
    foreach ($objects as $object) 
    {
    	if ($object->name() == 'Mailbox-Images/') {continue;}
    	else
    	{
        	$file = substr(strrchr($object->name(), '/'), 1);
        	printf('Object: %s <br>'. PHP_EOL, $file);
    	}
    }
}
// list_objects("pse-oit-mailbox", 'Mailbox-Images/');

function show_images($bucketName, $directoryName='')
{
	global $storage;
    $bucket = $storage->bucket($bucketName);
    $objects = $bucket->objects([
    	'prefix' => $directoryName,
    ]);
    foreach ($objects as $object)
    {
    	if ($object->name() == 'Mailbox-Images/') {continue;}
    	else
    	{
        	$file = substr(strrchr($object->name(), '/'), 1);
        	printf('<IMG SRC="https://storage.googleapis.com/%s/%s%s" /> <br>'. PHP_EOL, $bucketName, $directoryName, $file);
    	}
        
    }
}

function show_all($bucketName, $directoryName='')
{
	global $storage;
    $bucket = $storage->bucket($bucketName);
    $objects = $bucket->objects([
    	'prefix' => $directoryName,
    ]);
    foreach ($objects as $object)
    {
    	if ($object->name() == 'Mailbox-Images/') {continue;}
    	else
    	{
        	$file = substr(strrchr($object->name(), '/'), 1);
        	printf('<IMG SRC="https://storage.googleapis.com/%s/%s%s" /> <br>'. PHP_EOL, $bucketName, $directoryName, $file);
        	printf('IoT Mailbox<br> Date and Time: %s <br><br><br>'. PHP_EOL, $file);
    	}
        
    }
}
show_all('pse-oit-mailbox', 'Mailbox-Images/');

// echo '<IMG SRC="https://storage.googleapis.com/rich-ripple-262608.appspot.com/testRin.jpg"'
?>

<!DOCTYPE html>
<html>
<head>
	<title>PSE FP</title>
</head>
<body>
	<!-- <IMG SRC="https://storage.googleapis.com/pse-oit-mailbox/1576507859555.jpg" /> -->
</body>
</html>