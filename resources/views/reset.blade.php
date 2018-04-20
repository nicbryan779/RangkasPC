<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Confirmation</title>
</head>
<body>
  <table style="width:600px" border="0">
    <tr>
      <td style="background-color:red;color:white"><h1 style="font-family:Sugoe UI">RangkasPC</h1></td>
    </tr>
    <tr>
      <td>
        <p style="font-family: sans-serif;font-size:15px">
            Hi, {{$name}} <br><br>
            We have confirmed your email! Please click the button below to change your password<br>
            We wish you a great time. Happy Gaming!  :)<br><br>
        </p>
      </td>
    </tr>
    <tr>
      <td>
        <form action="http://localhost:4200/resetpassword/{{$verification_code}}">
          <center><input style="font-size:20px;font-family:sans-serif" type="submit" value="Create New Password"></center>
        </form>
      </td>
    </tr>
    <tr>
      <td>
        <p style="font-family:Sugoe UI;font-size:12px">
          <br><br><br>
            This is an email confimation email from RangkasPC.<br>
            If you have not signed up to RangkasPC recently, please ignore this email.
        </p>
      </td>
    </tr>
  </table>
</body>
</html>
