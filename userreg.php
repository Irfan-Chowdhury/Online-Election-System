<!-- _______________________________ Includes File ____________________________________ -->
<?php 
    include 'lib/Session.php'; 
    Session::init();

    //include_once 'lib/Database.php';
    //include_once 'helpers/Format.php';
    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });

   // $db  = new Database();
    //$fm  = new Format();
    $reg = new Registration(); 
    $vote= new Vote();
    //include 'inc/header.php' 
?>
<!-- ____________________________________ HTML __________________________________________ -->

<!DOCTYPE html>
<html>
<head>
<title>Voter Registration Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="Sign_Up/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/stylekawsar.css" rel="stylesheet" type="text/css" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>

<!--  ____________________ 1st for User Registration__________________  -->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$userReg = $reg->userRegistration($_POST,$_FILES); // (watch class/Registration.php, method-1)
	}
?>

<!-- _____________________________ X X X _______________________________	 -->

	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Voter Registration Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post" enctype="multipart/form-data">
<!-- show Message --> 
<?php if (isset($userReg)) { echo $userReg;}  ?> 	
			
					<input class="file" type="file" name="image" required="">
					
					<input class="text" type="text" name="name" placeholder="Full Name" required="">
					
					<input class="radio" type="radio" name="gender" value="Male">Male 
					<input class="radio" type="radio" name="gender" value="Female">Female
					
					<input class="number" type="number" name="age" placeholder="Age" required="">

					<input class="text" type="text" name="address" placeholder="Address" required="">

					<input class="text" type="text" name="voterId" placeholder="Voter ID" required="">

					<input class="text email" type="email" name="email" placeholder="Email" required="">

					<input class="text" type="password" name="password" placeholder="Password" required="">

					<input type="hidden" name="status" value="1">

					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" name="submit" value="SIGNUP">
				</form>
				<p>Don't have an Account? <a href="login.php"> Login Now!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>© 2018 Signup Form. All rights reserved | Design by <a href="#" target="_blank">Kawsar & Samu</a></p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>