<?php
    include "connection.php";
    $sql1 = "select Name from category";
	$result1 = mysqli_query($connect,$sql1);
	if(!$result1){		
		echo mysqli_error($connect);
	}
?>


<!DOCTYPE HTML>
<html lang="en-US">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<meta charset="UTF-8">
	<title></title>
	
	<link rel="stylesheet" href="css/modal.css" />
	<script type="text/javascript" src="jquery/jquery-3.3.1.js"></script>
	<link rel="stylesheet" href="css/headnav.css" />
	
	<script type="text/javascript">
	  $(document).ready(function(){
	    $("#headnav a:nth-child(4)").click(function(){
		   $("#modal-login").slideDown("slow");
 		});
		$(".cancelbtn").click(function(){
		   $(".modal").css("display","none");
		});
		$("#headnav a:nth-child(5)").click(function(){
		    $("#modal-register").slideDown("slow");
		});
		$("#category p").click(function(){
		   $( "#categorylist").slideToggle("slow");
		});
	  });
	</script>
	
	
</head>
<body>
<?php   
  if(!isset($_SESSION['email'])):?>
	<div id="header" class="">
	        <div id="headsubnav">
				
					<div id="category">
						 <div><p>Category Menu</p></div>
						  <div id="search">
								<form action="search.php"> 
								<input type="search" name="search" placeholder="serarch" required />
								<input type="submit" value="Search" />
								</form>
						 </div>								 
					</div>
					 <div id="categorylist">
							<ul>
								<?php 
									while($row = mysqli_fetch_array($result1)){?>     
											  <li class ='list'><a href="<?php echo $row["Name"];?>.php?cat=<?php echo $row["Name"];?>"><?php echo $row["Name"];?></a></li>
								<?php }	
									 mysqli_free_result($result1);
								?>		
							</ul>
					 </div>	                    					 
			</div>

			
			  <div id="headnav">
					   <a  href="home.php">Home</a>
					   <a href="book.php?allbook=true">All Books</a>
					   <a href="publisher.php?pub=true">Publisher</a>
					   <a href="#">LogIn</a>
					   <a href="#">Register</a>
					   <a href="cart.php">Cart</a>	
										   					  
			   </div>
			   
			   <div id="modal-register" class="modal">
							<form class="modal-content" action="register.php" method="post">
								<div class="container">  
								  <label for="fname">First Name</label>
								  <input type="text" placeholder="Enter First name"  name="firstname"  required />
								  <label for="lname">Last Name</label>
								  <input type="text" placeholder="Enter Last name" name="lastname" required />
								  <label for="pass">Password</label>
								  <input type="password" placeholder="Enter password" name="password" required />
								  <label for="phon">Phone</label>
								  <input type="text" placeholder="Enter phone number ex:+88" name="phone" required />
								  <label for="email">Email</label>
								  <input type="text" name="email" placeholder="Enter email" required />
								  <label for="addr">Address</label>
								  <input type="text" name="city" required placeholder="Enter city" />
								  <input type="submit" value ="Register" name="register" />
								 </div>
                                  <div class="container" style="background-color:#f1f1f1">
									  <button type="button" class="cancelbtn">Cancel</button>
								 </div>									 
							 </form>
				</div> 
				
			   <div id="modal-login" class="modal">
							 <form  class="modal-content" action="login.php" method="post">
							    <div class="container">
								   <label for="uname"><b>Email</b></label>
								   <input type="text" placeholder="Enter Email" name="email" required>
								   <label for="psw"><b>Password</b></label>
								   <input type="password" placeholder="Enter Password" name="password" required>				
								   <button type="submit" name="login">Login</button>
								 </div>
                                  <div class="container" style="background-color:#f1f1f1">
									  <button type="button" class="cancelbtn">Cancel</button>
									  <span class="psw">Forgot <a href="#">password?</a></span>
								 </div>								 
							 </form>						       
				</div>			 		         
	</div>
	
<?php  elseif(isset($_SESSION['email'])): ?>

       <div id="header" class="">
	   
	            <div id="headsubnav">
					 <div id="category">
							<p>Category Menu</p>
						  <div id="search">
								<form action="search.php"> 
								<input type="search" / name="search">
								<input type="submit" value="Search" />
								</form>
						 </div>	   						
					 </div>					 
			    </div>
				
			   <div id="headnav">
					   <a href="home.php">Home</a>
					   <a href="book.php?allbook=true">All Books</a>
					   <a href="publisher.php?pub=true">Publisher</a>
					   <a href="profile.php">Profile</a>
					   <a href="logout.php">Logout</a>
					   <a href="cart.php">Cart</a>
					   <a href="show_order.php">Order History</a>
			    </div>

			 
			 
			  <div id="categorylist">
						<ul>							
							<?php 
								while($row = mysqli_fetch_array($result1)){?>     
										  <li class ='list'><a href="<?php echo $row["Name"];?>.php?cat=<?php echo $row["Name"];?>"><?php echo $row["Name"];?></a></li>
							<?php }	
								 mysqli_free_result($result1);
							?>		
						</ul>	
			  </div>		         
	</div>
	
<?php if(isset($_SESSION['email'])){
	   echo " Hello   ".$_SESSION['email'] ." <br /> <hr /> " ;
	}	 endif ;
?>

</body>
</html>