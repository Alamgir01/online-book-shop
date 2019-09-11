<?php
      
	  include "connection.php";
	  
	  $sub_category_id = $category_id = $sub_category_name ="";
	  $sub_category_id_Error = $sub_category_name_Error = $category_id_Error = "" ;
	  $Flag = 1 ;
	  
	  if(isset($_POST['submit'])){		  
		if(empty($_POST['sub_category_id'])){
			$sub_category_id_Error = "please enter sub-category id";
			$Flag= 0;
		}  
		if(empty($_POST['category_id'])){
			$category_id_Error = "please enter category id";
			$Flag = 0;
		}
        if(empty($_POST['sub_category_name'])){
			$sub_category_name_Error = "please enter sub-category name";
			$Flag = 0 ;			
		}
		if($Flag == 1){
		  $sub_category_id  = $_POST['sub_category_id'];
		  $category_id  = $_POST['category_id'];
		  $sub_category_name = $_POST['sub_category_name'];
		  
		  $sql ="insert into  sub_category  values('$sub_category_id','$category_id','$sub_category_name')";
		  
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
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>"  method="post">	
	    Sub-category Id   <input type="text" name ="sub_category_id" value ="" /> <?php echo $sub_category_id_Error; ?>  <br />
	    Category Id       <input type="text" name ="category_id" value ="" />  <?php echo $category_id_Error ; ?>  <br />
	    Sub-category Name  <input type="text" name ="sub_category_name" />  <?php echo $sub_category_name_Error; ?>  <br />	 
	<input type="submit" name ="submit" value ="Submit" />	
	</form>
	</div>
	
	
	<div align= "center">
	  <table border='1'>	   
	   <th>Sub_category_id</th>
	   <th>category_id</th>
	   <th>Name</th>
	   <?php 	   
	   $sql2= "select * from sub_category";	   
	   if($result2 = mysqli_query($connect,$sql2)){		   
		   while($row = mysqli_fetch_array($result2)){ 		   
		 ?>  
			 <tr> 
			  <td> <?php echo $row['Sub_category_id'] ;?></td>
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