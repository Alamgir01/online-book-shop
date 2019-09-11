<?php 
     include "connection.php";
	  $book_id_Error = $book_title_Error = $author_id_Error= $publisher_id_Error = $category_id_Error = $price_Error = $img_Error = "";
	  $book_id = $book_title = $author_id = $publisher_id = $category_id = $price= $image_name ="";
	  $Flag = 1 ;
	  if(isset($_POST['submit'])){
		  
		 if(empty($_POST['book_id'])){
			 $book_id_Error  = "please enter book id "; 
			 $Flag =0;
		 } 
		 if(empty($_POST['book_title'])){
			 $book_title_Error  = "please enter book title "; 
			 $Flag =0;
		 }
         if(empty($_POST['author_id'])){
			 $author_id_Error = "please enter Author_id"; 
			 $Flag =0;
		 }
         if(empty($_POST['Publisher_id'])){
			 $publisher_id_Error ="please enter Publisher_id";
			 $Flag = 0;
		 }
		 if(empty($_POST['category_id'])){
			 $category_id_Error ="please enter Category_id";
			 $Flag = 0;
		 }	
		 if(empty($_POST['price'])){
			 $price_Error ="please enter price";
			 $Flag = 0;
		 } 
		 if(empty($_POST['image_name'])){
			 $img_Error ="please enter image name";
			 $Flag = 0;
		 }		
		if($Flag==1){ 
		  $book_id = $_POST['book_id'];
		  $book_title = $_POST['book_title'];
		  $author_id = $_POST['author_id'];
		  $publisher_id = $_POST['publisher_id'];
		  $category_id = $_POST['category_id'];
		  $price  = $_POST['price'];
		  $image_name  = $_POST['image_name'];
		  
		  $sql ="insert into books values
		                  ('$book_id','$book_title','$author_id','$publisher_id','$category_id','$price','$image_name')";
		  
		  $result = mysqli_query($connect,$sql);
		  
		  if($result){
			  
			  echo "Data inserted successfully";
		  }else{
			  echo mysqli_error($connect);
		  }
		  mysqli_free_result($result);
		}  
	  }
?>

<html>

       <head>

                <title>   </title>

       </head>
	   
	   
	   <body>
	        
            <div>			
			 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			 
				Book_id :  <input type="text" name="book_id" value="" /> <?php echo $book_id_Error ;  ?> <br />
				Book_title:  <input type="text" name="book_title" value="" /> <?php echo $book_title_Error ;  ?> <br />
				Author_id:  <input type="text" name ="author_id" value=""  /> <?php echo $author_id_Error ;  ?> <br /> 
				Publisher_id:  <input type="text" name="publisher_id" value="" /> <?php echo $publisher_id_Error ;  ?> <br />
				Category_id:  <input type="text" name="category_id" value="" /> <?php echo $category_id_Error ;  ?> <br />
				price:  <input type="text" name="price" value="" /> <?php echo $price_Error ;  ?> <br />
				image_name:  <input type="text" name="image_name" value="" /> <?php echo $img_Error ;  ?> <br />
				  <input type="submit" name="submit" value="Submit" />
			 
			 </form>
	        </div>
			
	<div align= "center">
	  <table border='1'>	   
	   <th>Book_id</th>
	   <th>Book_title</th>
	   <th>Author_id</th>
	   <th>publisher_id</th>
	   <th>category_id</th>
	   <th>price</th>
	   <th>image</th>
	   
	   <?php 
	   $sql2= "select * from books";	   
	   if($result2 = mysqli_query($connect,$sql2)){		   
		   while($row = mysqli_fetch_array($result2)){ 		   
		 ?>  
			 <tr> 
			  <td> <?php echo $row['Book_id'];?></td>
			  <td> <?php echo $row['Book_title'];?></td>
			  <td> <?php echo $row['Author_id'];?></td>
			  <td> <?php echo $row['Publisher_id'];?></td>
			  <td> <?php echo $row['Category_id'];?></td>
			  <td> <?php echo $row['price'];?></td>
			  <td> <?php echo $row['img_name'];?></td>
			  <td><input type="submit" value="Update" /> <input type="submit" value="Delect" /></td>			 
			 </tr>  
		<?php	   
		   }
		   
	   }else {
		   echo mysqli_error($connect);
	   }
	   mysqli_free_result($result2);
	   ?>	   
	</table>
	
	</div>
	   </body>


</html>