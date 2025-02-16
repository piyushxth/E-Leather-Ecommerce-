<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
	<div>
        <p>Dear User,</p>
		<p>
            It seems like you forgot your password for {{ env('APP_NAME') }}. Click the link below to reset your password.
        </p>

        <p><a href="{{ $data_array['expiry_url'] }}">Password reset Link </a></p>

        <p>Reset link expires on 30 mins</p>

		<p>
			<small>Note:This email is auto generate from {{ env('APP_NAME') }}. Please do not reply this email.</small>
		</p>
	</div>

</body>

</html>
