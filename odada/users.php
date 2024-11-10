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
    <title>View Users</title>
    <link rel="stylesheet" href="users.css">
</head>
<body>
    <a class="back-link" href="index.php">Return to Home</a>
    <h1>Users List</h1>

    <table class="styled-table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $getAllUsers = getAllUsers($pdo); ?>
            <?php foreach ($getAllUsers as $row) { ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['date_added']; ?></td>
                    <td>
                        <a class="action-link" href="edituser.php?user_id=<?php echo $row['user_id']; ?>">Edit</a>
                        <a class="action-link" href="deleteuser.php?user_id=<?php echo $row['user_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
