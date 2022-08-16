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
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <link href="https://fonts.googleapis.com/css2?family=Chilanka&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">  
  <style>
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
    #find_Btn
    {
      background-color: #5F9EA0;
      color: white;
      border: 0px;
      border-radius: 30px;
      height: 40px;
      width: 150px;
      cursor:pointer;
      font-size: 22px;
    }
    #find_Btn:hover
    {
      background-color: #436d70
    }
    .find_input{
      height: 40px;
      margin-right: 10px;
      border: 2px solid #5F9EA0;
      border-radius: 10px;
      text-align: center;
      font-size: 20px;
    }
    #book_btn{
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
    <div class="btn-section">
      <div class="dropdown" >
        <button class="dropbtn" style="border-radius:25px" onclick="myFunction();document.getElementById('about').style.display = 'block'">
          About
        </button>
      </div>

      <div class="dropdown">
        <button class="dropbtn">Donations</button>
        <div class="dropdown-content">
          <a onclick="myFunction();document.getElementById('donate_now').style.display = 'block'" style="cursor: pointer;">Donate Now</a>
          <a onclick="myFunction();document.getElementById('my_donations').style.display = 'block'"  style="border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;cursor: pointer;">My Donations</a>
        </div>
      </div>

      <div class="dropdown">
        <button class="dropbtn">Requests</button>
        <div class="dropdown-content">
          <a onclick="myFunction();document.getElementById('request_now').style.display = 'block'" style="cursor: pointer;">Request Now</a>
         <a onclick="myFunction();document.getElementById('my_requests').style.display = 'block'" style="cursor: pointer;">My Requests</a>        
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

<div id="donate_now" style="display: none;">
<div class="header" style="margin: 10px 0px 0px 450px;">
  <h2>Donation Form</h2>
</div>

  <?php  $d_username=$_SESSION['username'];
    $conn = new mysqli('localhost','root','','registration');
    $user_id_query = "SELECT id FROM users WHERE username='$d_username' LIMIT 1";
    $result = mysqli_query($conn, $user_id_query);
    $user = mysqli_fetch_assoc($result);
    $d_user_id=$user['id'];
    $conn->close();
  ?>

  <form method="post" action="server2.php" style="border-top: 0px;padding-top: 0px;margin: 0px 450px">
    <div class="input-group" style="margin-top: 0px">
      <input type="text" name="item_name" style="margin-top: 10px" placeholder="Name of the item" required>
    </div>
    <div class="input-group">
      <?php 
        $d_post_date=date("Y-m-d");
      ?>
      <input type="Date" max='<?php echo $d_post_date; ?>' name="manufacture_date" placeholder="Date of Manufacture" required>
    </div>
    <div class="input-group">
      <input type="text" name="address" placeholder="Location" required>
    </div>
    <div class="input-group">
      <input type="text" name="pincode" placeholder="Pincode" required>
    </div>
    <div class="input-group">
      <input type="text" name="quantity" placeholder="Quantity" required>
    </div>
    
    <input type="text" name="d_user_id" style="display: none" value="<?php echo $d_user_id?>" >

    <div class="input-group" style="padding-bottom: 0px;margin-bottom: 0px;">
      <input type="submit" class="btn" style="width: 100%;height: 40px;font-size: 22px" name="donate_now" value="Donate Now">
    </div>
  </form>
</div>

<div id="my_donations" style="display: none;margin-left: 50px;margin-right: 50px;">
  <h3 style="width: 60%;margin-bottom: 25px;margin-left: 500px;color: #5F9EA0;font:30px oblique;">My Donations</h3>
  <table id="customers">
    <tr>
      <th>S.No</th>
      <th>Item Name</th>
      <th>Quantity</th>
      <th>Date of Manufacture</th>
      <th>Date of Donation</th>
      <th>Status</th>
      <th>Camp Name</th>
      <th>Settings</th>
    </tr>
    <?php 
      $conn = new mysqli('localhost','root','','registration');
      $sql = "SELECT * from G_resources WHERE user_id = '$d_user_id' ";
      $result = $conn->query($sql);
      if ($result-> num_rows >0){
        $i=1;
        while ($row = $result-> fetch_assoc())
        {
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['itemname']; ?></td>
      <td><?php echo $row['quantity']; ?></td>
      <td><?php echo $row['manufacture_date']; ?></td>
      <td><?php echo $row['donation_post_date']; ?></td>
      <td><?php echo $row['status']; ?></td>
      <?php
        $camp_id = $row['camp_id'];
        $querys = "SELECT * FROM employee WHERE camp_id='$camp_id' AND position='owner' ";
        $results = mysqli_query($conn,$querys);
        $rows = mysqli_fetch_assoc($results);
      ?>
      <td>
        <?php
        if ($row['status']=='Item Posted')
        {
          echo '-';
        }
        else
        { 
        echo $rows['username'];
        }
        ?>
        
      </td>
   <?php  if ($row['status']=='Item Posted') : ?>
      <form action="server2.php" method="POST">
        <td>
          <input type="text" name="id" style="display: none;" value="<?php echo $row['id'] ;?>">
          <input type="submit" name="delete_item_post" id="book_btn" value="Delete">
        </td>
      </form>
    </tr>  
  <?php endif ?>
    <?php $i=$i+1; } } ?>

  </table>
