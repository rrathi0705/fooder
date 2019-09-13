<?php
	session_start();
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$haverest=0;
?>
<?php
	include 'includes/dbh.inc.php';
	$sqlRest = "SELECT * from restaurants";
	$result = mysqli_query($conn,$sqlRest);
	$checkhaveRes = "Select * from users where user_name = '$name'";
	$have = mysqli_query($conn,$checkhaveRes);
	$row = mysqli_fetch_array($have);
	if($row['user_haverest']==1){
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
	<link rel="stylesheet" type="text/css" href="css/user.css">
</head>
<script type="text/javascript">
	function sortByRating(){

	}
	function Order(name){
		//name = name.replace(/ /gi,'');
		window.location.href = "order.php?name="+name;
	}
		function cuisinefilter(val){
		window.location.href = "filter.php?criteria="+val;
		return false;
	}
</script>
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
				<button class="btn btn-success" onclick="Order(\''.$name.'\')">Order Online</button></div>';
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
					<button class="btn btn-success" onclick="Order(\''.$name.'\')">Order Online</button>
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
				<li><button onclick="cuisinefilter('Fast Food')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Fast Food</button></li>
				<li><button onclick="cuisinefilter('Chinese')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Chinese</button></li>
				<li><button onclick="cuisinefilter('Dessert')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Dessert</button></li>
				<li><button onclick="cuisinefilter('Icecream')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Ice Cream</button></li>
				<li><button onclick="cuisinefilter('Pizza')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Pizza</button></li>
				<li><button onclick="cuisinefilter('South Indian')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">South Indian</button></li>
				<li><button onclick="cuisinefilter('Cafe')" style="border: none; background-color: #fff; cursor: pointer; color:blue;">Cafe</button></li>
			</ul>
		</div>
	</div>
</body>