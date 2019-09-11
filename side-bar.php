<?php
    include "connection.php";
    $sql1 = "select Name from category";
	$result1 = mysqli_query($connect,$sql1);
	if(!$result1){		
		echo mysqli_error($connect);
	}
?>   
   <!DOCTYPE HTML>
   <html lang="en-US">
   <head>
   	<meta charset="UTF-8">
   	<title></title>
	<script type = "text/javascript" src ="jquery/jquery-3.3.1.js" ></script>
	<script> 
        $(document).ready(function(){
		$(".list").css({"background-color":"#accb" ,"color":"green","padding":"10px","margin":"10px","list-style-type":"none"});	
        $("#flip").click(function(){
        $(".list").slideToggle("slow");
         });
         });
   </script>
   </head>
 <body>
<div id="sidenav">
<h3 id ="flip">Category</h3>	
<div id="category" Style="">	   
<ul>
<?php 
    while($row = mysqli_fetch_array($result1)){?>     
			  <li class ='list'><a href="<?php echo $row["Name"];?>.php?cat=<?php echo $row["Name"];?>"><?php echo $row["Name"];?></a></li>
<?php }	
	 mysqli_free_result($result1);
?>
</ul>
</div>
</div>

</body>
</html>
   
	