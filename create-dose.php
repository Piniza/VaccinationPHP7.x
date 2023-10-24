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
$idp=$_POST['idp'];
$numero=$_POST['numero'];
$date=$_POST['date'];	
$idv=$_POST['idv'];	

$sql="INSERT INTO dose(numero,date,idp,idv) VALUES(:numero,:date,:idp,:idv)";
$query = $dbh->prepare($sql);
$query->bindParam(':numero',$numero,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':idp',$idp,PDO::PARAM_STR);
$query->bindParam(':idv',$idv,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Dose Ajoutée Avec Succés";
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
<title>Ajouter La Dose de Vaccin</title>

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
                <li class="breadcrumb-item"><a href="index.php">Acceuil</a><i class="fa fa-angle-right"></i>Ajouter Une Personne<i class="fa fa-angle-right"></i>Ajouter Une Dose </li>
            </ol>

 	<div class="grid-form">
	 <?php 
$id=intval($_GET['id']);
$sql = "SELECT * from personne where id=:id";
$query = $dbh -> prepare($sql);
$query -> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

  <div class="grid-form1">
  	       <h3>Ajouter une Dose</h3>
  	        	  <?php if($error){?><div class="errorWrap"><strong>Erreur</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>Succés</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="personne" method="post" enctype="multipart/form-data">
							<div class="form-group">									
									<div class="col-sm-8">
										<input type="hidden" class="form-control1" name="idp" id="idp" placeholder="" value="<?php echo htmlentities($result->id);?> " >
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">CIN et NOM Complet de la Personne</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1"  placeholder="<?php echo htmlentities($result->cin)." - ".htmlentities($result->nom)." ".htmlentities($result->prenom);?>" disabled >
									</div>
								</div>
								<?php
								$q= $dbh->prepare("SELECT numero FROM `dose` WHERE idp=? order by numero desc limit 1");
								$q->execute([$result->id]);
								$j = $q->fetchColumn();
								$i=1;
								$dz="";								
								if ($j==3)
								{
									echo "<script>alert('Attention: Personne Vacciné Totalement!');</script>";
									echo "<script type='text/javascript'> document.location = 'manage-users.php'; </script>";;
								} else if ($j==0)
								{
									$i=1;
								} else if ($j==1)
								{
									$i=2;
								} else if ($j==2){ $i=3;}
								
								?>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Numero de la Dose</label>
									<div class="col-sm-8">
									<select  name="numero" class="form-control">
									<option value= <?php echo $i; ?> >Dose N° : <?php echo $i; ?></option>                           		
									</select>
									</div>
								</div>
								<?php

								$id=intval($_GET['id']);
								if ($j!=0) {
									$ch="select v.type, v.id from vaccins v, dose d,personne p where v.id=d.idv and p.id=d.idp and d.idp= ";
									$ch2=" order by v.type desc limit 1 ";
									$ch1=$ch.$id.$ch2;
								}
								else $ch1='select * from vaccins ';
								
								$smt=$dbh->prepare($ch1);
								$smt->execute();
								$data = $smt->fetchAll();
								?>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nom du vaccin</label>
									<div class="col-sm-8">
									
									<select  name="idv" class="form-control">
									<?php foreach ($data as $row): ?>
									<option value="<?=$row["id"]?>"><?=$row["type"]?></option>   
									<?php endforeach ?>                     			
									</select>
								
									</div>
								</div>
								
								
<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Date de la Dose </label>
									<div class="col-sm-8">
										<script>
											var today = new Date();
											var dd = today.getDate();
											var mm = today.getMonth()+1; 
											var yyyy = today.getFullYear();
												if(dd<10){
  													dd='0'+dd
														 } 
												if(mm<10){
  												mm='0'+mm
												} 

												today = yyyy+'-'+mm+'-'+dd;
												document.getElementById("datefield").setAttribute("min", today);
										</script>
									<input class="form-control" placeholder="Requested Date YY/MM/DD" id="datefield" name="date" max="2023-01-01" min="2022-04-01" type="date" required>
									</div>
								</div>
								<?php } ?>


											


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
		
	 </0div>
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
							  <?php } ?>
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