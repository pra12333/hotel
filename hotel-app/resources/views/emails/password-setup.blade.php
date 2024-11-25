<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Setup</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>Click the link below to set up your password:</p>
    <a href="{{ $setupUrl }}">Set Your Password</a>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>
