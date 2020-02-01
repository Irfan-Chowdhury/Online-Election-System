<?php
    include 'lib/Session.php'; 
    Session::init();

    include_once 'lib/Database.php';
    include_once 'helpers/Format.php';
    
    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });

    $db  = new Database();
    $fm  = new Format();
    $reg = new Registration(); 
    $vote= new Vote();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Election System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="Bootstrap-4/bootstrap.min.css"> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- <script src="Bootstrap-4/jquery-3.3.1.slim.min.js"></script>   -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- <script src="Bootstrap-4/popper.min.js"></script> -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- <script src="Bootstrap-4/bootstrap.min.js"></script> -->

  <!--  this for text animate-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

  <link rel="stylesheet" href="css/style.css">


  
  
  
<style>
    th{
        font-size: 20px;
    }

    #activecolor{
    color: aqua 
    }
    
    .bg-color{
        background-color: darkslategrey;
    }
</style>

</head>
<body>

<!--*********--------- Navbar **********---------->

 <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top font-weight-bold" >
  <a class="navbar-brand" href="#"><img src="logo.png" alt="" style="height: 50%; width: 50% "></a>
  
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
<span class="navbar-toggler-icon"></span>
</button>
  
<div class="collapse navbar-collapse" id="collapsibleNavbar">
<!-- ------------ For Navbar Active ------ -->
<?php
    $path = $_SERVER['SCRIPT_FILENAME'];
    $currentpage = basename($path,'.php');
?>
<!-- _________________________________ -->
<ul class="navbar-nav">

    <!-- <li class="nav-item">
      <a class="navbar-brand" id="activecolor" href="#">Home</a>
    </li> -->

    <li class="nav-item">
        <a <?php if ($currentpage=='index') { ?> 
                class= "navbar-brand" id='activecolor'  
            <?php }else{ ?> 
                class="navbar-brand text-warning"
            <?php } ?> 
            href="index.php">Home
        </a>
    </li>
    
     <li class="nav-item">
        <a <?php if ($currentpage=='canditates') { ?> 
                class= "navbar-brand" id='activecolor'  
            <?php }else{ ?> 
                class="navbar-brand text-warning"
            <?php } ?> 
            href="canditates.php">Canditates
        </a>        
    </li>
    
     <li class="nav-item">
        <a <?php if ($currentpage=='voting') { ?> 
                class= "navbar-brand" id='activecolor'  
            <?php }else{ ?> 
                class="navbar-brand text-warning"
            <?php } ?> 
            href="voting.php">Vote
        </a>
    </li>
    
    <li class="nav-item">
        <a <?php if ($currentpage=='result') { ?> 
                class= "navbar-brand" id='activecolor'  
            <?php }else{ ?> 
                class="navbar-brand text-warning"
            <?php } ?> 
            href="result.php">Result
        </a>
    </li>
    
     <li class="nav-item">
         <a <?php if ($currentpage=='profile') { ?> 
                class= "navbar-brand" id='activecolor'  
            <?php }else{ ?> 
                class="navbar-brand text-warning"
            <?php } ?> 
            href="profile.php">Profile
        </a>
    </li>
<!-- ------------------For Logout -------------- -->
<?php
if(isset($_GET['userId'])){
    $userId= Session::get("userId");
    Session::destroy();
}
?>
    <li class="nav-item">
        <a href="?userId=<?php Session::get("userId");?>"><button class="btn btn-outline-danger text-uppercase font-weight-bold" type="submit">L o g o ut</button></a>
    </li>
 <!-- _______________ X _______________    -->
  </ul>
</div>

<form class="form-inline p-2" action="/action_page.php">
<?php  
    $voterId= Session::get("voterId");
    $userNav= $reg->getUserProfile($voterId); //watch- class/Registration, Method-8
    if ($userNav) { 
        while ($result = $userNav->fetch_assoc()) {
?>        
       <img src="<?php echo $result['image']; ?>" alt="" height="50px" width="60px">
        <p class="ml-2 pt-2" style="color:whitesmoke">Hello, <strong style="color:burlywood"><?php echo $result['name']; ?></strong></p>

<?php  } } ?>
    <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search">
     <button class="btn btn-success" type="submit">Search</button> -->
</form>

</nav>