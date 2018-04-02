<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Confirmation</title>
</head>
<body>
    <h1>We have confirmed your email!</h1>

    <p>
        We just need you to <a href='{{ url("api/forgetpassword/{$user->token}/{$user->id}") }}'>change your password</a> real quick!
    </p>
</body>
</html>
