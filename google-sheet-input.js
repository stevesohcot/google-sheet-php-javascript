var ajaxPath = 'submit-to-google-sheet-from-php.php';

function submitForm() {

	// additional data validation here

	$.ajax({
		url: ajaxPath,
		method: 'POST',
		data: {
			submitContactForm: 1,
			firstName: $('#firstName').val(),
			lastName: $('#lastName').val(),
			email: $('#email').val(),
		},
		dataType: 'html',
		success: function (response) {
			// content returned will be where they should be redirected
			//		ex thanks.php or error.php
			//console.log(response);
			let goTo = $.trim(response);
			window.location = goTo;
			return false;
		},
		error: function (xhr, status, error) {
			console.error('Request failed:', status, error);
			return false;
		}
	});

	return false;

}
