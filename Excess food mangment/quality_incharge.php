<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>fudee</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <link href="https://fonts.googleapis.com/css2?family=Chilanka&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">   
    <style>
    
    form{
      margin: 0px;
      padding: 0px;
      width: 0px;
      border-radius: 0px;
    }
    #start_about
    {      
      color: rgba(95, 158, 160);      
      padding: 130px 180px;
    }
    #mid_about
    {
      color: rgba(95, 158, 160);      
      padding: 100px 170px 200px 180px;
    }    
    #expiry_date{
      padding:5px 7px;
      width: 110px;
      font-size: 20px;
      border-radius: 5px;
      border:0px; 
      background: white;
    }
    .post_btn{
      cursor:pointer;
      font-weight: bold;
      padding:5px 7px;
      font-size: 20px;
      color: white;
      background: #5F9EA0;
      border-radius:10px
    }    
  </style>	
</head>
<body style="background-color: white;">
<?php if (isset($_SESSION['success'])) : ?>
    <?php unset($_SESSION['success']);?>
  <?php endif ?>
  <!-- logged in user information -->
  <?php  if (isset($_SESSION['username'])) : ?>
    <div style="position: absolute;margin:15px 0px 0px 10px;">
      <h1 style="position:absolute;margin:3px 20px;color:#5F9EA0;font: 35px oblique;">fudee</h1><br>
      <h3 style="margin:23px 0px 0px 20px;font:15px italic;">Every Grain Matter's</h3>
    </div>
    <div class="btn-section" style="margin-left: 600px">
      <div class="dropdown" >
        <button class="dropbtn" style="border-radius:25px" onclick="myFunction();document.getElementById('about').style.display = 'block'">
          About
        </button>      
      </div>
      <div class="dropdown">
        <button class="dropbtn">Resources</button>
        <div class="dropdown-content">
          <a onclick="myFunction();document.getElementById('acquired_foods').style.display = 'block'" style="cursor: pointer;">Acquired Food</a>
          <a onclick="myFunction();document.getElementById('posted_food').style.display = 'block'"  style="border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;cursor: pointer;">Posted Food</a>
        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn" style="border-radius:25px" onclick="myFunction();document.getElementById('contact').style.display = 'block'">Contact Us
        </button>      
      </div>

      <div class="dropdown">
        <button class="dropbtn"><?php echo $_SESSION['username']; ?></button>
        <div class="dropdown-content">
          <a href="#">My Account</a>
          <a href="index.php?logout='1'" style="border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;">Sign out</a>
        </div>
      </div>
    </div>
    <br><br><br><br><br>
<div id="about">
  <div id="start_about">
    <h2 style="padding: 20px 340px;font-size:35px;font-family: 'Playfair Display', serif;">Our Vision</h2>
    <h3 style="padding: 20px 200px;font:40px oblique;">Make India Hunger Free</h3>
  </div>
  <div id="mid_about">
    <h2 style="margin-bottom: 50px;font:32px oblique;font-family: 'Sofia'"><strong>Fudee India</strong> provides the right channels for compassionate citizens to begin and manage initiatives, that solve for hunger locally.</h2>
    <img src="zomato.png" alt="Fudee Employee's" height="250px" width="380px" style="float:right;">
    <h3 style="font:20px oblique;width:500px;line-height: 200%;font-family: 'Chilanka', cursive;">
      With a network of 26,000+ volunteers across 100+ cities in India, fudee India continues to work towards its joint mission of ‘better food for more people’ and ‘food for everyone’ to take the dream of ending hunger a step closer to reality.
    </h3> 
  </div>
</div> 

<div id="contact" style="display: none;margin: 40px 200px;background-color: #5F9EA0;color: white;border-radius: 20px;padding: 20px">
  <p style="margin-bottom: 20px;font-size: 25px">Email-ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : fudeeindia@gmail.com <br></p>
  <p style="margin-bottom: 20px;font-size: 25px">Phone Number : 76*******76 <br></p>
  <p style="font-size: 25px">Office Address &nbsp;: 8-120/202, Ayyapa society,Madhapur,Hyderabad <br></p>
