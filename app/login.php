<?php
	$page_title = "Login Person Database";
    include_once "../layout/layout_header.php";
	session_start();
	// print_r($_SESSION);
	// exit();
	$errMsg=''; // initialize message to display on HTML form
	if (isset($_POST['login'])){

		require '../database/database.php';
		$pdo = Database::connect();
		$sql = "SELECT * FROM persons "
			. " WHERE email =? "
			//. " AND password =? "
			. " LIMIT 1 "
			;
			
		$query=$pdo->prepare($sql);
		$query->execute(Array($_POST['username']));
		$result = $query->fetch(PDO::FETCH_ASSOC);
        print_r($result);
        //rehash entered password and compare
        $dbvalue = $result['password_hash'];
        $dbsalt  = $result['password_salt'];
            
		if($dbvalue == MD5($_POST['password'] . $dbsalt)) {
			$_SESSION['username'] = $result['email'];
            $_SESSION['role'] = $result['role'];
			header("Location: index.php");
		}
	else {
		$errMsg='Login failure: wrong username or password';
	}
	}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Person Login</title>
		<meta charset="utf-8" />
	</head>
	
	<body>
		<h2>Login</h2>
		
		<form action="" method="post">
			
			<p style="color: red;"><?php echo $errMsg; ?></p>
			
			<input type="text" class="form-control"
				name="username" placeholder="admin@admin.com"
				required autofocus /> <br />
				
			<input type="password" class="form-control"
				name="password" placeholder="admin"
				required /> <br />
				
			<button class="btn btn-lg btn-primary  btn-block"
				type="submit" name="login">Login</button>
		</form>
		
	</body>
    <?php
  
  // footer
  include_once "../layout/layout_footer.php";
  ?>