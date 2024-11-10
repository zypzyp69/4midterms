<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete User</title>
	<link rel="stylesheet" href="deleteuser.css">
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>

	<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>

	<div class="container">
		<h2>User ID: <?php echo $getUserByID['user_id']; ?></h2>
		<h2>Username: <?php echo $getUserByID['username']; ?></h2>
		<h2>Date Added: <?php echo $getUserByID['date_added']; ?></h2>

		<div class="deleteBtn">
			<form action="core/handleForms.php?user_id=<?php echo $_GET['user_id']; ?>" method="POST">
				<input type="submit" name="deleteUserBtn" value="Delete" class="delete-btn">
			</form>			
		</div>	
	</div>
    <a class="back-link" href="users.php">Return to View Users</a>
</body>
</html>
