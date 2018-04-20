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
            Your recent purchase have been confirmed. Below is the redeem code for your purchase of {{$product_name}}<br>
            Thank you and please stop by again soon. We are happy to welcome you with new items in store <br>
            We wish you a great time. Happy Gaming!  :)<br><br>
        </p>
      </td>
    </tr>
    <tr>
      <td style="background-color:#e6e6e6; font-size:20px">
        <br>
        <br>
        <center>{{$verification_code}}</center>
        <br>
        <br>
      </td>
    </tr>
  </table>
</body>
</html>
