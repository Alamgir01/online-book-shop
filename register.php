
<?php
     if(isset($_SESSION['email'])){
		 session_destroy() ;
	 }
	 session_start();
       include 'connection.php';
	  
	   $Firstname_err = $LastName_err = $Password_err = $Phone_err = $Email_err = $City_err = "";
	   $flag = 1;
	   $firstname = $lastname = $password = $phone = $email = $city="";
	   $Error_msg='';
	   
	   if(isset($_POST["register"])){
		   
		   /// firstname validation checking 
		   if(empty($_POST['firstname'])){        
			   
			      $Firstname_err="FirstName is requard" ;
				   $flag = 0;
		   }else {
			   
			     $firstname = trim($_POST['firstname']) ;// test_input($_POST['firstname']);
				 
				  if (!preg_match_all("/^[a-z_A-Z]*$/",$firstname)) {
					  
                        $Firstname_err = "Only letters and under_score allowed";
						$flag = 0;
						
                  }else {
					  
					   $firstname = $firstname ;
				  }
		   }
		   
		   ///lastname validation checking
	       if(empty($_POST["lastname"])){
			   
			     $LastName_err = "LastName is requard"; 
				 $flag = 0;
		   }else{
			                                                      
		         $lastname = test_input($_POST['lastname']);
		         
				 if(!preg_match("/^[a-z_A-Z]*$/",$lastname)){
					 
					 $LastName_err ="Only letters and white space allowed" ;
					 $flag = 0;
				 }
		   }
		   
		    
                 /// password checking
		   if(empty($_POST['password'])){
			   
			     $Password_err = "password is requard" ;
				 $flag = 0;
		   }else{ 
		   
				$password = trim($_POST['password']);
				
				if(strlen($password)<6){
					
					$Password_err = "password must be at least 6 character long";
					$flag = 0;
					
				}else{
				   
				   $password = password_hash($password,PASSWORD_DEFAULT);
				}
		   }
		   
		   
		   // phone number checking 
		   if(empty($_POST['phone'])){
			   
			   $Phone_err = "phone number is requard";
			   $flag = 0;
			   
		   } else{
			   
               $phone = test_input($_POST['phone']);
			   
			   if(!preg_match_all("/^\+[0-9]+$/",$phone)){                 //ctype_digit ( $text );
				   
				   $Phone_err = " your phone number is not valid" ;
				   $flag = 0;
				   
			   }else {
				   
			   if(strlen($phone)==14){
				   
				 $phone = $phone ;
				   
			   } else {
				
				  $Phone_err = "phone number must be 14 character LONG ex:+8801xxxxxxxx";
				  $flag = 0;
				  
			   }
			   
			   }

		   }
		   
		   
		   //email validation
		   if(empty($_POST['email'])){
			   
			   $Email_err = "Email is requard";
			   $flag = 0;
			   
		   }else{
			   
			   //$email = test_input($_POST['email']);
			   
			   $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL) ;
			   
			   if(filter_var($email,FILTER_VALIDATE_EMAIL)){
				   
				   $email = $email ;

			   }else{
				   
				     $Email_err = "please enter a valid email " ;
					 $flag = 0;
			   }
		   }
		   
		   
		   //city validation
		   if(empty($_POST['city'])){
			   
			   $City_err = " city is requared " ;
			   $flag = 0;
			   
		   }else{
			   
			   //$city = test_input($_POST['city']);
			   $city = filter_var($_POST['city'],FILTER_SANITIZE_STRING) ;
		   }		   		   
	   
	   
	   
	   //inserting data 
        if($flag == 1){
			$query = "select Email from users where Email = '$email' ";
			$results = mysqli_query($connect,$query);
			if(mysqli_num_rows($results)==0){				
				$sql ="insert into users values ('','$firstname','$lastname','$password','$phone','$email','$city')";
					$result = mysqli_query($connect,$sql);
					if($result){
						$_SESSION['message'] = "Registered successful please log in ";
						header("LOCATION:home.php") ;
					}else{
					   echo	mysqli_error($connect);
					}	           				   
			}else{
				$Error_msg ="Email address is already exist";
			} 
			}else{
				  $Error_msg ="please fill all the field correctly";
			}
	   }		
	   
	  function test_input($input_data){
		  
		  $data = trim($input_data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data ;
	   }
	   
        mysqli_close($connect);
?>
  
  
	<!DOCTYPE HTML>
	<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="css/register.css" />
	</head>
	<body>
		        <div id="modal-register" class="modal">
							<form class="modal-content" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							    <span><?php echo $Error_msg;?></span>
								<div class="container">  
									  <label for="fname">First Name</label>
									  <input type="text" placeholder="Enter First name"  name="firstname"  required /><span> <?php echo $Firstname_err;?></span><br/>
									  <label for="lname">Last Name</label>
									  <input type="text" placeholder="Enter Last name" name="lastname" required /><span> <?php echo $LastName_err;?></span><br/>
									  <label for="pass">Password</label>
									  <input type="password" placeholder="Enter password" name="password" required /><span> <?php echo $Password_err;?></span><br/>
									  <label for="phon">Phone</label>
									  <input type="text" placeholder="Enter phone number ex:+88" name="phone" required /><span> <?php echo $Phone_err;?></span><br/>
									  <label for="email">Email</label>
									  <input type="text" name="email" placeholder="Enter email" required /><span> <?php echo $Email_err;?></span><br/>
									  <label for="addr">Address</label>
									  <input type="text" name="city" required placeholder="Enter city" /><span> <?php echo $City_err;?></span><br/>
									  <input type="submit" value ="Register" name="register" />
									  <a href="home.php" style="float:right;text-decoration:none;padding-top:15px;">Goto Home</a>
								 </div>
							 </form>
				</div>	
	</body>
	</html>
		      
   		        	 
		 