<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="edituser.css">
</head>
<body>

    <h1>Edit the User</h1>
    <p class="note">You will be redirected to the login page after editing your username.</p>

    <?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
    <form action="core/handleForms.php?user_id=<?php echo $_GET['user_id']; ?>" method="POST" class="form-container">
        <p>
            <label for="username">Username</label> 
            <input type="text" name="username" value="<?php echo $getUserByID['username']; ?>" required>
        </p>
        <p>
            <input type="submit" name="editUserBtn" value="Save Changes" class="submit-btn">
        </p>
    </form>

    <a class="back-link" href="users.php">Return to View Users</a>
</body>
</html>