</div>

<div id="request_now" style="display: none;margin-left: 50px;margin-right: 50px;">
  <h3 style="width: 60%;margin-bottom: 25px;margin-left: 500px;color: #5F9EA0;font:30px oblique;">Request page</h3>
  <?php
    $camp_id='';
  ?>
  <form style="margin: 0px;border:0px;padding: 0px;width: 0px;border-radius: 0px;" action="index.php" method="POST">
  <table style="margin: 30px 130px">
    <tr>
      <td><input class="find_input "style="width: 150px;" type="text" name="pincode" placeholder="Pincode" required>
      </td>
      <td><input class="find_input" style="width: 450px;" type="text" name="delivery_location" placeholder="Delivery Location" required>
      </td>
      <td><input class="find_input" style="width: 200px" type="Date" min='<?php echo $d_post_date; ?>' name="delivery_date" placeholder="Date of Delivery" required>
      </td>
      <td><input id="find_Btn" type="submit" name="find_food" value="Find Food"></td>
    </tr>
  </table>

  <?php  if (isset($_POST['find_food'])) : ?>
    <script>
      var j = document.getElementById("about")
      var i = document.getElementById("request_now");
      i.style.display = "block";
      j.style.display = "none";
    </script>
    <?php
    $pincode = $_POST['pincode']; 
    $delivery_location = $_POST['delivery_location'];
    $delivery_date = $_POST['delivery_date'];

    $query = "SELECT * FROM donation_camp WHERE pincode='$pincode' ";
    $result = mysqli_query($conn,$query);
    if ($result->num_rows > 0)
    {
    $row = mysqli_fetch_assoc($result);
    $camp_id = $row['id'];
    $query = "SELECT * FROM employee WHERE camp_id='$camp_id' AND position='owner' ";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $campname = $row['username'];
    }    

    ?>
  <?php endif ?>
  </form>

  <table id="customers">
    <tr>
      <th>S.No</th>
      <th>Item Name</th>
      <th>Manufacture Date</th>
      <th>Quantity</th>
      <th>Expiry Date</th>
      <th>Camp Name</th>
      <th>Status</th>
    </tr>
    <?php
      $sql = "SELECT * from D_resources WHERE camp_id='$camp_id' AND status='Item posted'  ";
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
      <td><?php echo $campname;               ?></td>

      <form method="POST" action="server2.php">
      <td>
        <input type="text" name="username" style="display: none;" value="<?php echo $_SESSION['username']; ?>">
        <input type="text" name="item_id" style="display: none;" value="<?php echo $row['id']; ?>">
        <input type="text" name="delivery_location" style="display: none;" value="<?php echo $delivery_location; ?>">
        <input type="text" name="delivery_date" style="display: none;" value="<?php echo $delivery_date;  ?>">

        <input type="submit" name="book_resource" id="book_btn" value="Book">
      </td>
    </form>
    </tr>

    <?php $i=$i+1; } } ?>    
  </table>
</div>

<div id="my_requests" style="display: none;margin-left: 50px;margin-right: 50px;">
  <h3 style="width: 60%;margin-bottom: 25px;margin-left: 500px;color: #5F9EA0;font:30px oblique;">My requests</h3>
  <table id="customers">
    <tr>
      <th>S.No</th>
      <th>Item Name</th>
      <th>Manufacture Date</th>
      <th>Quantity</th>
      <th>Expiry Date</th>
      <th>Delivered Date</th>
      <th>Status</th>

    </tr>
    <?php
      $username = $_SESSION['username'];
      $query = "SELECT * FROM users WHERE username='$username' LIMIT 1 ";
      $result = mysqli_query($conn,$query);
      $row = mysqli_fetch_assoc($result);
      $user_id = $row['id'];    
      $sql = "SELECT * from D_resources WHERE user_id='$user_id' AND status='Item booked' ";
      $result = $conn->query($sql);
      if ($result-> num_rows >0){
        $i=1;
        while ($row = $result-> fetch_assoc())
        {
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['itemname'];         ?></td>
      <td><?php echo $row['manufacture_date']; ?></td>
      <td><?php echo $row['quantity'];         ?></td>
      <td><?php echo $row['expiry_date'];      ?></td>
      <td><?php echo $row['delivery_location'];?></td>
      <td><?php echo $row['delivery_date'];    ?></td>


    </tr>
    <?php $i=$i+1; } } ?>    
  </table>
</div>



<script>
  function myFunction() 
  {
    var x = document.getElementById("donate_now");
    var y = document.getElementById("my_donations");
    var z = document.getElementById("request_now");
    var p = document.getElementById("my_requests");
    var a = document.getElementById("about");
    var b = document.getElementById("contact");
    b.style.display = "none";
    x.style.display = "none"; 
    y.style.display = "none";
    z.style.display = "none";
    a.style.display = "none"; 
    p.style.display = "none"; 
  } 
</script>

<?php endif ?>
    
</body>
</html>