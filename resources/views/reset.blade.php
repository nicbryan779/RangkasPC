<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h1>We have confirmed your email!</h1>

    <p>
      <br>
      <br>
      <br>
        Please <a href='{{ url("api/forgetpassword/$verification_code") }}'>click here</a> to create a new password!
    </p>
</body>
</html>