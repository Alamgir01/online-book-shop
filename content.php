<?php
     session_start() ;
    include "connection.php";
	
	if(isset( $_REQUEST['bookid'])){
		    $bookid = $_REQUEST['bookid'];
			
			$sql = "SELECT books.Book_id as id,books.Book_title as Title,
                      authors.Name as Author,publishers.Name as publisher,
	                  category.Name as category,books.price as price,
	                  books.img_name as img  

                     FROM books JOIN authors on books.Author_id = authors.Author_id 
                     JOIN publishers on books.Publisher_id = publishers.Publisher_id  
                     JOIN   category  on books.Category_id = category.Category_id
                     where books.Book_id = '$bookid' ;";
					 
			 if(!$result = mysqli_query($connect,$sql)){
				 echo mysqli_error($connect);
			 }else{				 
				 $count=mysqli_num_rows($result);
			 }
		}else{			
			echo "something wrong in the URL";
			exit();
		}
?>

<?php		
        if(isset($_REQUEST['add'])){			
			if(isset($_SESSION['email'])){
                $user_id =  $_SESSION['user_id'] ;
                $comment = trim($_REQUEST['comments']);
                if(!empty($comment)){
                     insert_comment($user_id,$bookid,$comment,$connect);
				}				
			}else{
			    $Err_message="You must login \n";			
		     }
		}
		   
				$sql3 = "SELECT concat(users.First_name ,\" \", users.Last_name) as Name , review.comments as comment 
                         FROM users JOIN review on users.User_id = review.user_id  where review.book_id = '$bookid' order by comment_id desc limit 6 ";
						 
				$result3=mysqli_query($connect,$sql3);
               				
				if(!$result3){					
					echo "some thing wrong ". mysqli_error($connect);
                }else{
                       $count1 =  mysqli_num_rows($result3);
				}				
?>

<?php 
function insert_comment($user_id,$book_id,$comment,$connect){
	$sql2="INSERT into review VALUES ('','$user_id','$book_id','$comment')";
	$result2=mysqli_query($connect,$sql2);
	if(!$result2){
		echo "Error :".mysqli_error($connect);
	}
}
   
?>




<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style type="text/css">
	#p-details{
	     color:#000000;
		 font-size:17px;	
	}
	#p-details  p{
		color:black;
		background-color:#20B2AA;
		font-weight:bold;
		text-align:center;
		font-size:25px;
	}
	#p-details td p{
	     color:black;
		 font-size:17px;
		 text-align:left;
		 padding:15px;
		 margin:5px;
         position:relative;
         left:100px;	 
	}
	
	#p-details td {
	     color:#000000;
		 font-size:17px;
		 text-align:center;
		 padding:15px;
		 margin:5px;
         position:relative;
         left:300px;		 
	}
	#p-details img{
		height:300px;
		width:200px;
	}
	#addtocart{
		padding:10px;
		margin-top:30px;
		
	}
	#addtocart  input[type=submit]{
		width:15%;
		padding:15px;
		color:green;
        position:relative;
		left:305px;
		background-color:orange;
	}
	#review input[type=submit]{
		width:15%;
		padding:10px;
		margin:15px;
		color:orange;
		background-color:green;
	}
	#review{
		margin-top:50px;
		padding:0px;
	}
	#review p{
		margin-top:50px;
		padding:10px;
		background-color:#20B2AA;
		font-weight:bold;
		font-size:20px;
	}
	#textarea{
		width:40%;
		background-color:#F0FFFF;
	}
	#comment h3{
		margin-top:15px;
		margin-left:20px;
		color:DarkBlue;
	}
	#comment p{
		width:40%;
		padding:5px;
		color:#2E8B57;
	}
	
	</style>
</head>
<body style="background-color:#accb;">
	    <div id="" style="">
		     <?php include "headnav.php"; ?>
		</div>
     
	    <div id="p-details" style="">
		     <p>Details of the product</p> <hr />
             <table style="">
			 <?php 
			 if($count==1){
				 while($row = mysqli_fetch_array($result)){ ?>						   
						    <tr>
							<td><img src="img/<?php echo $row['img'];?>" alt="" /></td>			   
							
							<td>
							 <p> <?php echo "Title: ".$row['Title']."<br />";?> </p>
							 <p> <?php echo "Author: ".$row['Author']."<br />";?> </p>
							 <p> <?php echo "Publisher: ".$row['publisher']."<br />";?> </p>
							 <p> <?php echo "Category: ".$row['category']."<br />";?> </p>
							 <p> <?php echo "Price: ".$row['price']." Tk"."<br />";?>	</p>
                            </td>
							</tr>						  
			 <?php }
			      } 
				   mysqli_free_result($result);			       
	   	     ?>
			 </table>
		 </div>		 
				  
		      <div id="addtocart" >  
			                  <form action="cart.php" method ="post">
			                     <input type="hidden" name="bookid" value="<?php echo $bookid;?>">
			                     <input type="submit"value="Add to Cart" name = "submit" />
			                  </form>						   
			 </div>
			  
			              
						  
		    <div id="review"> 
                  		  
                  <p> User Review: </p><hr />
                  <?php  if(isset($_REQUEST['add'])){			
			                     if(!isset($_SESSION['email'])){
                                     echo $Err_message ;				
			                     }							   
						   } 
				 ?>	
				   <form action="content.php">
			             <textarea name="comments" id="textarea" cols="30" rows="3"></textarea>
						 <input type="hidden" name="bookid" value="<?php echo $bookid;?>"> <br />
						 <input type="submit" value="Add" name = "add"/>
				   </form>				 
			 </div>
			 <div id="comment">
						 <?php				 	
							  if(mysqli_num_rows($result3)>=1){					      
								   while($row1 = mysqli_fetch_array($result3)){ ?>								   
									   <h3><?php echo  $row1['Name']; ?></h3>
									   <p><?php echo  $row1['comment']; ?></p>
									   <br />
							<?php	   }					        
							  }					   
						 ?> 					  
                </div>	
		
</body>
</html>
		    
                 
				 
				