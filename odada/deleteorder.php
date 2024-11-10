<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="deleteorder.css">
</head>
<body>
	<a href="index.php">Return to home</a>
	<?php $getOrderByID = getOrderByID($pdo, $_GET['order_id']); ?>
	<h1>Are you sure you want to delete this order?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Order Name: <?php echo $getOrderByID['order_name'] ?></h2>
		<h2>Quantity: <?php echo $getOrderByID['quantity'] ?></h2>
		<h2>Order ID: <?php echo $getOrderByID['order_id'] ?></h2>
		<h2>Date Added: <?php echo $getOrderByID['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?order_id=<?php echo $_GET['order_id']; ?>&customer_id=<?php echo $_GET['order_id']; ?>" method="POST">
				<input type="submit" name="deleteOrderBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>