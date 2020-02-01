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
<title>Canditate Registration Form</title>
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

<!-- ------------------------ 1st for Canditate Registration ------------------- -->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$canditateReg = $reg->canditateRegistration($_POST, $_FILES); //(watch class-UserReg.php, method-3)
	}
?>

<!-- main -->
<div class="main-w3layouts wrapper">
		<h1>Canditate Registration Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post" enctype="multipart/form-data">
<!-- show Message --> 
<?php if (isset($canditateReg)) { echo $canditateReg;}  ?> 	

                    <input class="file" type="file" name="image" required="">
					
					<input class="text" type="text" name="name" placeholder="Full Name" required="">
					
					<input class="radio" type="radio" name="gender" value="Male">Male 
					<input class="radio" type="radio" name="gender" value="Female">Female
					
					<input class="number" type="number" name="age" placeholder="Age" required="">
					
<!-- ----------------- For Select Country Option ----------------- -->                    
                    <select name="country">
                        <option>--Select Country--</option>
<?php 
    $getCountry=$reg->getAllCountry();  //Method-4
    if ($getCountry) {
        while ($result =$getCountry->fetch_assoc()){ 
?>
                        <option value="<?php echo $result['countryName']; ?>"><?php echo $result['countryName']; ?></option>       
<?php } } ?> 
                    </select>
<!-- ___________________ X ______________________ -->    

					<input class="text" type="text" name="address" placeholder="Address" required="">

                    <input class="text" type="text" name="voterId" placeholder="Voter ID" required="">


<!-- ----------------- For Select Designation Option ----------------- -->                    
					<select name="designation">
						<option>--Select Designation--</option>
<?php
    $getDesignation=$reg->getAllDesignation();  //Method-11
    if ($getDesignation) {
        while ($result =$getDesignation->fetch_assoc()){
?>						
                        <option value="<?php echo $result['designation']; ?>"><?php echo $result['designation']; ?></option>       
<?php } } ?>
					</select>
                    <!-- <input class="text" type="text" name="designation" placeholder="Designation" required=""> -->
<!-- ___________________ X ______________________ -->    
                    
                    <input class="text" type="text" name="commitment" placeholder="Commitment" required="">

					<input class="text email" type="email" name="email" placeholder="Email" required="">

                    <!-- <input class="text" type="password" name="password" placeholder="Password" required=""> -->

<!-- ----------------- For Select Election Option ----------------- -->
                    <select name="electionId">
                        <option>--Select Election--</option>
<?php 
    $getElection=$reg->getAllElection();  // watch- Registration.php, Method-6
    if ($getElection) {
        while ($result =$getElection->fetch_assoc()){ 
?>
                        <option value="<?php echo $result['electionId']; ?>"><?php echo $result['electionName']; ?></option>       
<?php } } ?> 
                    </select>
<!-- ___________________ X ______________________ -->    

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


<!-- ________________ X X X ____________________________ -->



