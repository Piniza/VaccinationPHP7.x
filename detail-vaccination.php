<?php
session_start();
error_reporting(0);
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
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/> 
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />

<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>

<link href="css/font-awesome.css" rel="stylesheet"> 

<script src="js/jquery-2.1.4.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });

     //test dial l'impression 
     var doc = new jsPDF();
function saveDiv(divId, title) {
doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
doc.save('div.pdf');
}
function printDiv(divId,
 title) {
 let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
 mywindow.document.write(`<html><head><title>${title}</title>`);
 mywindow.document.write('</head><body >');
 mywindow.document.write(document.getElementById(divId).innerHTML);
 mywindow.document.write('</body></html>');
 mywindow.document.close(); 
 mywindow.focus();
 mywindow.print();
 mywindow.close();
 return true; 
}
//sala script
</script>

<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />

</head> 
<body>
   <div class="page-container">
   
<div class="left-content">
	   <div class="mother-grid-inner">
            
				<?php include('includes/header.php');?>
				     <div class="clearfix"> </div>	
				</div>

<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Acceuil</a><i class="fa fa-angle-right"></i>Gérer Toutes Les Vaccinations </li>
				
            </ol>
<div class="agile-grids">	
				
<?php 
$id=intval($_GET['id']);
$sql = "SELECT * from dview where id=:id";
$query = $dbh -> prepare($sql);
$query -> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
   
				
	
   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Passe Vaccinal </div>
        <div id="pdf">

		
                                        

                         

                                    

                                    <tr>
                                                <td align="center" width="40%"><b>CIN</b></td>
                                                <td align="center" width="50%">
                                                    <br>
                                                        <?php
                                                    echo "$result->cin";
                                                    ?>
                                                   
                                                </td>
                                            </tr> 
                                            <br>
                                    <tr>
                                                <td align="center" width="40%"><b style="margin-left: 2px">Nom:</b></td>
                                                <td align="center" width="40%">
                                                   <br>
                                                      <?php
                                                    echo "$result->nom";
                                                    ?>  
                                                    
                                                </td>
                                            </tr> 
                                             <br>
                                    
                                             
                                    <tr>
                                                <td align="center" width="40%"><b style="margin-left: 2px">Numero de la dose:</b></td>
                                                <td align="center" width="40%">
                                                <br>   
                                         <?php
                                                    echo "$result->numero";
                                                    ?>
                                                   
                                                </td>
                                            </tr>
                                            <br>
                                            <tr>
                                                <td align="center" width="40%"><b style="margin-left: 2px">Nom de Vaccin:</b></td>
                                                <td align="center" width="40%">
                                                    <br>
                                         <?php
                                                    echo "$result->type";
                                                    ?>
                                                   
                                                </td>
                                            </tr>
											<br>
											<tr>
                                                <td align="center" width="40%"><b style="margin-left: 2px">Date de Vaccination:</b></td>
                                                <td align="center" width="40%">
                                                   <br>
                                         <?php
                                                    echo "$result->date";
                                                    ?>
                                                   
                                                </td>
                                            </tr>
										<br>
										<br>
										
										

											<?php }} ?>
                                           
                                          


                                   
                                </table>
                                 </div>
                             </div>
                             <br>
						 
						
						</tbody>
					  </table>
					</div>
        
				  </table>		
          
          <div class="col text-center">
          <button onclick="printDiv('pdf','Title')" class="btn btn-danger">Imprimer le Pass </button> 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="manage-vaccinations.php"><button class="btn btn-danger" >Retour</a></tr>
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