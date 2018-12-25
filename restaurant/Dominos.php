<?php
	session_start();
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$haverest=0;
	include '../includes/dbh.inc.php';
	$rest_name=$_GET['name'];
	$sqlRest = "SELECT * from restaurants where rest_name='$rest_name'";
	$result = mysqli_query($conn,$sqlRest);
	$row = mysqli_fetch_assoc($result);
	$checkhaveRes = "Select * from users where user_name = '$name'";
	$have = mysqli_query($conn,$checkhaveRes);
	$row1 = mysqli_fetch_array($have);
	if($row1['user_haverest']==1){
		$haverest=1;
	}
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/order.css">
</head>
<script type="text/javascript">
	function sortByRating(){

	}
	function Order(name){
		name = name.replace(/ /gi,'');
		window.location.href = "restaurant/"+name+".php";
	}
</script>
<body>
	<header>
		<h2>Fooder</h2>
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name;?>
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="orderHistory.php">Order History</a></li>
			    <li><a href="AddRestaurant.php">Add Restaurant</a></li>
			    <li><a href="<?php if($haverest==1){ echo "ManageRestaurant.php";}else{ echo "#";}?>">Manage Restaurant</a></li>
			    <li><a href="logsignup/logout.php">Logout</a></li>
			</ul>
		</div>
	</header>
	<div class="container">
		<div class="card">
			<div class="row">
				<h2 class="col-sm-11"><?php echo $rest_name;?></h2>
				<div class="col-sm-1"><button class="btn btn-success"><?php echo $row['rest_rating'];?></button></div>
			</div>
			<p><?php echo $row['rest_address'];?></p>
		</div>
	</div>
</body>