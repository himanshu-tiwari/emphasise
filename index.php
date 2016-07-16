<?php

session_start();

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Adjectives</title>

	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div class="contact">
		<?php if(!empty($errors)): ?>
			<div class="panel">
				<ul>
					<li><?php echo implode('</li><li>', $errors);?></li>
				</ul>
			</div>
		<?php endif; ?>

		<form action="post.php" method="post">
			<label>
				Your message*
				<textarea name="message" rows="8"><?php echo isset($fields['message']) ? $fields['message'] : ''  ?></textarea>
			</label>

			<input type="submit" value="Send">

			<p class="muted">*means a required field</p>
		</form>
	</div>
</body>
</html>

<?php
//header('Content-Type:application/json');
if (isset($fields['message'])) {
	if (!empty($fields['message'])) {
		$check = $fields['message'];
  		$tokens = explode(" ", $check);
  	
	  	foreach ($tokens as $token) {
	  		$len  = strlen($token);
	  		if ($len>3) {
		  		$endpoint = 'http://words.bighugelabs.com/api/2/31b167cfa4d754b4a35dff86b728e326/'. $token .'/';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json') );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, $endpoint);
				$result=curl_exec($ch);
				//print_r($result);
				//print(gettype($result));

				$res = explode('|', $result);
				//print_r($res);
				//$res2 = explode(" ", $res[2]);
				//echo($res[2]);
				/*$result = json_decode($result, true);
				print(gettype($result));
				*/
				if (!empty($res[0])) {
					if (substr($res[2], -4) === 'noun') {
						echo substr($res[2], 0, -4).'<br>';
					}
					elseif (substr($res[2], -7) === 'pronoun') {
						echo substr($res[2], 0, -7).'<br>';
					}
					elseif (substr($res[2], -9) === 'adjective') {
						echo substr($res[2], 0, -9).'<br>';
					}
					elseif (substr($res[2], -4) === 'verb') {
						echo substr($res[2], 0, -4).'<br>';
					}
					elseif (substr($res[2], -6) === 'adverb') {
						echo substr($res[2], 0, -6).'<br>';
					}
					elseif (substr($res[2], -11) === 'preposition') {
						echo substr($res[2], 0, -11).'<br>';
					}
					elseif (substr($res[2], -10) === 'conjuction') {
						echo substr($res[2], 0, -10).'<br>';
					}
					elseif (substr($res[2], -12) === 'interjection') {
						echo substr($res[2], 0, -12).'<br>';
					}

					if (substr($res[4], -4) === 'noun') {
						echo substr($res[4], 0, -4).'<br>';
					}
					elseif (substr($res[4], -7) === 'pronoun') {
						echo substr($res[4], 0, -7).'<br>';
					}
					elseif (substr($res[4], -9) === 'adjective') {
						echo substr($res[4], 0, -9).'<br>';
					}
					elseif (substr($res[4], -4) === 'verb') {
						echo substr($res[4], 0, -4).'<br>';
					}
					elseif (substr($res[4], -6) === 'adverb') {
						echo substr($res[4], 0, -6).'<br>';
					}
					elseif (substr($res[4], -11) === 'preposition') {
						echo substr($res[4], 0, -11).'<br>';
					}
					elseif (substr($res[4], -10) === 'conjuction') {
						echo substr($res[4], 0, -10).'<br>';
					}
					elseif (substr($res[4], -12) === 'interjection') {
						echo substr($res[4], 0, -12).'<br>';
					}

					if (substr($res[6], -4) === 'noun') {
						echo substr($res[6], 0, -4).'<br>';
					}
					elseif (substr($res[6], -7) === 'pronoun') {
						echo substr($res[6], 0, -7).'<br>';
					}
					elseif (substr($res[6], -9) === 'adjective') {
						echo substr($res[6], 0, -9).'<br>';
					}
					elseif (substr($res[6], -4) === 'verb') {
						echo substr($res[6], 0, -4).'<br>';
					}
					elseif (substr($res[6], -6) === 'adverb') {
						echo substr($res[6], 0, -6).'<br>';
					}
					elseif (substr($res[6], -11) === 'preposition') {
						echo substr($res[6], 0, -11).'<br>';
					}
					elseif (substr($res[6], -10) === 'conjuction') {
						echo substr($res[6], 0, -10).'<br>';
					}
					elseif (substr($res[6], -12) === 'interjection') {
						echo substr($res[6], 0, -12).'<br>';
					}

					echo "<br>";
					//print(count($result));
					/*$i=0;
					foreach ($result as $res) {
						if($i<3){
							print strlen($res);
							echo '<br><br>';
							$i = $i+1;
						}	
					}*/
				}
	  		}

	  	}
	}
}

unset($_SESSION['errors']);
unset($_SESSION['fields']);
//Humans are evil
?>