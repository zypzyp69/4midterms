<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="deletecustomer.css">
</head>
<body>
	<a href="index.php">Return to home</a>
	<h1>Are you sure you want to delete this Customer?</h1>
	<?php $getCustomerByID = getCustomerByID($pdo, $_GET['customer_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Table Number: <?php echo $getCustomerByID['table_num']; ?></h2>
		<h2>Customer name: <?php echo $getCustomerByID['cus_name']; ?></h2>
		<h2>Date Added: <?php echo $getCustomerByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
				<input type="submit" name="deleteCustomerBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>