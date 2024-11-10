<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="vieworders.css">
</head>
<body>
	<a href="index.php">Return to home</a>
	<h1>Add New Order</h1>
	<form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
		<p>
			<label for="firstName">Order Name</label>
			<input type="text" name="order_name">
		</p>
		<p>
			<label for="firstName">Quantity</label> 
			<input type="number" name="quantity" min="1" required> 
			<input type="submit" name="insertNewOrderBtn">
		</p>
	</form>

	<table style="width:100%; margin-top: 50px; text-align: center;">
	  <tr>
	    <th>Order ID</th>
	    <th>Order Name</th>
	    <th>Quantity</th>
	    <th>Customer</th>
	    <th>Date Added</th>
		<th>Added by</th>
		<th>Edited by</th>
		<th>Last Updated</th>
	    <th>Action</th>
	  </tr>
	  <?php $getOrderByCustomer = getOrderByCustomer($pdo, $_GET['customer_id']); ?>
	  <?php foreach ($getOrderByCustomer as $row) { ?>
	  <tr>
	  	<td><?php echo $row['order_id']; ?></td>	  	
	  	<td><?php echo $row['order_name']; ?></td>	  	  	
	  	<td><?php echo $row['quantity']; ?></td>
		<td><?php echo $row['cus_name']; ?></td>		  	
	  	<td><?php echo $row['date_added']; ?></td>
		<td><?php echo $row['added_by']; ?></td>
		<td><?php echo $row['edited_by']; ?></td>	
		<td><?php echo $row['last_updated']; ?></td>	
	  	<td>	  		
		  	<a href="editorder.php?order_id=<?php echo $row['order_id']; ?>$customer_id=<?php echo $_GET['customer_id']; ?>">Edit</a>
	  		<a href="deleteorder.php?order_id=<?php echo $row['order_id']; ?>$customer_id=<?php echo $_GET['customer_id']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>

	
</body>
</html>