<?php
	include 'includes/dbh.inc.php';
	$sqlRest = "SELECT * from restaurants";
	$result = mysqli_query($conn,$sqlRest);
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
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<script type="text/javascript">
	function sortByRating(){

	}
	function cuisinefilter(val){
		window.location.href = "filter.php?criteria="+val;
		return false;
	}
</script>
<body>
	<header>
		<h2>Fooder</h2>
		<a href="logsignup/login.php" class="loginbutton btn" data-toggle="modal" data-target="#login">Login</a>
		<a href="logsignup/signup.php" class="btn signupbutton" data-toggle="modal" data-target="#signup">Create an account</a>
	</header>
	<div class="container">
		<h2 style="margin-top: 1%;">Order Food Online from your favourite outlet</h2>
		<?php
			$c=0;
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_array($result)){
					$name =  $row['rest_name'];
					$image = $row['rest_image'];
					$rating = $row['rest_rating'];
					$cuisine = $row['rest_cuisine'];
					$c++;
		?>
			<?php if($c%2==1){
				$offset= '<div class="row"><div class="offset-2 card"><div class="row">
					<div class="col-sm-3"><img src="'.$image.'"></div>
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-10"><h5>'.$name.'</h5></div>
							<div class="col-sm-2"><button class="btn btn-success">'.$rating.'</button></div>
						</div>
						<div class="row">
							<div class="col-sm-12">'.$cuisine.'</div>
						</div>
					</div>
				</div>
				<hr>
				<button class="btn btn-success">Order Online</button></div>';
				echo $offset;
			 }else{
			 	$normal = '<div class="card"><div class="row">
					<div class="col-sm-3"><img src="'.$image.'"></div>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-10"><h5>'.$name.'</h5></div>
								<div class="col-sm-2"><button class="btn btn-success">'.$rating.'</button></div>
							</div>
							<div class="row">
								<div class="col-sm-12">'.$cuisine.'</div>
							</div>
						</div>
					</div>
					<hr>
					<button class="btn btn-success">Order Online</button>
				</div></div>';
				echo $normal;
				}
			}
		}
			?>
		<div class="filters col-sm-2">
			<h4>Filters</h4>
			<h5>Sort by</h5>
			<ul>
				<li><a href="" onclick="sort('popularity')">Popularity</a></li>
				<li><a href="" onclick="sort('rating')">Rating</a></li>
			</ul>
			<h5>Cuisine</h5>
			<ul>
				<li><button onclick="cuisinefilter('North Indian')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">North Indian</button></li>
				<li><button onclick="cuisine('Fast Food')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Fast Food</button></li>
				<li><button onclick="cuisine('Chinese')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Chinese</button></li>
				<li><button onclick="cuisine('Dessert')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Dessert</button></li>
				<li><button onclick="cuisine('Icecream')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Ice Cream</button></li>
				<li><button onclick="cuisine('Pizza')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Pizza</button></li>
				<li><button onclick="cuisine('South Indian')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">South Indian</button></li>
				<li><button onclick="cuisine('Cafe')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Cafe</button></li>
			</ul>
		</div>
		<form method="post" action="logsignup/signup.php">
			<div class="modal fade" id="signup" role="dialog">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header"  style="background-color: red; color: #fff;">
			          <h4 class="modal-title">SignUp to Fooder</h4>
			        </div>
			        <div class="modal-body">
			          <div class="form-group">
			          	<label>Full Name</label>
						<input type="text" name="user_name" class="form-control" required>
			          </div>
			          <div class="form-group">
			          	<label>Email</label>
						<input type="email" name="user_email" class="form-control" required>
			          </div>
			          <div class="form-group">
			          	<label>Password</label>
						<input type="password" name="user_password" class="form-control" required>
			          </div>
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="signup" class="btn btn-success">Sign Up</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			    </div>
			</div>
		</form>
		<form method="post" action="logsignup/login.php">
			<div class="modal fade" id="login" role="dialog">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header"  style="background-color: red; color: #fff;">
			          <h4 class="modal-title">Login to Fooder</h4>
			        </div>
			        <div class="modal-body">
			          <div class="form-group">
			          	<label>Email</label>
						<input type="email" name="user_email" class="form-control" required>
			          </div>
			          <div class="form-group">
			          	<label>Password</label>
						<input type="password" name="user_password" class="form-control" required>
			          </div>
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="login" class="btn btn-success">Login</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			    </div>
			</div>
		</form>
	</div>
</body>