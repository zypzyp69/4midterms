<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="register.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
		font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
			border:1px solid black;
		}
	</style>
</head>
<body>
    <div class="register-container">
        <h1>Register Here!</h1>
        <?php if (isset($_SESSION['message'])) { ?>
            <h1 class="message"><?php echo $_SESSION['message']; ?></h1>
        <?php } unset($_SESSION['message']); ?>
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" required>
                <input type="submit" name="registerUserBtn" value="Register">
            </p>
        </form>
        <p>Already have an account? Go back <a href="login.php">here</a> to login</p>
    </div>
</body>

</html>