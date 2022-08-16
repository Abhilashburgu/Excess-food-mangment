<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	<h1 style="position: absolute; margin-left: 150px; margin-top: 80px;color:#5F9EA0;font: 50px oblique ;">fudee</h1>
  <h3 style="position:absolute; margin-left: 150px;margin-top: 145px;font-style: italic;font-weight: normal;">A Place to Feed the One in Need</h3>
  <div class="selector">
  <input type="radio" name='check' onclick="document.getElementById('dr_reg').style.display = 'block';
  document.getElementById('org_reg').style.display = 'none' " checked>
  <label>Donor/Receiver</label>
  <input type="radio" name='check' onclick="document.getElementById('org_reg').style.display = 'block';
  document.getElementById('dr_reg').style.display = 'none'">
  <label>Organisation</label>
  </div> 
  <form method="post" action="register.php" style="border-top: 0px;padding-top: 0px;" id="dr_reg">
  	<?php include('errors.php'); ?>
  	<div class="input-group" style="margin-top: 0px;">
  	  <input type="text" name="username" placeholder="Username">
  	</div>
  	<div class="input-group">
  	  <input type="email" name="email" placeholder="Email-ID">
  	</div>       
  	<div class="input-group">
  	  <input type="password" name="password_1" placeholder="New Password">
  	</div>
  	<div class="input-group">
  	  <input type="password" name="password_2" placeholder="Confirm Password">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="dr_reg_user">Sign Up</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>

  <form method="post" action="register.php" style="border-top: 0px;padding-top: 0px;" id="org_reg">
    <?php include('errors.php'); ?>
    <div class="input-group" style="margin-top: 0px;">
      <input type="text" name="username"  placeholder="Organisation name">
    </div>
    <div class="input-group">
      <input type="email" name="email" placeholder="Email-ID">
    </div>
   <div class="input-group">
      <input type="text" name="pincode" placeholder="Pincode">
    </div>
    <div class="input-group">
      <input type="text" name="ph_no" placeholder="Phone Number">
    </div> 
    <div class="input-group">
      <input type="password" name="password_1" placeholder="New Password">
    </div>
    <div class="input-group">
      <input type="password" name="password_2" placeholder="Confirm Password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="org_reg_user">Sign Up</button>
    </div>
    <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
</body>
</html>