<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Centre Vaccination</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />

<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>

<link href="css/font-awesome.css" rel="stylesheet"> 

<script src="js/jquery-2.1.4.min.js"></script>

<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />

</head> 
<body>
   <div class="page-container">
  
<div class="left-content">
	   <div class="mother-grid-inner">

<?php include('includes/header.php');?>

		<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Acceuil</a> <i class="fa fa-angle-right"></i></li>
            </ol>

		<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-agileits">
							<div class="icon">
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<a href="manage-users.php"><h3>Personnes</h3></a>

								<?php $sql = "SELECT id from personne";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
					?>			<h4> <?php echo htmlentities($cnt);?> </h4>
				
								
							</div>
							
						</div>
					</div>
								
							</div>
				<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-agileinfo">
							<div class="icon">
								<i class="glyphicon glyphicon-list" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<a href="manage-vaccins.php"><h3>Vaccins</h3></a>

								<?php $sql = "SELECT id from vaccins";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
					?>			<h4> <?php echo htmlentities($cnt);?> </h4>
				
								
							</div>
							
						</div>
					</div>
								
							</div>
							<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-wthree" href="manage-centre.php">
							<div class="icon">
								<i class="glyphicon glyphicon-home" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<a href="manage-centre.php"><h3>Centres</h3></a>

								<?php $sql = "SELECT id from centrevaccination";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
					?>			<h4> <?php echo htmlentities($cnt);?> </h4>
				
								
							</div>
							
						</div>
					</div>
								
							</div>
							
						</div>
					</div>
						<div class="clearfix"></div>
				</div>

	
								
							</div>
							
						</div>
					</div>


					<div class="clearfix"></div>
				</div>



<div class="inner-block">

</div>

<?php include('includes/footer.php');?>
</div>
</div>

				<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

   <script src="js/bootstrap.min.js"></script>
	
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script>
	$(document).ready(function() {
		
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	
	</script>
</body>
</html>
<?php } ?>