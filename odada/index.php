<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>	

	

	<?php if (isset($_SESSION['message'])) { ?>
        <h1 class="message"><?php echo $_SESSION['message']; ?></h1>
    <?php } unset($_SESSION['message']); ?>

	

    <?php if (isset($_SESSION['username'])) { ?>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="core/handleForms.php?logoutAUser=1">Logout</a>
    <?php } else { echo "<h1>No user logged in</h1>"; } ?>




	<p><a href="users.php">View Users</a></p>
    




	<h1>Welcome to Ocsado's Bakery, Order now!</h1>


	<table>
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Description</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Chocolate Fudge Cake</td>
			<td>Moist chocolate cake with fudge icing and chocolate shavings.</td>
			<td>$15.99</td>
		</tr>
		<tr>
			<td>CBlueberry Muffins (Pack of 6)</td>
			<td>Soft muffins loaded with blueberries and a hint of vanilla.</td>
			<td>$7.99</td>
		</tr>
		<tr>
			<td>Artisan Sourdough Bread</td>
			<td>Crunchy crust with a soft, airy center and a tangy flavor.</td>
			<td>$5.50</td>
		</tr>
		<tr>
			<td>Lemon Tart</td>
			<td>Buttery crust filled with zesty lemon custard.</td>
			<td>$9.99</td>
		</tr>
		<tr>
			<td>Raspberry Cheesecake</td>
			<td>Creamy cheesecake swirled with fresh raspberry compote.</td>
			<td>$18.50</td>
		</tr>
		<tr>
			<td>Classic Croissants (Pack of 4)</td>
			<td>Buttery, flaky croissants with a golden crust.</td>
			<td>$8.00</td>
		</tr>
	</tbody>
</table>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">Table Number</label>
			<input type="number" name="table_num" min="1" required> 
		</p>
		<p>
			<label for="firstName">Customer Name</label> 
			<input type="text" name="cus_name">
			<input type="submit" name="insertCustomerBtn">
		</p>
	</form>
	<?php $getAllCustomer = getAllCustomer($pdo); ?>
	<?php foreach ($getAllCustomer as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>Table Number: <?php echo $row['table_num']; ?></h3>
		<h3>Customer Name: <?php echo $row['cus_name']; ?></h3>
		<h3>Added by: <?php echo $row['added_by']; ?></h3>
		<h3>Edited by: <?php echo $row['edited_by']; ?></h3>
		<h3>Date Added: <?php echo $row['date_added']; ?></h3>
		<h3>Last Updated: <?php echo $row['last_updated']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="vieworders.php?customer_id=<?php echo $row['customer_id']; ?>">View Order</a>
			<a href="editcustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Edit</a>
			<a href="deletecustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>