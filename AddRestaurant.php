<?php
	session_start();
	$name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/Addrestaurants.css">
</head>
<script type="text/javascript">
	function sortByRating(){

	}
</script>
<body>
	<header>
		<h2>Fooder</h2>
		<!-- <a href="logsignup/login.php" class="loginbutton btn">Login</a>
		<a href="logsignup/signup.php" class="btn signupbutton">Create an account</a> -->
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name;?>
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="userLoggedIn.php">Home</a></li>
				<li><a href="orderHistory.php">Order History</a></li>
			    <li><a href="AddRestaurant.php">Add Restaurant</a></li>
			    <li><a href="ManageRestaurant.php">Manage Restaurant</a></li>
			    <li><a href="logsignup/logout.php">Logout</a></li>
			</ul>
		</div>
	</header>
	<div class="container">
		<h3>Add a restaurant</h3>
		<div class="card">
			<form method="POST" action="includes/AddRestaurantData.php" enctype="multipart/form-data">
				<div class="form-group">
					<label>Restaurant Name</label>
					<input type="text" name="restaurantname" class="form-control" required>	
				</div>
				<div class="form-group">
					<label>Address</label>
					<input type="text" name="restaurantaddress" class="form-control" required>	
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="restaurantemail" class="form-control" required>	
				</div>
				<div class="form-group">
					<label>Image of Restaurant</label><br>
					<input type="file" name="image">
				</div>
				<label>Cuisine</label>
				<div class="form-group">
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" value="North Indian" name="cuisine[]">North Indian
						</label>
					</div>
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" value="Fast Food" name="cuisine[]">Fast Food
						</label>
					</div>
						<div class="form-check-inline disabled">
						<label class="form-check-label">
						    <input type="checkbox" class="form-check-input" value="Chinese" name="cuisine[]">Chinese
						</label>
					</div>
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" value="Pizza" name="cuisine[]">Pizza
						</label>
					</div>
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" value="Dessert" name="cuisine[]">Dessert
						</label>
					</div>
						<div class="form-check-inline disabled">
						<label class="form-check-label">
						    <input type="checkbox" class="form-check-input" value="Icecream" name="cuisine[]">Ice Cream
						</label>
					</div>	
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" value="South Indian" name="cuisine[]">South Indian
						</label>
					</div>
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" value="Cafe" name="cuisine[]">Cafe
						</label>		
					</div>
				</div>
				<div class="form-group">
					<label>Timing</label>
					<div class="row">
						<div class="col-sm-2">
							<label>Opening Time</label>
							<select class="form-control" name="open"> 
								<option value="9:00">9:00</option>
								<option value="10:00">10:00</option>
								<option value="11:00">11:00</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label>Closing Time</label>
							<select class="form-control" name="close">
								<option value="21:00">21:00</option>
								<option value="22:00">22:00</option>
								<option value="23:00">23:00</option>
							</select>
						</div>	
					</div>
				</div>
				<button class="btn btn-success" name="addrestaurant">Add a Restaurant</button>
			</form>
		</div>
	</div>
</body>