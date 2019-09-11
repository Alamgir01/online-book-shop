<?php
      include "connection.php";
	  $Id_Error = $Author_Name_Error = "";
	  $id = $author_name = "";
	  $Flag = 1 ;
	  
	  if(isset($_POST['submit'])){
		  if(empty($_POST['author_id'])){
			   $Id_Error ="plese enter Author id ";
			   $Flag =0 ;
		  }
		  if(empty($_POST['author_name'])){
			  $Author_Name_Error ="plese enter the Author Name";
			  $Flag =0 ;
		  }
		  
		  if($Flag==1){
		  $id = $_POST['author_id'];
		  $author_name = $_POST['author_name'];
		  
		  
		  $sql ="insert into authors values('$id','$author_name')";
		  
		  $result = mysqli_query($connect,$sql);
		  
		  if($result){			  
			  echo "data inserted successfully";
		  }
		}
	  }
	  
	  if(isset($_POST['update'])){
		  
		 $sql = "update authors set Name=? where Author_id =?";
		 if(isset($_POST['check'])){
		 if($stmt = mysqli_prepare($connect, $sql)){
			  mysqli_stmt_bind_param($stmt, "si",$name,$id);
			  foreach($_POST['check'] as $value){
				  $name = $_POST['Aname'];
				  $id=$_POST['Aid'];
				  mysqli_stmt_execute($stmt);
			  }
		 }else{
			 echo "error 1";
		 }
		}else{
			echo "error 2";
		}
	  }
	  if(isset($_POST['delete'])){
	  }
?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

<div>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method ="post">
	Author Id <input type="text" name ="author_id" value="" /> <?php echo $Id_Error ;?> <br />
	Author Name <input type="text" name ="author_name" value="" />  <?php echo $Author_Name_Error ;?>  <br />
	
	
	<input type="submit" name ="submit" value ="Submit" />
	</form>
</div>	

<div align= "center">
	 <form action="author.php" method="post">
	  <table border='1' >
	   
	   <th>Author_id</th>
	   <th>Author_Name</th>
	   <th>Action</th>
	   <?php 
	   
	   $sql2= "select * from authors";
	   
	   if($result2 = mysqli_query($connect,$sql2)){
		   
		   while($row = mysqli_fetch_array($result2)){ 
		   
		 ?>  
			 <tr> 
			  <td> <input type="text" value="<?php echo $row['Author_id'];?>" name="Aid" />  </td>
			  <td> <input type="text" name="Aname" value="<?php echo $row['Name'] ; ?>" /> </td>
			  <td><input type="checkbox" name="check[]" value="<?php echo $row['Author_id'];?>" /></td>			 
			 </tr>  
		<?php	   
		   }
		   
	   }else {
		   echo mysqli_error($connect);
	   }
	   
	   ?>
	   
	</table>
	   <input type="submit" value="Update" name="update" /> 
	   <input type="submit" value="Delete" name = "delete"/>
	</form>
	</div>

</body>
</html>