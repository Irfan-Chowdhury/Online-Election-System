<!-- _______________________________ Includes File ____________________________________ -->
<?php 
    include 'lib/Session.php'; 
    Session::init();

    //include_once 'lib/Database.php';
    //include_once 'helpers/Format.php';
    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });

    //$db  = new Database();
   // $fm  = new Format();
    $reg = new Registration(); 
    //$vote= new Vote();
    // include 'inc/header.php' 
?>
<!-- ____________________________________ HTML ________________________________________________________________________ -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="Login_v1/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login_v1/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="Login_v1/images/img-01.png" alt="IMG">
                </div>
                
<!-- 3rd For -> (if anyone try to acces login.php page when he already logged in) -->
<?php 
		$login = Session::get("userLogin"); //watch classesRegistration.php, method-2
		if ($login == true) {   
			header("Location:index.php");
		}
?>
<!--  2nd for User Login  -->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' ) { 
        
        $userVoterId= $_POST['voterId'];
		$userPass   = md5($_POST['password']);

        $userLogin = $reg->userLogin($userVoterId,$userPass);   // (watch class/Registration.php, method-2)
	}
?>

				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						Member Login
                    </span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text"  name="voterId" placeholder="Voter ID">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
<!-- ------------ show Message -------------- -->
<?php
	if (isset($userLogin)) {  
		echo $userLogin;
	}
?>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
							Login
						</button>
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<div class="text-center p-t-100  dropup">
						<div type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" >
							Create your Account
							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</div>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="userreg.php">As a Voter</a>
							<a class="dropdown-item" href="canditatereg.php">As a Canditate</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="Login_v1/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_v1/vendor/bootstrap/js/popper.js"></script>
	<script src="Login_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_v1/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Login_v1/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="Login_v1/js/main.js"></script>

</body>
</html>

<!-- ________________________________________ X X X X  ___________________________________________________________ -->


<?php //include 'inc/footer.php' ?>
