<?php
	session_start();
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$haverest=0;
	include 'includes/dbh.inc.php';
	$rest_name=$_GET['name'];
	$_SESSION['rest_name']=$rest_name;
	$sqlRest = "SELECT * from restaurants where rest_name='$rest_name'";
	$result = mysqli_query($conn,$sqlRest);
	$row = mysqli_fetch_assoc($result);
	$checkhaveRes = "Select * from users where user_name = '$name'";
	$have = mysqli_query($conn,$checkhaveRes);
	$row1 = mysqli_fetch_array($have);
	if($row1['user_haverest']==1){
		$haverest=1;
	}
	$cartlist = '';
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/order.css">
</head>
<script type="text/javascript">
	var items ='';
	function sortByRating(){

	}
	function place(){
		window.location.href='placeorder.php?item='+items+'&total='+total;
	}
	function Order(name){
		window.location.href = "order.php?name="+name;
	}
	var total=0;
	function addcart(id) {
		items=items+id+',';
		$.ajax({
			url:"AddtoCart.php",
			method:"post",
			data:{id:id,rest_name:"<?php echo $rest_name;?>",total:total},
			success:function(data){
				item = data.split(',');
				total=total+parseInt(item[1]);
				$(".list").append(item[0]);
				$(".total").html(total);
				if(total==0){
					$(".placeOrder").html("");
				}else{
					$(".placeOrder").html('<button class="col-sm-12 btn btn-success" onclick="place()">Place a Order</button>');
				}
			}
		});
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
		<div class="card">
			<div class="row">
				<h2 class="col-sm-11"><?php echo $rest_name;?></h2>
				<div class="col-sm-1"><button class="btn btn-success"><?php echo $row['rest_rating'];?></button></div>
			</div>
			<p><?php echo $row['rest_address'];?></p>
		</div>
		<div class="row">
			<div class="menu col-sm-8">
				<div class="card">
					<h3>Menu</h3>
					<div class="form-row">
			    		<div class="form-group col-sm-5">
			    			<label>Cuisine Name</label>
			    			
			    		</div>
			    		<div class="form-group col-sm-3">
			    			<label>Cuisine type</label>
			    			
			    		</div>
			    		<div class="form-group col-sm-2">
			    			<label>Cuisine Cost</label>
			    			
			    		</div>
			    		<div class="form-group col-sm-2">
			    			<label>Count</label>
			    			
			    		</div>
	    			</div>
					<?php 
						$rest_name=str_replace(' ','',$rest_name);
						//echo $rest_name;
						$menusql = "SELECT * from $rest_name";
						$result = mysqli_query($conn,$menusql);
						if(mysqli_num_rows($result)>0){
							while($row = mysqli_fetch_array($result)){
					?>
					<div class="form-row">
			    		<div class="form-group col-sm-5">
			    			<!-- <label>Cuisine Name</label> -->
			    			<input type="text" name="dish" class="form-control" value="<?php echo $row['cuisine']; ?>" readonly>
			    		</div>
			    		<div class="form-group col-sm-3">
			    			<!-- <label>Cuisine type</label> -->
			    			<input type="text" name="type" class="form-control" value="<?php echo $row['type']; ?>" readonly>
			    		</div>
			    		<div class="form-group col-sm-2">
			    			<!-- <label>Cuisine Cost</label> -->
			    			<input type="integer" name="cost" class="form-control" value="<?php echo $row['cost']; ?>" readonly>
			    		</div>
			    		<div class="form-group col-sm-2">
			    			<!-- <label>Count</label> -->
			    			<button class="btn btn-success" onclick="addcart(<?php echo $row['dish_id']?>)">Add</button>
			    		</div>
	    			</div>
					<?php
						}
					}
					?>
				</div>
			</div>
			<div class="cart col-sm-4">
				<div class="card">
					<h4 class="text-center">Your Cart</h4>
					<div class="Cartitem">
						<ul class="list">
							
						</ul>
						<hr>
						<div class="row">
							<div class="col-sm-6 offset-1">Total</div>
							<div class="col-sm-4 total"></div>
							
						</div>
					</div>
					<div class="placeOrder" style="margin-top: 20px;">
						<button class="col-sm-12 btn btn-success" onclick="place()">Place a Order</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	if(total==0){
		$(".placeOrder").html("");
	}
</script>
</html>