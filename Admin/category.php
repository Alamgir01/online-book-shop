<?php
      include "connection.php";
	  
	  $id = $name ="";
	  $id_Error = $name_Error = "";
	  $Flag = 1;
	  
	  if(isset($_POST['submit'])){

        if(empty($_POST['category_id'])){
			$id_Error = "please enter category id";
			$Flag = 0;
		}
        if(empty($_POST['category_name'])){
			$name_Error = "please enter category name";
			$Flag = 0 ;			
		}
		
        if($Flag==1){	
		  $id = $_POST['category_id'];
		  $name = $_POST['category_name'];		  
		  $sql ="insert into  category  values('$id','$name')";		  
		  $result = mysqli_query($connect,$sql);		  
		  if($result){			  
			  echo "data inserted successfully";
		  }else{
			  echo mysqli_error($connect);
		  } 	  		  
		  mysqli_free_result($result);
	   }
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
	<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']) ;?>" method ="post">
	Category Id  <input type="text" name ="category_id" value="" /> <?php echo $id_Error ; ?>  <br />
	Category Name  <input type="text" name ="category_name" /> <?php echo $name_Error ; ?>   <br />
	
	<input type="submit" name ="submit" value ="Submit" />

	</form>
	</div> 
	
		
	<div align= "center">
	
	  <table border='1'>
	   
	   <th>category_id</th>
	   <th>Name</th>
	   <?php 
	   
	   $sql2= "select * from category";
	   
	   if($result2 = mysqli_query($connect,$sql2)){
		   
		   while($row = mysqli_fetch_array($result2)){ 
		   
		 ?>  
			 <tr> 
			  
			  <td> <?php echo $row['Category_id'] ; ?></td>
			  <td> <?php echo $row['Name'] ; ?></td>
			 <td><input type="submit" value="Update" /> <input type="submit" value="Delect" /></td>
			 </tr>  
		<?php	   
		   }
		   
	   }else {
		   echo mysqli_error($connect);
	   }
	   
	   ?>
	   
	</table>
	
	</div>
</body>
</html>