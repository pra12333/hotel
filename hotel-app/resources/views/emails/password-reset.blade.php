<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <p>Click the button below to reset your password:</p>
    <a href="{{ url('/reset-password/'.$token) }}">Reset Password</a>
</body>
</html>
