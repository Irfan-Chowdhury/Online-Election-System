<?php 
	include '../lib/Session.php' ;
	Session::checkLogin();  //New Updated 
?>

<?php include '../config/config.php' ; ?>
<?php include '../lib/Database.php' ; ?>
<?php include '../helpers/Format.php' ; ?>

<?php 
	$db= new Database();
	$fm= new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		 $username=$_POST['username'];
		 $password=$_POST['password'];
		 $username=mysqli_real_escape_string($db->link, $username); //mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
		 $password=mysqli_real_escape_string($db->link, $password);

		$query= "SELECT *FROM tbl_admin WHERE username= '$username' AND password = '$password' ";
		$result= $db->select($query);
		
		if($result != false)
		{			
				$value= $result->fetch_assoc();
				Session::set("userLogin",true);  //---lib/session এ যেটা আছে ওভাবেই userLogin দিতে হবে 
				Session::set("username", $value['username']);
				header("Location:index.php");

		}else {
			echo "<span style='color:red; font-size:18px;'>Username or Password Not found</span>";
		}
	}  
	//The mysqli_fetch_assoc() function fetches a result row as an associative array.
?>	

		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Online Election System</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>