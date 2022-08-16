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
    <div class="btn-section" style="margin-left: 600px;">
      <div class="dropdown" >
        <button class="dropbtn" style="border-radius:25px" onclick="myFunction();document.getElementById('about').style.display = 'block'">About
        </button>
      </div>
      <div class="dropdown">
        <button class="dropbtn">Manage Staff</button>
        <div class="dropdown-content">
          <a onclick="myFunction();document.getElementById('add_emp').style.display = 'block'" style="cursor: pointer;">Add Employee</a>
          <a onclick="myFunction();document.getElementById('my_emp').style.display = 'block'"  style="border-bottom-left-radius: 15px;border-bottom-right-radius: 15px;cursor: pointer;">My Employees</a>
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

    <div id="add_emp" style="display: none;">
      <div class="header" style="margin: 10px 0px 0px 450px;font-size: 15px">
        <h2>Employee Enrolment Form</h2>
      </div>

  <?php  
    $owner_name=$_SESSION['username'];
    $conn = new mysqli('localhost','root','','registration');
    $user_id_query = "SELECT id FROM employee WHERE username='$owner_name' LIMIT 1";
    $result = mysqli_query($conn, $user_id_query);
    $user = mysqli_fetch_assoc($result);
    $owner_id=$user['id'];
    $conn->close();
  ?>      

      <form method="post" action="server2.php" style="border-top: 0px;padding-top: 5px;margin: 0px 450px;">
        <div class="input-group" style="margin-top: 0px">
          <input type="text" name="username" style="margin-top: 10px" placeholder="Employee Name" required>
        </div>
        <div class="input-group">
          <input type="text" name="email" placeholder="Email ID" required>
        </div>
        <input type="radio" name="position" value="resource_manager" required>
        <label style="font-size: 16px">Resource Manager</label>
        <input type="radio" name="position" value="quality_incharge" required>
        <label style="font-size: 16px">Quality Incharge</label>
      
        <div class="input-group">
          <input type="password" name="password" placeholder="New Password" required>
        </div>
        <input type="text" name="owner_id" style="display: none" value="<?php echo $owner_id?>" >
        <div class="input-group" style="padding-bottom: 0px;margin-bottom: 0px;">
          <input type="submit" class="btn" style="width: 100%;height: 40px;font-size: 22px" name="add_emp" value="Enroll Now">
        </div>
      </form>
    </div>

    <div id="my_emp" style="display: none;margin-left: 50px;margin-right: 50px">
      <h3 style="width: 60%;margin-bottom: 25px;margin-left: 500px;color: #5F9EA0;font:30px oblique;">My Employee</h3>
      <table id="customers">
        <tr>
          <th>S.No</th>
          <th>User Name</th>
          <th>Email-ID</th>
          <th>Position</th>
          <th>Status</th>
        </tr>
    <?php 
      $conn = new mysqli('localhost','root','','registration');
      $sql = "SELECT * from employee WHERE owner_id=$owner_id ";
      $result = $conn->query($sql);
      if ($result-> num_rows >0){
        $i=1;
        while ($row = $result-> fetch_assoc())
        {
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['position']; ?></td>
      
      <form action="server2.php" method="POST">
        <td>
          <?php 
            $id = $row['id'];
          ?>
          <input type="text" name="id" style="display: none;" value=" <?php echo $id ;?> ">
          <input type="submit" name="delete_emp" id="book_btn" value="Delete">
        </td>
      </form>
    </tr>  

    <?php $i=$i+1; } } ?>
      </table>

    </div>

<script>
  function myFunction() 
  {
    var x = document.getElementById("add_emp");
    var y = document.getElementById("my_emp");
    var z = document.getElementById("about");
    var q = document.getElementById("contact");
    q.style.display = "none";
    z.style.display = "none";
    x.style.display = "none"; 
    y.style.display = "none"; 
  } 
</script>    

  <?php endif ?>

</body>
</html>