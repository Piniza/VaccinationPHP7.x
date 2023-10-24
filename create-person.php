<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$cin=$_POST['cin'];
$nom=$_POST['nom'];	
$prenom=$_POST['prenom'];
$adresse=$_POST['adresse'];	
$sexe=$_POST['sexe'];
$datenaissance=$_POST['datenaissance'];		

$cc = $_POST['cin'];
$stmt2 = $dbh->prepare("SELECT * FROM personne WHERE cin=?");
$stmt2->execute([$cc]); 
$us = $stmt2->fetch();

if ($us) { ?>
    <script type="text/javascript">
	alert("cin already exist"); 
	</script>

<?php
} else {
$sql="";
$sql="INSERT INTO personne(cin,nom,prenom,adresse,sexe,datenaissance) VALUES(:cin,:nom,:prenom,:adresse,:sexe,:datenaissance)";
$query = $dbh->prepare($sql);
$query->bindParam(':cin',$cin,PDO::PARAM_STR);
$query->bindParam(':nom',$nom,PDO::PARAM_STR);
$query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
$query->bindParam(':adresse',$adresse,PDO::PARAM_STR);
$query->bindParam(':sexe',$sexe,PDO::PARAM_STR);
$query->bindParam(':datenaissance',$datenaissance,PDO::PARAM_STR);
$query->execute();}
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Personne Ajouté Avec Succés";
}
else 
{
$error="Veuillez Bien Renseigner Les Données";
}

}

	?>
<!DOCTYPE HTML>
<html>
<head>
<title>Ajouter Une Personne</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head> 
<body>
   <div class="page-container">
 
<div class="left-content">
	   <div class="mother-grid-inner">
           
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>

	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Acceuil</a><i class="fa fa-angle-right"></i>Ajouter Une Personne </li>
            </ol>
		
 	<div class="grid-form">
 

  <div class="grid-form1">
  	       <h3>Ajouter une personne</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>Erreur</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>Succés</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Numero D'identité (CIN)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="cin" id="cin" placeholder="CIN" required>
									</div>
								</div>
<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nom</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="nom" id="nom" placeholder="NOM" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Prenom</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="prenom" id="prenom" placeholder=" PRENOM" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Adresse</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="adresse" id="adresse" placeholder="ADRESSE" required>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Sexe</label>
									<div class="col-sm-8">
									<select  name="sexe" class="form-control">
									<option value="homme">Homme</option>
                           			<option value="femme">Femme</option>
									</select>
									</div>
								</div>
<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Date de Naissance</label>
									<div class="col-sm-8">
									<input class="form-control"   name="datenaissance" type="date" max="2004-12-31" min="1900-01-01" required>
									</div>
								</div>		
											


								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">Ajouter</button>

				<button type="reset" class="btn-inverse btn">Reinitialiser</button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="manage-users.php"><button class="btn btn-danger" >Retour</a></tr>
			</div>
		</div>
						

						
						
						
					</div>
					
					</form>

     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		
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
  

</body>
</html>
<?php } ?>