<?php
# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';
# Instantiates a client
use Google\Cloud\Storage\StorageClient;

$storage = new StorageClient([
    	'projectId' =>   "rich-ripple-262608",
        'keyFilePath' => "mailbox-api-key.json",
]);
$bucketName = "pse-oit-mailbox";
$bucket = $storage->bucket($bucketName);
$dataJsonRaw = file_get_contents("https://storage.googleapis.com/pse-oit-mailbox/data.json");
$dataJson = json_decode($dataJsonRaw);

function get_directories()
{
	global $storage;
    global $bucket;
    $objects = $bucket->objects([
    	'prefix' => 'Mailbox-Images',
    ]);
    $directories = [];
    foreach ($objects as $object) 
    {
    	if ($object->name() == 'Mailbox-Images/') {continue;}
        // $file = substr(strrchr($object->name(), '/'), 1);
    	$file = substr(strrchr($object->name(), '/'), 1, 10);
    	array_push($directories, $file);
    }
    return array_unique($directories);;
}

function list_objects($directoryName = '')
{
	global $storage;
    global $bucket;
    $objects = $bucket->objects([
    	'prefix' => $directoryName,
    ]);
    foreach ($objects as $object) 
    {
    	if ($object->name() == 'Mailbox-Images/') 
    	{
    		continue;
    	}
    	else
    	{
        	$file = substr(strrchr($object->name(), '/'), 1);
        	printf('Object: %s <br>'. PHP_EOL, $file);
    	}
    }
}

function show_images($directoryName='')
{
	global $storage;
    global $bucket;
    $objects = $bucket->objects([
    	'prefix' => $directoryName,
    ]);
    foreach ($objects as $object)
    {
    	if ($object->name() == 'Mailbox-Images/') {continue;}
    	else
    	{
        	$file = substr(strrchr($object->name(), '/'), 1);
        	printf('<IMG SRC="https://storage.googleapis.com/%s/%s%s" /> <br>'. PHP_EOL, $bucket, $directoryName, $file);
    	}
        
    }
}

function show_all($directoryName='')
{
	global $storage;
    global $bucket;
    global $bucketName;
    $objects = $bucket->objects([
    	'prefix' => $directoryName,
    ]);
    foreach ($objects as $object)
    {
    	// echo $object->name().PHP_EOL, "<br>";
    	if ($object->name() == 'Mailbox-Images/') {continue;}
    	else
    	{ 
        	$file = substr(strrchr($object->name(), '/'), 1);
        	printf('IoT Mailbox<br> Date and Time: %s <br><br><br>'. PHP_EOL, $file);
        	printf('<IMG SRC="https://storage.googleapis.com/%s/%s/%s" /> <br>'. PHP_EOL, $bucketName, $directoryName, $file);
    	}
        
    }
}
?>