<?php 
     session_start();
	 include "connection.php";
	 if(isset($_REQUEST['search'])){
		  if($_REQUEST['search'] !=''){
			   $search = $_REQUEST['search'];
			   $_SESSION['src'] = $search ;
			   $_SESSION['val']=0;
			   $sql = "SELECT books.Book_id as id,books.Book_title as Title,
						  authors.Name as Author,publishers.Name as publisher,
						  category.Name as category,books.price as price,
						  books.img_name as img  

						 FROM books JOIN authors on books.Author_id = authors.Author_id 
						 JOIN publishers on books.Publisher_id = publishers.Publisher_id  
						 JOIN   category  on books.Category_id = category.Category_id
						 where books.Book_title like'%$search%' or authors.Name like '%$search%' ";
						 
				 if(!$result = mysqli_query($connect,$sql)){
					 echo "Error ". mysqli_error($connect); 
				 }
				
          }else{
		     echo "write title of any books  in the search box";
               exit();			 
	      }			 
      }

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style type="text/css">
	.search{	 
		 color:#000000;
		 text-align:center;
		 font-size:17px;
	 }
	</style>
</head>
<body style="background-color:#accb;">
		<div><?php include "headnav.php";?></div>
                 <div id="content">		
					<div id=""class="search">				
								<table style="width:100% ; padding:10px; margin:20px 20px 15px 20px;">
								<?php $count=0;
								    if(mysqli_num_rows($result)<1){
										echo "result not found";
									}else{
										echo "Result ".mysqli_num_rows($result);
									}
										for($i=0;$i<mysqli_num_rows($result);$i++){
										   	echo "<tr>";
										    while($row = mysqli_fetch_assoc($result)){ ?>
													<td>           			
													<a href="content.php?bookid=<?php echo $row['id'] ;?>" class="a"><img src="img/<?php echo $row['img'];?>" alt="" /></a>                         							   						   						 
													<p><?php echo " ".$row['Title'];?> </p>
													<p>  <?php echo "Price: ".$row['price']."Tk";?></p>
													 <?php $count=$count+1;
														 if($count==3){
															 $count = 0;
															 break;
														 } 				 
													 ?>
													</td> 
															  
									<?php  } echo "</tr>";
									} mysqli_free_result($result);
									  mysqli_close($connect);				   
									?>
								  </table>
								 
							</div>	
				 </div>
</body>
</html>