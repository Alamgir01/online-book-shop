<?php 
     session_start();
          // echo "<h1>Home</h1>";
      
?>
<?php
        include "connection.php";
			$sql = "SELECT books.Book_id as id,books.Book_title as Title,
                      authors.Name as Author,publishers.Name as publisher,
	                  category.Name as category,books.price as price,
	                  books.img_name as img  

                     FROM books JOIN authors on books.Author_id = authors.Author_id 
                     JOIN publishers on books.Publisher_id = publishers.Publisher_id  
                     JOIN   category  on books.Category_id = category.Category_id
                     order by id desc LIMIT 6; ";
			 if(!$result = mysqli_query($connect,$sql)){
				 echo mysqli_error($connect); 
		      }
?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	
	<style type="text/css">
	#content{
	 overflow: hidden;
	}
	 .books{
		 color:black;
		 text-align:center;
		 font-size:17px;
	 }
	 #footer{
		 background-color:#87CEFA;
		 padding:10px;
	 }
	</style>
	
</head>
<body style="background-color:#accb;" onload="change()">

	    <div id="nav" style="">		
		     <?php include "headnav.php"; ?>			 
			 <?php				   
				  if(isset($_SESSION['message'])){					 
				     echo $_SESSION['message']." <br /> " ;
					 unset($_SESSION['message']);
				 }
			 ?>	
           			 
		</div> <hr />
		
	    <div id="content" style="">
                <div id="newbook" class="books">
				      <p>New Books</p> 
								<table border='0' style="width:100% ; padding:10px; margin:20px 20px 15px 20px;">
								    <?php $count=0;
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
		
		<div id="footer" style="">
		 <hr />
		  <?php  include 'footer.php';?>
		</div>
		
<script type="text/javascript">
      function change(){
        var  val= document.getElementById("headnav").children;
             for(var i=0 ; i<val.length;i++){
	            val[i].removeAttribute("class");
            }   
        val[0].setAttribute("class","active");
     }
</script>

</body>
</html>