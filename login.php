<?php
    session_start();
      include 'connection.php';
	  
	  $Email_err = $Password_err = $Error_msg = '';
	  $email = $password = '';
	  $flag = 1 ;
	  
	  
	   if(isset($_POST['login'])){
		   			   
			   if(empty($_POST['email'])){
				   $Email_err ="please enter Email";
				   $flag = 0 ;
			   }else{
				   $email =filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
				   if(filter_var($email,FILTER_VALIDATE_EMAIL)){
					    $email = $email ;
				   }else{					   
					   $Email_err ="plese enter valid email ";
					   $flag = 0 ;
				   }
			   }
			   
			   if(empty($_POST['password'])){
				   $Password_err ="please enter password";
				   $flag = 0 ;
			   }else{
				    $password  = trim($_POST['password']);
					if(strlen($password)<6){
						$Password_err ="password must be 6 character long";
				        $flag = 0 ;
					}
			   }
			   
		if($flag ==1){   
	        $sql = "select User_id , email , password 
	            from users
				where email ='$email'";
            $res = mysqli_query($connect,$sql) ;
	 
	       if(mysqli_affected_rows($connect)==1){
	        $row=mysqli_fetch_array($res);
			$hash_password = $row['password'] ;
			
			  if(password_verify($password,$hash_password)){
				   $_SESSION['user_id'] = $row['User_id'];
	               $_SESSION['email'] = $row['email'];
                   $_SESSION['message']="successfully loged in";				   
			       header("Location:home.php");
				   exit ;
	         }else {
	         $Error_msg = "sorry wrong password or user name" ;          
		   }		  
		}else{
			
			 $Error_msg = "Email not found ";
		}
	  }		
	}
	
?>
		
		<!DOCTYPE HTML>
				<html lang="en-US">
				<head>
					<meta charset="UTF-8">
					<title></title>
					<link rel="stylesheet" href="css/login.css" />
				</head>
				<body>
					<div id="modal-login" class="modal">
							 <form  class="modal-content" action="login.php" method="post">
							 <span class="error"><?php echo $Error_msg;?></span> <br />
							    <div class="container">
								   <label for="uname"><b>Email</b></label> <span class="error"><?php echo $Email_err ; ?></span> 
								   <input type="text" placeholder="Enter Email" name="email" required>  
								   <label for="psw"><b>Password</b></label> <span class="error"><?php echo $Password_err ;?></span>
								   <input type="password" placeholder="Enter Password" name="password" required> 				
								   <button type="submit" name="login">Login</button>
								     <span class="psw">Forgot <a href="#">password?</a></span>
								 </div>
                                  <div class="container" style="background-color:#f1f1f1">
									
									   <div>  <span class="reg">Don't have an account? <a href="register.php">sign up</a></span></div>
								 </div>								 
							 </form>						       
				</div>

		          
				</body>
				</html>

			