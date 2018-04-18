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
        <p style="font-family:Sugoe UI;font-size:20px">
            This is an email confimation email from RangkasPC.<br>
            If you have not signed up to RangkasPC recently, please ignore this email.<br><br><br><br>
        </p>
      </td>
    </tr>
    <tr>
      <td>
        <form action="http://localhost:8000/user/verify/{{$verification_code}}">
          <center><input style="font-size:20px;font-family:Sugoe UI" type="submit" value="Verify your email"></center>
        </form>
      </td>
    </tr>
  </table>
</body>
</html>
