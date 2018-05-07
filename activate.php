<?php
//database connection
require('config.php');
// check first if record exists
$query = "SELECT id FROM users WHERE `verification_code` = ? and `status` = '0'";
$stmt = mysqli_query($con,$query) or die(mysql_error());
$rows = mysqli_num_rows($stmt);
$code = $_GET['code'];
 
if($rows>0){
	$row = mysqli_fetch_assoc($stmt);
	$verification_code = $row['verification_code'];
    // update the 'status' field, from 0 to 1 (unverified to status)
    $query = "UPDATE users 
                set status = '1'
                where `verification_code` = '$code' ORDER BY id desc";
	$result = mysqli_query($con,$query);
	
    if($result){ 
        // tell the user
        echo "<div>Your email is valid, thanks!. You may now login.</div>";
    }else{
        echo "<div>Unable to update verification code.</div>";
        //print_r($stmt->errorInfo());
    }
}else{
    // tell the user he should not be in this page
    echo "<div>I think you're in the wrong place.</div>";
}
?>