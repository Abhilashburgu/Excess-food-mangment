<?php

$conn = new mysqli('localhost','root','','registration');

if ($conn->connect_error)
{
  die('connection Failed : '.$conn->connect_error);
}
else
{
  if (isset($_POST['donate_now'])) 
  {

    $item_name=$_POST['item_name'];
    $address=$_POST['address'];
    $pincode=$_POST['pincode'];
    $quantity=$_POST['quantity'];
    $manufacture_date=$_POST['manufacture_date'];
    $d_post_date=date("Y-m-d");
    $d_user_id=$_POST['d_user_id'];
    $d_status='Item Posted';

    $stmt = $conn->prepare("INSERT INTO G_resources(itemname,address,pincode,manufacture_date,quantity,donation_post_date,user_id,status) VALUES(?,?,?,?,?,?,?,?);");
    $stmt->bind_param("ssisssis",$item_name,$address,$pincode,$manufacture_date,$quantity,$d_post_date,$d_user_id,$d_status);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('location: index.php');
  }

  if (isset($_POST['add_emp'])) 
  {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $position=$_POST['position'];
    $owner_id=$_POST['owner_id'];

    $query="SELECT * FROM employee WHERE id='$owner_id' ";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $camp_id = $user['camp_id'];

    $password = md5($password); 
    $stmt = $conn->prepare("INSERT INTO employee (username,email,password,position,owner_id,camp_id) VALUES(?,?,?,?,?,?);");
    $stmt->bind_param("ssssii",$username,$email,$password,$position,$owner_id,$camp_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('location: org_index.php');
  }   
  if (isset($_POST['book_item']))
  {
    $camp_id = $_POST['camp_id'];
    $id = $_POST['id'];
    $query = "UPDATE G_resources SET status='Item booked', camp_id='$camp_id' WHERE id='$id' ;";
    $result = mysqli_query($conn,$query);
    $query = "SELECT * FROM G_resources WHERE id='$id' ;" ;
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
  
    $status = 'Item Acquired';
    $stmt = $conn->prepare("INSERT INTO D_resources (itemname,quantity,manufacture_date,camp_id,status) VALUES(?,?,?,?,?);");
    $stmt->bind_param("sssis",$row['itemname'],$row['quantity'],$row['manufacture_date'],$camp_id,$status);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header('location: resource_manager.php');
  }      
  if (isset($_POST['post_resource']))
  {
    $status = 'Item posted';
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $query = "UPDATE D_resources SET status='Item posted', expiry_date='$expiry_date' , quantity='$quantity'  WHERE id='$id' ;" ;
    $result = mysqli_query($conn,$query);
    header('location: quality_incharge.php');
  }
  if (isset($_POST['reject_resource']))
  {
    $status = 'Item rejected';
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $query = "UPDATE D_resources SET status='$status', expiry_date='$expiry_date' , quantity='$quantity'  WHERE id='$id' ;" ;
    $result = mysqli_query($conn,$query);
    header('location: quality_incharge.php');
  }  
  if (isset($_POST['book_resource']))
  {
    $conn = new mysqli('localhost','root','','registration');    
    $username = $_POST['username'];
    $id = $_POST['item_id'];
    $delivery_location = $_POST['delivery_location'];
    $delivery_date = $_POST['delivery_date'];
    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1 ";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
    $query = "UPDATE D_resources SET status='Item booked', user_id='$user_id', delivery_date='$delivery_date', delivery_location='$delivery_location' WHERE id='$id' " ; 
    $result = mysqli_query($conn,$query);
    header('location: index.php');  
  }
  if (isset($_POST['delete_post']))
  {
    $id = $_POST['id'];
    $status = 'Item Acquired';
    $query = "UPDATE D_resources SET status='$status', expiry_date=NULL WHERE id='$id' ;" ;
    $result = mysqli_query($conn,$query); 
    header('location: quality_incharge.php');  
  }
  if (isset($_POST['delete_item_post']))
  {
    $id = $_POST['id'];
    $query = "DELETE FROM G_resources WHERE id='$id';";
    $result = mysqli_query($conn,$query);
    header('location: index.php');
  }

  if (isset($_POST['delete_emp']))
  {
    $id = $_POST['id'];
    $query = "DELETE FROM employee WHERE id='$id';";
    $result = mysqli_query($conn,$query);
    header('location: org_index.php');
  }

}
?>