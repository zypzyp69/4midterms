<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';



if (isset($_POST['insertCustomerBtn'])) {
    $query = insertCustomer($pdo, $_POST['table_num'], $_POST['cus_name'], $_SESSION['username'], null);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}




if (isset($_POST['editCustomerBtn'])) {
    $query = updateCustomer($pdo, $_POST['table_num'], $_POST['cus_name'], $_SESSION['username'], $_GET['customer_id']);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Edit failed";
    }
}



if (isset($_POST['deleteCustomerBtn'])) {
	$query = deleteCustomer($pdo, $_GET['customer_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}





if (isset($_POST['insertNewOrderBtn'])) {
	$query = insertOrder($pdo, $_POST['order_name'], $_SESSION['username'], $_POST['quantity'], $_GET['customer_id']);

	if ($query) {
		header("Location: ../vieworders.php?customer_id=" .$_GET['customer_id']);
	}
	else {
		echo "Insertion failed";
	}
}


if (isset($_POST['editOrderBtn'])) {
	$query = updateOrder($pdo, $_POST['order_name'],  $_SESSION['username'], $_POST['quantity'], $_GET['order_id']);

	if ($query) {
		header("Location: ../index.php?");
	}
	else {
		echo "Update failed";
	}

}




if (isset($_POST['deleteOrderBtn'])) {
	$query = deleteOrder($pdo, $_GET['order_id']);

	if ($query) {
		header("Location: ../index.php?customer_id=" .$_GET['order_id']);
	}
	else {
		echo "Deletion failed";
	}
}


if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../register.php");
	}

}




if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['usernames'];
	$password = sha1($_POST['passwords']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
			$_SESSION['user'] = $username;
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	unset($_SESSION['user_id']);
	header('Location: ../login.php');
}






if (isset($_POST['deleteUserBtn'])) {
	$query = deleteUser($pdo, $_GET['user_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}


if (isset($_POST['editUserBtn'])) {
    $query = editUser($pdo, $_POST['username'], $_GET['user_id']);
    if ($query) {
        header("Location: ../login.php");
    } else {
        echo "Edit failed";
    }
}


?>


