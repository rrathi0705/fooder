<?php
	session_start();
	include 'includes/dbh.inc.php';
	$name = $_SESSION['user_name'];
	$sql = "SELECT * from restaurants where rest_ownername='$name'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	$rest_name = $row['rest_name'];
	$haverest=0;
	$checkhaveRes = "Select * from users where user_name = '$name'";
	$have = mysqli_query($conn,$checkhaveRes);
	$row1 = mysqli_fetch_array($have);
	if($row1['user_haverest']==1){
		$haverest=1;
	}
	if(isset($_POST['addcuisine'])){
		$cuisinename = $_POST['dish'];
		$type = $_POST['type'];
		$cost = $_POST['cost'];
		$restname = str_replace(' ','',$rest_name);
		$insertdish = "INSERT into $restname(cuisine,type,cost) values ('$cuisinename','$type','$cost')";
		mysqli_query($conn,$insertdish);
		unset($_POST['addcuisine']);
	}
?>
<html>
<head>
	<title>Manage-<?php echo $rest_name;?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/manage.css">
</head>
<body>
	<header>
		<h2>Fooder</h2>
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name;?>
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="userLoggedIn.php">Home</a></li>
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
		<div>
			<form method="post" action="ManageRestaurant.php">
				<div class="card">
					<h3>Add a Cuisine</h3>
					<div class="form-row">
			    		<div class="form-group col-sm-6">
			    			<label>Cuisine Name</label>
			    			<input type="text" name="dish" class="form-control">
			    		</div>
			    		<div class="form-group col-sm-4">
			    			<label>Cuisine type</label>
			    			<input type="text" name="type" class="form-control">
			    		</div>
			    		<div class="form-group col-sm-2">
			    			<label>Cuisine Cost</label>
			    			<input type="integer" name="cost" class="form-control">
			    		</div>
		    		</div>
		    		<div><button class="btn btn-success" name="addcuisine">Add</button></div>
	    		</div>
	        </form>
		</div>
		<div>
			<?php 
				$restname = str_replace(' ','',$rest_name);
				$findDish = "SELECT * from $restname";
				$dishes = mysqli_query($conn,$findDish);
				if(mysqli_num_rows($dishes)>0){
				while($rows = mysqli_fetch_array($dishes)){
			?>
			<div class="card">
				<div class="form-row">
			    		<div class="form-group col-sm-6">
			    			<label>Cuisine Name</label>
			    			<input type="text" name="dish" class="form-control" value="<?php echo $rows['cuisine'];?>">
			    		</div>
			    		<div class="form-group col-sm-4">
			    			<label>Cuisine type</label>
			    			<input type="text" name="type" class="form-control" value="<?php echo $rows['type'];?>">
			    		</div>
			    		<div class="form-group col-sm-2">
			    			<label>Cuisine Cost</label>
			    			<input type="integer" name="cost" class="form-control" value="<?php echo $rows['cost'];?>">
			    		</div>
		    		</div>
			</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</body>
</html>