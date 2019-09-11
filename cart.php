<?php
    session_start();		
	  	if(isset($_POST['bookid'])){
		$bookid = $_POST['bookid'];
	}
	if(isset($bookid)){		
		if(!isset($_SESSION['cart'])){			
			$_SESSION['cart'] = array();
			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$bookid])){
			$_SESSION['cart'][$bookid] = 1;
	    }elseif(isset($_SESSION['cart'][$bookid])){			   
			   $_SESSION['cart'][$bookid]++;
		}
	}
   

   
   function total_items($cart){
		$items = 0;
		if(is_array($cart)){
			foreach($cart as $bookid=> $qty){
				$items += $qty;
			}
		}
		return $items;
	}

	
	function total_price($cart){
		$price = 0.0;
		if(is_array($cart)){
		  foreach($cart as $bookid => $qty){				
		  		$bookprice =getbookprice($bookid) ;				
		  if($bookprice){
		  	 $price += ($bookprice * $qty);
		  }		  		
		}		  		 
	  } 
	  return $price;
	}	
	
	function show_books($bookid){
	   include "connection.php";
	   $sql = "select Book_title , price  from books where Book_id = '$bookid'";	   
	   $result = mysqli_query($connect,$sql);	   
       if(!$result){	   
	     echo mysqli_error($connect);
         exit() ;	   
	   }   
     return $result ;
   }
   
   function  getbookprice($bookid){									
	  include "connection.php" ;
	  $sql = "select  price  from books where Book_id = '$bookid'";	   
	  $result = mysqli_query($connect,$sql);	   
        if(!$result){	   
	        echo mysqli_error($connect);
            exit() ;	   
        }   
       $row = mysqli_fetch_assoc($result);
	   return $row['price'];
  }
  
  
    if(isset($_POST['save_change'])){
	         if(isset($_POST['check'])){
				foreach($_POST['check'] as $check){
					unset($_SESSION['cart'][$check]);
				}
			}
		    foreach($_SESSION['cart'] as $bookid =>$qty){  
			   if($_POST[$bookid] == '' or $_POST[$bookid] =='0'){
				unset($_SESSION['cart'][$bookid]);
			   }else{
				$_SESSION['cart'][$bookid] = $_POST[$bookid];
			}
		   }
	}
?>

 <?php 
   
   if(isset($_SESSION['cart'])){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style type="text/css">
	
	.table td{
		text-align:center;
		background-color:#169c7b;
		color:white;
	}
	#cart{
		margin-top:60px;
		margin-left:20px;
		margin-right:20px;
		margin-bottom:15px;
		width:50%;
		float:left;
	}
	#cart input[type=text]{
      padding:2px;
	  width:35px;
	}
	#cart input[type=submit]{
	  margin-top:25px;	
      padding:10px;
	  width:20%;
	  background-color:rgb(233,111,150);
	}
	#ccs{
		margin-top:50px;
		margin-left:20px;
		clear:both;
	}
    #ccs a{
		text-align:left;
		padding:15px;
		margin:1px;
		width:10%;
		background-color:pink;
		color:white;
		text-decoration: none;
	}
	
	.register{
		margin-top:60px;
		margin-left:20px;
		margin-right:20px;
		margin-bottom:15px;
		float:right;
		width:30%;
		border:1px solid red;
	}
	.register input[type=text], input[type=submit] {
	  padding:5px;
	  margin:10px;
      width:50%;	  
	  }
	  
	  #cart{
		  
	  }
	  
	</style>
</head>
<body style="background-color:#accb;" onload="change()">
    <div id=""class="head"><?php include "headnav.php";?></div>
	    <hr />
	
    <div id="cart">
		<form action="cart.php" method="post">		
					<table class="table" border='1' width="100%">
						<tr>
							<th>Item</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Delete</th>
						</tr>
						<?php
							foreach($_SESSION['cart'] as $books => $qty){					
								$book = mysqli_fetch_assoc(show_books($books));
						?>
						<tr>
							<td><?php echo $book['Book_title']."    "; ?></td>
							<td><?php echo "TK  " . $book['price']."     "; ?></td>
							<td><input type="text" value="<?php echo $qty; ?>"   name="<?php echo $books; ?>"></td>
							<td><?php echo "TK  " . $qty * $book['price']; ?></td>
							<td><input type="checkbox" name="check[]" value ="<?php echo $books; ?>"/></td>
						</tr>
						<?php } ?>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th><?php echo $_SESSION['total_items']; ?></th>
							<th><?php echo "TK " . $_SESSION['total_price']; ?></th>
						</tr>
					</table>
		      <input type="submit"  name="save_change" value="Save Changes">
	    </form>
	</div>
	 
	
	<div id="ccs">
			<a href="checkout.php" >Go To Checkout</a> 
			<a href="book.php?allbook=true" >Continue Shopping</a>	
             <?php }else {echo "No product info";}?>
   </div>
<script type="text/javascript">
  function change(){
     var  val= document.getElementById("headnav").children;
      for(var i=0;i<val.length;i++){
	      val[i].removeAttribute("class");
     }   
      val[5].setAttribute("class","active");
   }
</script>
</body>
</html>
   