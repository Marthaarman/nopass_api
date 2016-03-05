<?PHP
	$url = 'https://nopass.mhwebdevelopment.nl/api/verify.php';
	$secret = 'my_secret_key';
	$nopass_session = $_POST['nopass-session'];
	$remoteip = $_SERVER['REMOTE_ADDR'];
	
	$data = array(
		'secret' => $secret, 
		'nopass-session' => $nopass_session,
		'remoteip' => $remoteip
	);
	
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	
	$context  = stream_context_create($options);
	$response = json_decode(file_get_contents($url, false, $context));
	
	if($response->connection_status == true) {
		//Data correct
		if($response->success == true) {
			//authentication approved
			$email = $response->account->email;
			$email2 = $response->account->nopass_email;
			echo 'Authentication has been approved<br />';
			echo 'noPass email of this user is: '.$email2.'<br />';
			echo 'Email of this user is: '.$email;
		}else {
			//authentication rejected
			echo 'Authentication has been denied';
			print_r($response->errors);
		}
	}else {
		echo 'The parameter(s) (value(s)) are incorrect.';
	}
?>