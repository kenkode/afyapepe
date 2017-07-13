<?php





$con = mysqli_connect("localhost","root","afya2017","afyapepe") or die("connection error!");





 
 //$username = $_POST['username'];
//$password = $_POST['password'];
 $username= "register@afyapepe.com";
 $password= "register1";
 







 
 
$result='';

$user = array();

$query = mysqli_query($con,"select * from users where email='$username'");


		  

if(mysqli_num_rows($query) > 0){
	
   $row = mysqli_fetch_assoc($query);
    if(password_verify($password,$row['password']) == true){
		
		
	$user['user'] = $row;
	$user['success'] = "Successfully logged in";
	
	echo json_encode($user);
	
	
          $result="true";	
          }
		  
		  
		  else{
	$user['error'] = "Wrong Credentials";
	echo json_encode($user);
	 

	     $result="false";
	    }
		
		
      }
		 
		 else{
	$user['error'] = "Wrong details";
	echo json_encode($user);
	
	 $result="false";
	
	  }
	 
	
	
	echo $result;

	?>