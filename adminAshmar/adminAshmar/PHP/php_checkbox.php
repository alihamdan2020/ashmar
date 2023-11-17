<?php

$con=mysqli_connect(
"localhost","sou2sore_root","jawad200584","sou2sore_jawad2022");

//$con=mysqli_connect("localhost","root","","kanana");

 $data = file_get_contents("php://input");
      $items = json_decode($data, true);



for($i=0;$i<count($items);$i++){
	$name= $items[$i]['name'];
	$id=$items[$i]['id'];
	$price=$items[$i]['price'];
	mysqli_query($con, "UPDATE items SET itemPrice =$price,itemName='$name' WHERE itemId = $id");
}





header("Refresh:0; url=../index.php"); 

    

?>