</div>

<div id='acquired_foods' style="margin-left: 150px;margin-right: 150px;display: none;">
  <h3 style="width: 60%;margin-bottom: 25px;margin-left: 250px;color: #5F9EA0;font:30px oblique;">Acquired Resources</h3>
  <table id="customers">
    <tr>
      <th>S.No</th>
      <th>Iten Name</th>
      <th>Manufacture Date</th>
      <th>Quantity</th>
      <th>Expiry Date</th>
      <th>Settings</th>
    </tr>

    <?php 
      $org_username = $_SESSION['username'];
      $conn = new mysqli('localhost','root','','registration');
      $query = "SELECT * FROM employee WHERE username='$org_username' LIMIT 1";
      $result = mysqli_query($conn,$query);
      $user = mysqli_fetch_assoc($result);
      $camp_id = $user['camp_id'];
      $sql = "SELECT * from D_resources WHERE camp_id='$camp_id' AND status='Item Acquired' ; ";
      $result = $conn->query($sql);
      if ($result-> num_rows >0){
        $i=1;
        while ($row = $result-> fetch_assoc())
        {
    ?> 
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['itemname'];        ?></td>
      <td><?php echo $row['manufacture_date'];?></td>
      <form method="POST" action="server2.php">
      <td>
      	<input type="text" name="quantity" value = '<?php echo $row['quantity']; ?>' >
      </td>
      <td style="width: 130px;">
      <?php 
        $m_date = $row['manufacture_date'];
      ?>        
      	<input type="Date" min='<?php echo $m_date; ?>' name="expiry_date" id="expiry_date" style="width: 160px" required>
      	<input type="text" name="id" style="display: none;" value='<?php echo $row['id']; ?>' >
      </td>
      <td style="width: 150px">        
      	<input type="submit" name="post_resource" class="post_btn" value="Post">
      	<input type="submit" name="reject_resource" class="post_btn" value="Reject">
      </td>
      </form>	
    </tr>  

    <?php $i=$i+1; } } ?>

  </table>

</div>

<div id='posted_food' style="margin-left: 150px;margin-right: 150px;display: none;">
  <h3 style="width: 60%;margin-bottom: 25px;margin-left: 250px;color: #5F9EA0;font:30px oblique;">Posted Foods</h3>  
  <table id="customers">
    <tr>
      <th>S.No</th>
      <th>Iten Name</th>
      <th>Manufacture Date</th>
      <th>Quantity</th>
      <th>Expiry Date</th>
      <th>Status</th>
      <th>Settings</th>    
    </tr>
    <?php
      $sql = "SELECT * from D_resources WHERE camp_id='$camp_id' AND status='Item posted' ; ";
      $result = $conn->query($sql);
      if ($result-> num_rows >0){
        $i=1;
        while ($row = $result-> fetch_assoc())
        {
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['itemname'];        ?></td>
      <td><?php echo $row['manufacture_date'];?></td>
      <td><?php echo $row['quantity'];        ?></td>
      <td><?php echo $row['expiry_date'];     ?></td>
      <td><?php echo $row['status'];          ?></td>
      <td>
      <?php  if ($row['status']=='Item posted') : ?>
        <form action="server2.php" method="POST">
          <input type="text" name="id" style="display: none;" value="<?php echo $row['id']; ?>" >
          <input type="submit" name="delete_post" class="post_btn" value="Delete">
        </form>
      <?php endif ?>  
      </td>    
    </tr>

    <?php $i=$i+1; } } ?>

  </table>
</div>

<script>
  function myFunction() 
  {
    var x = document.getElementById("acquired_foods");
    var y = document.getElementById("posted_food");
    var z = document.getElementById("about");
    var a = document.getElementById("contact");

    a.style.display = "none"; 
    x.style.display = "none"; 
    y.style.display = "none";
    z.style.display = "none"; 
  } 
</script>

<?php endif ?>

</body>
</html>