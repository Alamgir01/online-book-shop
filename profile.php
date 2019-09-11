<?php
session_start();
if(!isset($_SESSION['user_id']) && !isset($_SESSION['email'])){
	echo "you must log in !";
	exit();
}
include "connection.php";
//echo "profile   " .$_SESSION['email']."<br />";
 $userid = $_SESSION['user_id'];
 
  if(isset($_POST['update'])){
	  
	  $Firstname_err = $LastName_err = $Password_err = $Phone_err = $Email_err = $City_err = "";
	   $flag = 1;
	   $firstname = $lastname = $password = $phone = $email = $city="";
	  		   
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
		         $lastname =  trim($_POST['lastname']); //test_input($_POST['lastname']);		         
				 if(!preg_match("/^[a-z_A-Z]*$/",$lastname)){					 
					 $LastName_err ="Only letters and white space allowed" ;
					 $flag = 0;
				 }
		   }
		   		    
           /// password checking
		  /* if(empty($_POST['password'])){
			   
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
		   }*/
		   
		   
		   // phone number checking 
		   if(empty($_POST['phone'])){			   
			   $Phone_err = "phone number is requard";
			   $flag = 0;			   
		   }else{			   
               $phone = trim($_POST['phone']); //test_input($_POST['phone']);
			   if(!preg_match_all("/^\+[0-9]+$/",$phone)){                 //ctype_digit ( $text );				   
				   $Phone_err = " your phone number is not valid" ;
				   $flag = 0;		   
			   }else{			   
			    if(strlen($phone)==14){				   
				 $phone = $phone ;			   
			   }else {				
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
			$sq ="update  users  set First_name = '$firstname',
			                          Last_name = '$lastname',
									  Phone = '$phone',
									  Email = '$email',
									  City ='$city'
					where User_id= $userid ";
			$res = mysqli_query($connect,$sq);
			if($res){
				echo "Update successfully";			
			} else{
			   echo	mysqli_error($connect);
			}	           
	     }else{
		       echo "please fill all the field crrectly"."<br>";
	       }
		   
	   } 
	   
	  function test_input($input_data){
		  
		  $data = trim($input_data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data ;
	   }
	   
	   $sql = "select * from users where User_id= '$userid' " ;
	    if(!$result = mysqli_query($connect,$sql)){	 
		 echo mysqli_error($connect);	 
        }
	   
  ?>
  
  <!DOCTYPE HTML>
  <html lang="en-US">
  <head>
  	<meta charset="UTF-8">
  	<title></title>
	<style type="text/css">
	.content{
		margin-top:50px;
		marging-left:20px;
		padding:5px;
	}
	.content table{
		border:1px;
		width:40%;
		padding:5px;
	}
	</style>
  </head>
  <body onload="change()"> 
        <div id="">
		   <?php include "headnav.php" ;?>
		</div>
		
        <div id="" class ="content">
				<form action="" method="post">
				 <table >
					 <?php while($row=mysqli_fetch_array($result)): ?>
							  <tr>
								  <td>First Name</td>
								  <td><input type="text" name="firstname" value="<?php echo $row['First_name'];?>" /></td>
							  </tr>
							  <tr>
								  <td>Last Name</td>
								  <td><input type="text" name="lastname" value="<?php echo $row['Last_name'];?>" /></td>
							  </tr>
							  <tr>
								  <td>Phone</td>
								  <td><input type="text" name="phone" value="<?php echo $row['Phone'];?>" /></td>
							  </tr>
							  <tr>
							  <td>Email</td>
							  <td><input type="text" name="email" value="<?php echo $row['Email'];?>" /></td>
							  </tr>
							  <tr>
							  <td>City</td>
							  <td><input type="text" name="city" value="<?php echo $row['City'];?>" /></td>
							  </tr>
					<?php endwhile; ?>
				 </table>
				    <input type="submit" name="update" value="Update" />
				 </form>
		 </div>
		 
         <div class="">    		 
		    
			<div>
			  
			</div>
		 </div>
		 
<script type="text/javascript">
  function change(){
     var  val= document.getElementById("headnav").children;
      for(var i=0;i<val.length;i++){
	      val[i].removeAttribute("class");
      }   
      val[3].setAttribute("class","active");
   }
   
</script>		 
  </body>
  </html>
