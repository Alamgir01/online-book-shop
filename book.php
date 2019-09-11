<?php
     session_start();
?>	 
	 
    <?php
        include "connection.php";
		$perpageres=6;
		$start;
		$curentpage;
		
		if(!isset($_REQUEST['page'])){
			$curentpage =  1;
			$prev =$curentpage-1;
			$next = $curentpage+1;
		}else{	
			 $curentpage= $_REQUEST['page'];
			 $prev =$_REQUEST['page']-1;
			 $next = $_REQUEST['page']+1;
		}

		$start=($curentpage - 1)*$perpageres;
		
		   /*if($curentpage <=0){
			   echo "No result ";
			   exit();
		   }else{
			   
		   }*/
			$sql = "SELECT books.Book_id as id,books.Book_title as Title,
                      authors.Name as Author,publishers.Name as publisher,
	                  category.Name as category,books.price as price,
	                  books.img_name as img  

                     FROM books JOIN authors on books.Author_id = authors.Author_id 
                     JOIN publishers on books.Publisher_id = publishers.Publisher_id  
                     JOIN   category  on books.Category_id = category.Category_id
                      LIMIT $start,$perpageres; ";
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
	body{
		background-color:#accb;
	}
	#content{
		overflow:hidden;
		margin:20px;
		padding:15px;
	}
	#cse{
		 color:black;
		 text-align:center;
		 font-size:17px;
	}
	 #link a.active{
		 background-color:#00b3b3 ;
		 color:white;
	 }
	 
	  #link a{
		padding:5px;
        margin-top:30px;
        text-decoration: none;
        color:green;		
	  }
	   #link a:hover{
		   
	   }
	</style>
</head>
<body onload="change()">
	    <div id="" style="width:100%;">
		     <?php include "headnav.php"; ?>
		</div>
		
	    <div id="content" style="">
		     <div id="cse">      
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
						  				   
						?>
					  </table>
			 </div>
			 
			  <div id="link" style="text-align:center;">
			  
                <?php 

 				$sql1 = "select Book_id from books;";
				
                       $result1 =mysqli_query($connect,$sql1);
					   
					   if(!$result1){
						   echo mysqli_error($connect);
						   exit () ;
					   }
					   
					   $rows = mysqli_num_rows($result1);					   
					   $total_pages = ceil($rows/$perpageres);	
					   
						if($curentpage>1){
							echo "<a href='book.php?page=".$prev."'> Prev </a>";
						}
				        $pagLink = "";						 
							for ($i=1; $i<=$total_pages; $i++) { 
									if ($i==$curentpage) { 
										$pagLink .= "<a href='book.php?page=".$i."' class='active'>".$i."</a>"; 
									}			 
									else { 
										$pagLink .= "<a href='book.php?page=".$i."'> ".$i."</a>"; 
									} 
							}
							echo $pagLink;
                            if($curentpage<$total_pages){	
							echo "<a href='book.php?page=".$next."'> Next </a>";
						}									 
				?>			  
			  </div>
		</div>
		 <script type="text/javascript">
      function change(){
        var  val= document.getElementById("headnav").children;
             for(var i=0 ; i<val.length;i++){
	            val[i].removeAttribute("class");
            }   
        val[1].setAttribute("class","active");
     }
</script>
  
</body>
</html>