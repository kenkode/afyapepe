<?php

	 include 'config.inc.php';
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['username']) && isset($_POST['password']))
     {
		  // Innitialize Variable
		  
	   	  $username = $_POST['username'];
          $password = $_POST['password'];
		  
		  // Query database for row exist or not
          $sql = 'SELECT * FROM users WHERE  email = :username AND password = :password';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR);
          $stmt->bindParam(':password', $password, PDO::PARAM_STR);
          $stmt->execute();
          if($stmt->rowCount())
          {
			 	
			 return true;
			 echo "Success";
			 json_encode("lol");
			 $result="true";
          }  
          elseif(!$stmt->rowCount())
          {
			  	
				echo "Failed";
				json_encode("nuh");
				$result="false";
          }
		  else
		  {
			  json_encode("meeh");
			  
		  }
		  
		
		  
		  // send result back to android
   		  echo $result;
  	}
	
?>