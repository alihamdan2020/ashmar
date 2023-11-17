<?php

$con=mysqli_connect("localhost",
"sou2sore_root","jawad200584","sou2sore_jawad2022");

//$con=mysqli_connect("localhost","root","","kanana");

//if($con){
//$user=json_decode(file_get_contents('PHP://input'));
	


			$query="SELECT itemId,itemName,itemNameEnglish,itemPrice,items.catId,catName FROM items,categories WHERE items.catId=categories.catId order by items.catId";
			$result = mysqli_query($con, $query);
			while($row = mysqli_fetch_assoc($result))
			{$arr[] = $row;}
			
			echo json_encode($arr);


	

/*
$query="select * from users";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($result))
{$arr[] = $row;}

//json_encode to convert php array (result) to json array that cna be handel it by javacript

//echo(json_encode($arr));
print_r($arr[0]);
*/
?>