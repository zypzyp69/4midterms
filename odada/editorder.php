<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="editorder.css">
</head>
<body>

    <a href="index.php" class="back-link">Return to Home</a>
    
    <h1>Edit Order</h1>

    <?php

    $order_id = $_GET['order_id'];
    $order = getOrderById($pdo, $order_id); 
    ?>

    <form action="core/handleForms.php?order_id=<?php echo $_GET['order_id']; ?>" method="POST" class="form-container">
        <p>
            <label for="order_name">Order Name</label> 
            <input type="text" name="order_name" value="<?php echo $order['order_name']; ?>" required>
        </p>
        <p>
            <label for="quantity">Quantity</label> 
            <input type="number" name="quantity" min=1 value="<?php echo $order['quantity']; ?>" required>
        </p>
        <p>
            <input type="submit" name="editOrderBtn" value="Save Changes" class="submit-btn">
        </p>
    </form>

</body>
</html>
