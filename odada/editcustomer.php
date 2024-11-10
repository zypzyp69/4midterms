<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="editcustomer.css">
</head>
<body>

	<a href="index.php">Return to home</a>
	<?php $getCustomerByID = getCustomerByID($pdo, $_GET['customer_id']); ?>
	<h1>Edit the Customer!</h1>
	<form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
    	<p>
        	<label for="tableNumber">Table Number</label> 
        	<input type="number" name="table_num" min="1" required value="<?php echo $getCustomerByID['table_num']; ?>">
    	</p>
    	<p>
        	<label for="customerName">Customer Name</label> 
        	<input type="text" name="cus_name" value="<?php echo $getCustomerByID['cus_name']; ?>">
        	<input type="submit" name="editCustomerBtn">
    	</p>
	</form>

</body>
</html>