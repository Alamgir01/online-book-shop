<?php 
session_start();
?>

<?php
include "connection.php";
include "headnav.php";

 
if(isset($_REQUEST['pub']) and $_REQUEST['pub']=='true'){
$sql = "select COUNT(books.Book_title) as num_of_book,publishers.Name as Name
        from publishers join books on publishers.Publisher_id = books.publisher_id
        group by publishers.Name";
		
$res = mysqli_query($connect,$sql);
if(!$res){
	echo mysqli_error($connect); 
	exit();
}
}

   if(isset($_REQUEST['publisher'])){
		    $_SESSION['publish'] = $_REQUEST['publisher'];
			$publisher =  $_SESSION['publish'];
			 echo "<h3>$publisher</h3>"."<br />";
   
	    $perpageres=3;
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
		
			$sq = "SELECT books.Book_id as id,books.Book_title as Title,
                      authors.Name as Author,publishers.Name as publisher,
	                  category.Name as category,books.price as price,
	                  books.img_name as img  

                     FROM books JOIN authors on books.Author_id = authors.Author_id 
                     JOIN publishers on books.Publisher_id = publishers.Publisher_id  
                     JOIN   category  on books.Category_id = category.Category_id
                     where Publishers.Name = \"$publisher\" LIMIT $start,$perpageres;  ";
					 
			 if(!$result = mysqli_query($connect,$sq)){
				 echo mysqli_error($connect);
			 }
		 
   }
?>   

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style type="text/css">
	.pub table{
		border-collapse: collapse;
	}
	.pub a{
		 text-decoration: none;
		 padding:10px;
		 
	}
	.pub td{		
		padding:5px;
		margin:5px;
	}
	.pub td:hover{
		background-color:#00c9cc;
		font-size:20px;
		color:white;
	}
	
	
	#content{
	overflow:hidden;
	}
	#allbook{	 
		 color:black;
		 text-align:center;
		 font-size:17px;
	 }
	 
	 #content{
		overflow:hidden;
		margin:20px;
		padding:15px;
		background-color:#accb;
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
<?php if(isset($_REQUEST['pub']) and $_REQUEST['pub']=='true'){?>
<div class="pub">
<hr />
	<table  style='background-color:#accb;' width ='100%'><tr><th><h3>Publisher Name </h3></th> <th><h3>Number of Books </h3></th></tr>
     <?php while($row = mysqli_fetch_array($res)){?>
	<tr>
	<td>
	<a href="publisher.php?publisher=<?php echo $row["Name"];?> "> <?php echo $row["Name"];?> </a> 
	</td> 
	<td><?php echo $row["num_of_book"];?> 
	</td>
	</tr>
    <br />	
<?php
}
echo "</table>";
mysqli_free_result($res);
?>
</div>
<?php }else{?>
		
	    <div id="content" style="">
		     <div id="cse">      
					<table border='0' style="width:100% ; padding:10px; margin:20px 20px 15px 20px;">
						<?php $count=0;
						  
							for($i=0;$i<mysqli_num_rows($result);$i++){
								
								echo "<tr>";
								while($row = mysqli_fetch_array($result)){ ?>
										<td>           			
										<a href="content.php?bookid=<?php echo $row['id'] ;?>" class=""><img src="img/<?php echo $row['img'];?>" alt="" /></a>                         							   						   						 
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

 				$sql1 = "SELECT books.Book_id as id,books.Book_title as Title,
                      authors.Name as Author,publishers.Name as publisher,
	                  category.Name as category,books.price as price,
	                  books.img_name as img  

                     FROM books JOIN authors on books.Author_id = authors.Author_id 
                     JOIN publishers on books.Publisher_id = publishers.Publisher_id  
                     JOIN   category  on books.Category_id = category.Category_id
                     where publishers.Name = \"$publisher\" ";
				
                       $result1 =mysqli_query($connect,$sql1);
					   
					   if(!$result1){
						   echo mysqli_error($connect);
						   exit () ;
					   }
					   
					   $rows = mysqli_num_rows($result1);					   
					   $total_pages = ceil($rows/$perpageres);	
					   
						if($curentpage>1){
							echo "<a href='Publisher.php?publisher=".$publisher."&page=".$prev."&'>Prev</a>";
						}
				        $pagLink = "";						 
							for ($i=1; $i<=$total_pages; $i++) { 
									if ($i==$curentpage) { 
										$pagLink .= "<a href='Publisher.php?publisher=".$publisher."&page=".$i."' class='active'>".$i."</a>"; 
									}			 
									else { 
										$pagLink .= "<a href='Publisher.php?publisher=".$publisher."&page=".$i."'> ".$i."</a>"; 
									} 
							}
							echo $pagLink;
                            if($curentpage<$total_pages){	
							echo "<a href='Publisher.php?publisher=".$publisher."&page=".$next."&'> Next </a>";
						}								 
				?>			  
			  </div>
		</div>
		   

<?php }?>

<script type="text/javascript">
  function change(){
     var  val= document.getElementById("headnav").children;
      for(var i=0 ; i<val.length;i++){
	      val[i].removeAttribute("class");
     }   
      val[2].setAttribute("class","active");
   }
</script>
</body>
</html>
