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
      border-radius: 0px;
      border:0px
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
    <div class="btn-section" style="margin-left: 600px;">
      <div class="dropdown" >
        <button class="dropbtn" style="border-radius:25px" onclick="myFunction();document.getElementById('about').style.display = 'block'">
          About
        </button> 
      </div>
      <div class="dropdown">
        <button class="dropbtn">Resources</button>
        <div class="dropdown-content">
          <a onclick="myFunction();document.getElementById('acquire_resources').style.display = 'block'" style="cursor: pointer;">Acquire Food</a>
          <a onclick="myFunction();document.getElementById('my_resources').style.display = 'block'"  style="border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;cursor: pointer;">My Resources</a>
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

<div id='acquire_resources' style="margin-left: 10px;margin-right: 10px;display: none;">
  <h3 style="width: 60%;margin-bottom: 25px;margin-left: 450px;color: #5F9EA0;font:30px oblique;">Resources Available</h3>
  <table id='customers'>
    <tr>
      <th>S.No</th>
      <th>Item Name</th>
      <th>Quantity</th>
      <th>Manufactured Date</th>
      <th>Address</th>
      <th>Posted By</th>
      <th>Posted On</th>
      <th>Status</th>
    </tr>

    <?php
      $org_username = $_SESSION['username'];
      $conn = new mysqli('localhost','root','','registration');  
      $query = "SELECT * FROM employee WHERE username='$org_username' LIMIT 1";
      $result = mysqli_query($conn,$query);
      $user = mysqli_fetch_assoc($result);
      $camp_id = $user['camp_id'];

      $query = "SELECT * FROM donation_camp WHERE id='$camp_id' LIMIT 1";
      $result = mysqli_query($conn,$query);
      $user = mysqli_fetch_assoc($result);
      $pincode = $user['pincode'];

      $sql = "SELECT * from G_resources WHERE pincode='$pincode' AND status='Item posted' ";
      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result) > 0){
        $i=1;
        while ($row = mysqli_fetch_assoc($result))
        {
          $user_id = $row['user_id'];
          $username_query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
          $username_result = mysqli_query($conn,$username_query);
          $name_user = mysqli_fetch_assoc($username_result);
          $username = $name_user['username'];

    ?>
    <tr>
      <td><?php echo $i                        ; ?></td>
      <td><?php echo $row['itemname']          ; ?></td>
      <td><?php echo $row['quantity']          ; ?></td>
      <td><?php echo $row['manufacture_date']  ; ?></td>
      <td><?php echo $row['address']           ; ?></td>
      <td><?php echo $username                 ; ?></td>
      <td><?php echo $row['donation_post_date']; ?></td>  
      <td>
        <form method='POST' action='server2.php' onsubmit="myFunction()">
          <input type="text" name="id" id='id' style="display: none;" value="<?php echo $row['id']   ;?>">
          <input type="text" name="camp_id" id='camp_id' style="display: none" value="<?php echo $camp_id ;?>">
          <input type="submit" name="book_item" value="Book" id='book_btn'>
    
    <script>
      function myFunction(){
      var j = document.getElementById("about");
      var i = document.getElementById("acquire_resources");
      i.style.display = "block";
      j.style.display = "none";
    }
    </script>

        </form>
      </td>
    </tr>
    <?php $i=$i+1; } } ?>
  </table>
</div>
<div id='my_resources' style="margin-left: 10px;margin-right: 10px;display: none;">
  <h3 style="width: 60%;margin-bottom: 25px;margin-left: 450px;color: #5F9EA0;font:30px oblique;">My Resources</h3>
  <table id="customers">
    <tr>
      <th>S.No</th>
      <th>Iten Name</th>
      <th>Quantity</th>
      <th>Manufacture Date</th>
      <th>Delivery Address</th>
      <th>Date of Delivery</th>
      <th>Status</th>
    </tr>

    <?php 
      $conn = new mysqli('localhost','root','','registration');
      $sql = "SELECT * from D_resources WHERE camp_id='$camp_id' ; ";
      $result = $conn->query($sql);
      if ($result-> num_rows >0){
        $i=1;
        while ($row = $result-> fetch_assoc())
        {
    ?> 
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['itemname'];         ?></td>
      <td><?php echo $row['quantity'];         ?></td>
      <td><?php echo $row['manufacture_date']; ?></td>
      <td><?php echo $row['delivery_location'];?></td>
      <td><?php echo $row['delivery_date'];    ?></td>
      <td><?php echo $row['status']; ?></td>
    </tr>  

    <?php $i=$i+1; } } ?>

  </table>

</div>

<script>
  function myFunction() 
  {
    var x = document.getElementById("acquire_resources");
    var y = document.getElementById("my_resources");
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