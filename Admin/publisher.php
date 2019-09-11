<?php
      include "connection.php";	  
	  $id = $publisher_name = $publisher_url="";
      $id_Error = $publisher_name_Error = "";
      $Flag = 1 ;
	  
	 if(isset($_POST['submit'])){		
      if(empty($_POST['publisher_id'])){
		  $id_Error ="plese enter the publisher id";
		  $Flag= 0;
	  }
      if(empty($_POST['publisher_name'])){
		$publisher_name_Error ="plese enter the publisher name";
        $Flag= 0;				  
	  }
	  
	     if($Flag==1){
		  $id = $_POST['publisher_id'];
		  $publisher_name = $_POST['publisher_name'];
		  $publisher_url = $_POST['publisher_url'];		 		  
		  $sql ="insert into publishers values('$id','$publisher_name','$publisher_url')";		  
		  $result = mysqli_query($connect,$sql);		  
		  if($result){			  
			  echo "Data inserted successfully";
		  }else{
			  echo "error occured";
		  }		  
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
	<form action = "<?php  echo htmlspecialchars($_SERVER['PHP_SELF'] ); ?>" method ="post">	
	Publisher Id  <input type="text" name ="publisher_id" value="" />  <?php echo $id_Error ;?>  <br />
	Publisher Name  <input type="text" name ="publisher_name" value ="" /> <?php echo $publisher_name_Error ;?>  <br />
	publisher URL   <input type="text"  name ="publisher_url" value ="" /> <br />
	<input type="submit" name ="submit" value ="Submit" />
	<input type="reset" value ="Reset" />	
	</form>
	</div>
	
	<div align= "center">	
	  <table border='1'>	   
	   <th>Publisher_id</th>
	   <th>publisher_Name</th>
	   <th>publisher_url</th>
		   
	   <?php 	   
	   $sql2= "select * from publishers";	   
	   if($result2 = mysqli_query($connect,$sql2)){		   
		   while($row = mysqli_fetch_array($result2)){ 		   
		 ?>  
			<tr> 
			  <td> <?php echo $row['Publisher_id'] ;?></td>
			  <td> <?php echo $row['Name'] ; ?></td>
			  <td> <?php echo $row['Url'] ; ?></td>	
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