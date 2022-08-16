<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Fudee</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="header">
  	<h2>Login</h2>
  </div>

  <h1 style="position: absolute; margin-left: 150px; margin-top: 80px;color:#5F9EA0;font:50px oblique;">fudee</h1>
  <div class="selector">
  <input type="radio" name='check' onclick="document.getElementById('dr_login').style.display = 'block';
  document.getElementById('org_login').style.display = 'none' " checked>
  <label>Donor/Receiver</label>
  <input type="radio" name='check' onclick="document.getElementById('org_login').style.display = 'block';
  document.getElementById('dr_login').style.display = 'none'">
  <label>Organisation</label>
  </div> 
  <h3 style="position:absolute; margin-left: 150px;margin-top: 100px;font-style: italic;font-weight: normal;">A Place to Feed the One in Need</h3>

  <form method="post" action="login.php" id="dr_login" style="border-top: 0px;padding-top: 0px;">
  	<?php include('errors.php'); ?>
  	<div class="input-group" style="margin-top: 0px;">
  		<input type="text" name="username" placeholder="Username">
  	</div>
  	<div class="input-group">
  		<input type="password" name="password" placeholder="Password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Log In</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>

  <form method="post" action="login.php" id="org_login" style="border-top: 0px;padding-top: 0px;">
    <?php include('errors.php'); ?>
    <div class="input-group" style="margin-top: 0px;">      
      <input type="text" name="username" placeholder="Organisation Name">
    </div>
    <div class="input-group">
      <input type="password" name="password" placeholder="Password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="org_login_user">Log In</button>
    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>

</body>
</html>