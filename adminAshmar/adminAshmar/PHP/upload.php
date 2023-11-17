<?php
// Start the session
session_start();
?>
<?php

$con=mysqli_connect("localhost",
"sou2sore_root","jawad200584","sou2sore_jawad2022");

if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
else
{
  
if (isset($_POST['submit']))
{
	 
	//then of submit
    $fileMimes = array(
        'jpg',
        'png',
		'jpeg'
    );
for($i=0;$i<count($_POST['catName']);$i++)
{
$catName=$_POST['catName'][$i];
$imgName=$_FILES['file']['name'][$i];
$tempname=$_FILES['file']['tmp_name'][$i];
$folder = "../../menu/images/".$_FILES['file']['name'][$i];   

mysqli_query($con,"insert into `categories` (`catId`,`catName`,`toDisplay?`,`catImage`) values (null,'$catName',-1,'$imgName')");
move_uploaded_file($tempname, $folder);
header("Refresh:0; url=../index.php"); 
}
/*
$tempname = $_FILES["file"]["tmp_name"]; 
$catName=$_POST['catName']; 
$imgName=$_FILES['file']['name'];
    // Validate selected file is a CSV file or not

    if (!empty($_FILES['file']['name']))
    {
       
		mysqli_query($con,"insert into `categories` (`catId`,`catName`,`catImage`) values (null,'$catName','$imgName')");

		echo "good";
		else
		echo "not good";
	}
*/
//end of submit then
}
}
?>