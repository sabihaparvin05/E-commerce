<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Link</title>
</head>
<body>
<h1>Your reset Link is: <a href="{{route('reset.password.form')}}">{{ $resetLink }}</a>. Click here to reset your password</h1> 
</body>
</html>