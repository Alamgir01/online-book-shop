<?php
    session_start();
	include "connection.php";
	if(!isset($_SESSION['email']) and !isset($_SESSION['user_id'])){
		echo "you must log in ";
		exit();
	}
	
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT orders.order_id , books.Book_title , order_item.quantity,order_item.price,orders.order_date  
            from orders  join order_item on orders.order_id = order_item.order_id  
			JOIN books on books.Book_id = order_item.book_id WHERE orders.user_id = $user_id  ";
	$result= mysqli_query($connect,$sql);
     if(!$result){
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
		padding:5px;
	}
	.content {
			width:100%; 
			margin-top:50px; 
			background-color:#169c7b;
		}
		.content td{
			padding:5px;
			color:black;
			text-align:center;
		}
		.content th{
			font-size:20px;
			font-weight:bold;
		}
	</style>
</head>
<body onload="change()">
    <div id=""> <?php include "headnav.php";?></div>
	<hr />
    <div id="">
	
       <table  class="content" border="0" style="width:100%;">
	       <tr>
		   <th>Order Id </th>
		   <th>Book_title</th>
		   <th>quantity</th>
		   <th>price</th>
		   <th>Order Date</th>
		   
		   </tr>
					  <?php  while($row=mysqli_fetch_assoc($result)){ ?>
						<tr>
						 <td><?php echo $row['order_id']." "; ?></td>  
						  <td><?php echo $row['Book_title']." "; ?></td>  
						  <td><?php echo $row['quantity']." "; ?></td> 
						  <td><?php echo $row['price']." "; ?></td>  
						  <td><?php echo $row['order_date']." "; ?></td>  
						</tr>
					<?php   }
					   ?>
	    </table>
	</div>
<script type="text/javascript">
      function change(){
        var  val= document.getElementById("headnav").children;
             for(var i=0 ; i<val.length;i++){
	            val[i].removeAttribute("class");
            }   
        val[6].setAttribute("class","active");
     }
</script>	
</body>
</html>