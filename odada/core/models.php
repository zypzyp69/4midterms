
<?php  


function insertCustomer($pdo, $table_num, $cus_name, $added_by, $edited_by) {
    $sql = "INSERT INTO customer (table_num, cus_name, added_by, edited_by) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$table_num, $cus_name, $added_by, $edited_by]); 

    if ($executeQuery) {
        return true;
    }
}



function updateCustomer($pdo, $table_num, $cus_name, $edited_by, $customer_id) {
    $sql = "UPDATE customer
            SET table_num = ?,	
                cus_name = ?,
                edited_by = ?
            WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$table_num, $cus_name, $edited_by, $customer_id]);
    
    if ($executeQuery) {
        return true;
    }
}




function deleteCustomer($pdo, $customer_id) {
	$deleteCustomerOrder = "DELETE FROM orders WHERE customer_id = ?";
	$deleteStmt = $pdo->prepare($deleteCustomerOrder);
	$executeDeleteQuery = $deleteStmt->execute([$customer_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM customer WHERE customer_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$customer_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllCustomer($pdo) {
	$sql = "SELECT customer.*, orders.order_name
			FROM customer
			LEFT JOIN orders ON customer.customer_id = orders.customer_id";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCustomerByID($pdo, $customer_id) {
	$sql = "SELECT * FROM customer WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}


function getAllInfoByCustomerID($customer_id) {
    require 'dbConfig.php'; 

    try {
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : []; // Return an empty array if no result
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}



function getOrderByCustomer($pdo, $customer_id) {
    $sql = "SELECT 
                orders.*, customer.cus_name
            FROM orders
            JOIN customer ON orders.customer_id = customer.customer_id
            WHERE orders.customer_id = ? 
            GROUP BY orders.order_name";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}



function insertOrder($pdo, $order_name, $username, $quantity, $customer_id) {
	$sql = "INSERT INTO orders (order_name, added_by, quantity, customer_id) 
            VALUES(?, ?, ?, ?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$order_name, $username, $quantity, $customer_id]);
	if ($executeQuery) {
		return true;
	}

}

function getOrderByID($pdo, $order_id) {
	$sql = "SELECT 
				orders.order_id AS order_id,
				orders.order_name AS order_name,
				orders.quantity AS quantity,
				orders.date_added AS date_added,
				-- CONCAT(customer.cus_name,' ',customer.cus_order) AS Customer`
				customer.cus_name AS cus_name
			FROM orders
			JOIN customer ON orders.customer_id = customer.customer_id
			WHERE orders.order_id  = ? 
			GROUP BY orders.order_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$order_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateOrder($pdo, $order_name, $username, $quantity, $order_id) {
	$sql = "UPDATE orders
			SET 
				
				order_name = ?,
				edited_by = ?,
				quantity = ?
				
			WHERE order_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$order_name, $username, $quantity, $order_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteOrder($pdo, $order_id) {
	$sql = "DELETE FROM orders WHERE order_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$order_id]);
	if ($executeQuery) {
		return true;
	}
}


function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully registered";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

	
}



function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}


function deleteUser($pdo, $user_id) {
	$deleteUser = "DELETE FROM user_passwords WHERE user_id = ?";
	$deleteStmt = $pdo->prepare($deleteUser);
	$executeDeleteQuery = $deleteStmt->execute([$user_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM user_passwords WHERE user_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$user_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function editUser($pdo, $username , $user_id) {
    $sql = "UPDATE user_passwords
            SET username = ?	
            WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$username, $user_id]);
    
    if ($executeQuery) {
        return true;
    }
}




?>
