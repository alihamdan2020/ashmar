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
     
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate selected file is a CSV file or not
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
        
        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);

        // Parse data from CSV file line by line
        
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        {
            
            // Get row data
            //$itemid = $getData[0];
            $itemname = $getData[3];            
			$itemprice= $getData[1];
			$catid = $getData[2]; 
			$itemenglishname=$getData[0];
			
           
            
            // If category already exists in the database with the same id
            //$query = "SELECT itemId FROM items WHERE itemId like '$itemid'";
            

            //$check = mysqli_query($con, $query);
            

/*
            if ($check->num_rows > 0)
            {
                mysqli_query($con, "UPDATE items SET itemName = '$itemname' WHERE itemId ='$itemid' ");
            }
            else
            {
            */
                 mysqli_query($con, "INSERT INTO `items`(`itemId`, `itemName`,`catId`,`itemPrice`,`itemNameEnglish`)  VALUES (null, '$itemname',$catid,$itemprice,'$itemenglishname')");
                 /*
            }
*/

            
        }

        // Close opened CSV file
        fclose($csvFile);
        $_SESSION["Message"] = "Your data has been addes succefully";
        header("Location: ../index.php");         
    }
    else
    {
         $_SESSION["Message"] = "Please select valid file";
        header("Location: ../index.php");         
    }
}
}


?>