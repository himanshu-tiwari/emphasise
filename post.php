<?php

session_start();

$errors =[];

if(isset($_POST['message'])){
	$fields = [
		'message' => $_POST['message']
	];

	foreach ($fields as $field => $data) {
		if (empty($data)) {
			$errors[] = 'The '. $field .' field is required.';
		}
	}

	if (empty($errors)) {
		
	}
}
else{
	$errors[] = "There's something wrong!";
}

$_SESSION['errors'] = $errors;
$_SESSION['fields'] = $fields;

header('Location: index.php');

?>