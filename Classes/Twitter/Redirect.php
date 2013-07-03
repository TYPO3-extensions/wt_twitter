<?php

require_once('Api.php');

$oAuthToken = '';
$oAuthTokenSecret = '';
if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
	$url = Tx_WtTwitter_Twitter_Api::getAccessTokenUrl();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);

	$oAuthParameter = Tx_WtTwitter_Twitter_Api::createSignature(
		Tx_WtTwitter_Twitter_Api::getOAuthParameter(
			$_GET['oauth_token'],
			array(
				'oauth_token' => $_GET['oauth_token'],
				'oauth_verifier' => $_GET['oauth_verifier']
			)
		),
		$url,
		'POST',
		Tx_WtTwitter_Twitter_Api::consumerSecret,
		''
	);

	$header = array(
		'Authorization: OAuth ' . Tx_WtTwitter_Twitter_Api::implodeArrayForHeader($oAuthParameter),
		'Content-Length:',
		'Content-Type:',
		'Expect:'
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

	$response = curl_exec($ch);
	if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
		$responseArray = array();
		$responseParts = explode('&', $response);
		foreach ($responseParts as $value) {
			if (strlen($value)) {
				list($partKey, $partValue) = explode('=', $value, 2);
				$responseArray[rawurldecode($partKey)] = rawurldecode($partValue);
			}
		}
		$oAuthToken = $responseArray['oauth_token'];
		$oAuthTokenSecret = $responseArray['oauth_token_secret'];
	}
	curl_close($ch);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>wt_twitter redirection page</title>
</head>
<body>
<script type="text/javascript">
	if (parent.window.opener) {
		if (window.opener.document.forms[1]["data[oauth_token]"]) {
<?php
		echo 'window.opener.document.forms[1]["data[oauth_token]"].value = "' . $oAuthToken . '";';
		echo 'window.opener.document.forms[1]["data[oauth_token_secret]"].value = "' . $oAuthTokenSecret . '";';
?>

		}
		parent.window.opener.focus();
		parent.close();
	}
</script>

<p>If this window doesn't close itself, something went wrong. Please copy the tokens manually to the extension configuration or try to sign in with Twitter again.</p>
<p>Access token: <?php echo $oAuthToken; ?></p>
<p>Access token secret: <?php echo $oAuthTokenSecret; ?></p>
</body>
</html>