<?php
	session_start();
	include 'includes/dbh.inc.php';
	$rest_name = $_POST['rest_name'];
	$total = $_POST['total'];
	$rest_name=str_replace(" ", '',$rest_name);
	$dishid = $_POST['id'];
	$output = '<li class="row"><div class="col-sm-6">';
	$sql = "SELECT * from $rest_name where dish_id = '$dishid'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$price = $row['cost'];
			$output.='<p>'.$row["cuisine"].'</p></div><div class="col-sm-4">'.$price.'</div>';
			$total=+$price;
		}
	}
	$output.='</li>';
	//$output = $rest_name;
	$ans='';
	$ans.=$output.','.$total;
	echo $ans;
?>