<?php
if (array_key_exists('submitContactForm', $_POST)) {

	$firstName = trim( strip_tags($_POST['firstName'] 	?? '') );
	$lastName  = trim( strip_tags($_POST['lastName'] 	?? '') );
	$email     = trim( strip_tags($_POST['email'] 		?? '') );

	// Submit to Google Docs
	$baseURL = "https://script.google.com/macros/s/abc-123-your-google-deployment-id-here-12345/exec";

	$googleDocUrl = $baseURL			
		. "?firstName=" . urlencode($firstName)
		. "&lastName=" . urlencode($lastName)
		. "&email=" . urlencode($email);

	$visit = visitURL($googleDocUrl);

	// tell the user where to return to
	// ex if they didn't pass server-side validation, send them to "error.php"
	$goTo = "thanks.html";
	
	print $goTo;
}

function visitURL($url) {

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, $url);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // Follow any redirects

	$response = curl_exec($curl);

	if ($response === false) {
		echo 'cURL Error: ' . curl_error($curl);
	}

	curl_close($curl);

	return $response;
}
?>