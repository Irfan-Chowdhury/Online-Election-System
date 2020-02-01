<!-- ----------- Header  ---------------- -->
<?php include 'inc/header.php'; ?>
<!-- ________________ X ________________ -->

<!-- ------------------- 1st For (wihtout login if he try to acces main page) -------------------- -->
<?php 
	$login = Session::get("userLogin");  //watch classes/Registration.php, method-2
	if ($login == false) {   
		header("Location:login.php");
	}
?>

<!--*********--------- Main Content **********---------->

<div class="container" style="margin-top:10%">
 <div class="jumbotron">
      <h1 class="display-1 font-weight-bold text-uppercase ml9" >Welcome To</h1>
      <h1 class="display-3 text-info font-weight-bold text-uppercase ml9"><span class="text-wrapper">
    <span class="letters">Online Election System</span>
  </span></h1>
 </div>
</div>

<!--*********--------- Main Content End **********---------->



<!--*********--------- Script for Text Animate **********---------->

<script >
    
    // Wrap every letter in a span
$('.ml9 .letters').each(function(){
  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
});

anime.timeline({loop: true})
  .add({
    targets: '.ml9 .letter',
    scale: [0, 1],
    duration: 1500,
    elasticity: 600,
    delay: function(el, i) {
      return 45 * (i+1)
    }
  }).add({
    targets: '.ml9',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
</script>
<!--*********--------- Script for Text Animate End **********---------->


 <!-- ----------- Footer ---------------- -->
<?php include 'inc/footer.php' ?>; 
<!-- ________________ X ________________ -->

