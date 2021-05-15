<!DOCTYPE html>
<html lang="en">
    <title></title>
  </head>
  <body>
<h1 style="text-align:center;">Welcome User</h1>
<h4 style="text-align:center;">Please Register here</h4>
<form method="post" action="register.php">
<label>CNIC</label>
<input type="text" required="" name="cnic" placeholder="CNIC" />
<br />
<label>Password</label>
<input type="password" name="pwd" required="" placeholder="password"  />
<button name="register" type="submit">Register</button>
<button name="login" type="submit">Login</button>
</form>

<form method="post" action="register.php">
<input type="text" name="name" />
<input type="password" name="a_password" />
<button name="admin" type="submit">Admin</button>
</form>

  </body>
</html>