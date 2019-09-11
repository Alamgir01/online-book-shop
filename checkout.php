<?php
     session_start();
	   if(empty($_SESSION['cart'])){
		   echo "NO product info ";
		   exit();
	   }
	   function show_books($bookid){
	   include "connection.php";
	   $sql = "select Book_title , price  from books where Book_id = '$bookid'";	   
	   $result = mysqli_query($connect,$sql);
       $count = mysqli_num_rows($result);
       if($count==0){
		   header("Location:cart.php");
	   }	   
       if(!$result){	   
	     echo mysqli_error($connect);
         exit() ;	   
	   }   
     return $result ;
   }
   
?>
		 <!DOCTYPE HTML>
		 <html lang="en-US">
		 <head>
		 	<meta charset="UTF-8">
		 	<title></title>
					 <style type="text/css">
		 body{
			 background-color: #9dd0e1;
		 }
		 #ckoform{
			 color:black;
			 background-color: #7eaacd;
			 padding:15px;
			 margin-top:50px;
			 margin-left:200px;
			 width:40%;
			 
		 }
		#ckoform input{
			 width:100%;
			 padding:5px;
			 margin:5px;
			 box-sizing: border-box;
		 }
		 
		#ckoform  input[type=submit] {
			background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
		.table {
			width:100%; 
			margin-top:50px; 
			background-color:#169c7b;
		}
		.table td{
			padding:5px;
			color:white;
			text-align:center;
		}
		.table th{
			font-size:20px;
			font-weight:bold;
		}
 
		 
		 </style>
		
		 </head>
		 <body> 
		 
		 <?php if(isset($_SESSION['email'])):?>
		          <div id=""><?php include "headnav.php"?></div> 
		                <hr />
							<div id="" style="">
								<form action="order.php" method="post">
										<table class="table" border='0'">
												<tr>
													<th>Item</th>
													<th>Price</th>
													<th>Quantity</th>
													<th>Total</th>
												</tr>
												<?php
													if(isset($_SESSION['cart'])){ 
													foreach($_SESSION['cart'] as $books => $qty){					
														$book = mysqli_fetch_assoc(show_books($books));
												?>
												<tr>
													<td><?php echo $book['Book_title']."    "; ?></td>
													<td><?php echo "TK  " . $book['price']."     "; ?></td>
													<td><?php echo $qty; ?></td>
													<td><?php echo "TK  " . $qty * $book['price']; ?></td>
												</tr>
												  <?php }  ?>	
												<tr>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													<th><?php echo $_SESSION['total_items']; ?></th>
													<th><?php echo "TK " . $_SESSION['total_price']; ?></th>
													</tr><?php  }else echo "<h3>No product info.</h3>";?>
										</table>
										
								</form>
							 </div>
							 
							 <div id="ckoform" class="content" style="">
									<form action="order.php" method="post" name ="RegForm"  onsubmit="return validate()">
													<label for="name">Name:</label><input type="text" name="uname" placeholder="" required  />										
													<label for="phone">phone:</label> <input type="text" name="phone" placeholder="" required  />
													<label for="email">email:</label> <input type="text" name="email" placeholder="" required  /> 
													<label for="address">Address:</label> <input type="text" name="address" placeholder="" required  />
													<label for="city">city: </label><input type="text" name="city" placeholder="" required  /> 
													<label for="district">District: </label><input type="text" name="district" placeholder="" required  /> 
													<label for="division">Division:</label> <input type="text" name="division" placeholder="" required  /> 
													<input type="submit" name="confirm" value="confirm Order" />
									</form>
					         </div>
							 <!-- <div id="payment"  style="float:right">
									<p>Please select your payment method</p>
										 <form action="">
												<select name="" id="">
													<option value="">-----</option>
													<option value="">cradit cart</option>
													<option value="">mobile Banking</option>
													<option value="">cash on delivery</option>
												</select>
										 </form>
							 </div> -->
					 
	   <?php else: ?>
					  <div id=""><?php include "headnav.php"?></div>
					   <div id=""  style="">
									<form action="">
											<table class="table" border='0' >
													<tr>
														<th>Item</th>
														<th>Price</th>
														<th>Quantity</th>
														<th>Total</th>
													</tr>
													<?php
													  if(isset($_SESSION['cart'])){
														foreach($_SESSION['cart'] as $books => $qty){					
															$book = mysqli_fetch_assoc(show_books($books));
													?>
													<tr>
														<td><?php echo $book['Book_title']."    "; ?></td>
														<td><?php echo "TK  " . $book['price']."     "; ?></td>
														<td><?php echo $qty; ?></td>
														<td><?php echo "TK  " . $qty * $book['price']; ?></td>
													</tr>
													  <?php }  ?>
													<tr>
														<th>&nbsp;</th>
														<th>&nbsp;</th>
														<th><?php echo $_SESSION['total_items']; ?></th>
														<th><?php echo "TK " . $_SESSION['total_price']; ?></th>
													  </tr> <?php }else echo "<h3>No product info.</h3>";?>
											</table>
									</form>
							 </div>
							 
							 
							 <!--<div id="payment"  style="float:right">
									<p>Please select your payment method</p>
										 <form action="">
											<select name="" id="">
												<option value="">-----</option>
												<option value="">cradit cart</option>
												<option value="">mobile Banking</option>
												<option value="">cash on delivery</option>
											</select>
										 </form>
							 </div>-->
							 
							 
					<div id="ckoform" class="content" style="">
							<form action="order.php" method="post" name="RegForm" onsubmit="return validate()">
											<label for="name">Name:</label><input type="text" name="uname" placeholder="" required  />										
											<label for="phone">phone:</label> <input type="text" name="phone" placeholder="" required  />
											<label for="email">email:</label> <input type="text" name="email" placeholder="" required  /> 
											<label for="address">Address:</label> <input type="text" name="address" placeholder="" required  />
											<label for="city">city: </label><input type="text" name="city" placeholder="" required  /> 
											<label for="district">District: </label><input type="text" name="district" placeholder="" required  /> 
											<label for="division">Division:</label> <input type="text" name="division" placeholder="" required  /> 
											<input type="submit" name="confirm" value="confirm Order" />
							</form>
					</div>
		 </body>

 <script type="text/javascript">
 function validate()                                    
{ 
    var name = document.forms["RegForm"]["uname"];               
    var email = document.forms["RegForm"]["email"];    
    var phone = document.forms["RegForm"]["phone"];  
    var address = document.forms["RegForm"]["address"];  
    var city = document.forms["RegForm"]["city"];  
    var district = document.forms["RegForm"]["district"];  
    var division = document.forms["RegForm"]["division"];  
   
    if (!/^[a-zA-Z ]+$/.test(name.value))                                  
    { 
        window.alert("Please enter your name."); 
        name.focus(); 
        return false; 
    } 
   
    if (!/^[a-zA-Z ]+$/.test(address.value))                               
    { 
        window.alert("Please enter your address."); 
        name.focus(); 
        return false; 
    } 
       
    if (!/^\S+@\S+\.\S+$/.test(email.value))                                   
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
        return false; 
    } 
   
   
    if (!/^[1-9]\d{9}$/.test(phone.value))                           
    { 
        window.alert("Please enter your phone number."); 
        phone.focus(); 
        return false; 
    } 
   

    return true; 
}
</script>
</html>

<?php endif;?>