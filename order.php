<?php  
     session_start();
	 include "connection.php";
	
	 if(isset($_POST['confirm'])){
        if(!empty($_SESSION['cart'])){
			
			if(isset($_SESSION['email'])){
				$last_id = insert_order($connect);
		        insert_items($connect,$last_id);
				insert_Guser($connect,$last_id);
			}else{
				$last_id = insert_order($connect);
		        insert_items($connect,$last_id);
				insert_Guser($connect,$last_id);
			}
			unset($_SESSION['cart']);		 
			unset($_SESSION['total_price']);		 
			unset($_SESSION['total_items']);
			
            $_SESSION['message']="Order place successfully";
            header("Location:home.php");			
	    }else{
			echo "you have no access to this page ";
			exit();
		}
	 }else{
		 exit();
	 }
	 
	 
	 function insert_items($connect,$id){
		 $sql = "insert into order_item(order_id ,book_id,quantity ,price) values(?,?,?,?)";
		        if($stmt=mysqli_prepare($connect,$sql)){
					 mysqli_stmt_bind_param($stmt,"isid",$order_id,$book_id,$quantity,$price);
					 
					 foreach($_SESSION['cart'] as $books => $qty){						 
							 $book = mysqli_fetch_assoc(show_books($books,$connect));
							 $order_id = $id;
							 $book_id = $books;
							 $quantity = $qty;
							 $price = $book['price'];
							$res= mysqli_stmt_execute($stmt); 
					 } 
					  if(!$res){
						echo "ERROR: Could not prepare query: $sql. " . mysqli_error($connect);
						exit();
					  } 		 
	            }
	}
	function insert_Guser($connect,$id){
	   $Name_err  = $Phone_err = $Email_err = $Address_err =  $City_err =  $District = $Division = "";
	   echo $id ;
	   $name=$_POST['uname'];  $phone = $_POST['phone']; $email =$_POST['email'];  $address = $_POST['address'];
	   $city=$_POST['city']; $district =$_POST['district']; $division =$_POST['division'];
	   $sql = "insert into g_user values('','$name','$phone','$email','$address','$city','$district','$division','$id')";
	   $res = mysqli_query($connect,$sql);
       if(!$res){
		   echo mysqli_error($connect);
		   echo mysqli_errno($connect);
		   exit;
	   }	   
	} 
	 
	 
	function insert_order($connect){
		$sql = "insert into orders(user_id,order_date,total_qnt,total_price) values(?,?,?,?)";
				 if($stmt=mysqli_prepare($connect,$sql)){
					 mysqli_stmt_bind_param($stmt,"isid",$user_id,$order_date,$quantity,$price);
					 
					 if(isset($_SESSION['email'])){
						 $user_id=$_SESSION['user_id'];
						 $order_date=date("Y/m/d");
						 $quantity = $_SESSION['total_items'];
						 $price = $_SESSION['total_price'];
					 }else{
						// $user_id=null ;
						 $order_date=date("Y/m/d");
						 $quantity = $_SESSION['total_items'];
						 $price = $_SESSION['total_price']; 
					 }
					   $res = mysqli_stmt_execute($stmt);
					    $last_id = mysqli_insert_id($connect);
					  if(!$res){
						  
						   echo "ERROR".mysqli_error($stmt);
					  }  
				  }else{
					 echo "ERROR: Could not prepare query: $sql. " . mysqli_error($connect);
				 }
				 
				 return $last_id ;
	}

     function show_books($bookid,$connect){	  
	   $sql = "select price  from books where Book_id = '$bookid'";	   
	   $result = mysqli_query($connect,$sql);	   
       if(!$result){	   
	     echo mysqli_error($connect);
         exit() ;	   
	   }   
     return $result ;
   }
?> 