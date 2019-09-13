<?php
	session_start();
	$name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$haverest=0;
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
		<?php
			$sql = "SELECT * from orders where user_name='$name'";
			$res = mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)>0){
				while($rows=mysqli_fetch_array($res)){
					$rest_name=$rows['rest_name'];
					$item=$rows['order_item'];
					$cost =$rows['cost'];
				$arr = array();
				$arr = explode(',', $item);?>
				<div class="card" style="width: 500px;">
				<h3><?php echo $rest_name; ?></h3><?php
				for($i=0;$i<sizeof($arr);$i++)
				{
					$x = $arr[$i];
					$rest_name=str_replace(' ', '', $rest_name);
					$sqlr = "SELECT * from $rest_name where dish_id='$x'";
					$dish = mysqli_query($conn,$sqlr);
					if(mysqli_num_rows($dish)>0){	
				while($rows1=mysqli_fetch_array($dish)){
					$cuisine=$rows1['cuisine'];
					$type =$rows1['type'];
					?>		
						<div class="row">
							<div class="col-sm-8"><h5><?php echo $cuisine;?></h5></div>
							<div class="col-sm-4"><p><?php echo $type;?></p></div>
						</div>	
			<?php	}
				}
			} echo "Total=".$cost;?></div><?php
		}
	}
		?>
	</div>
</body>