<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

$id=intval($_GET['id']);
echo $id;

$sql="delete from dose where idp=";

$ch=$sql.$id;
$query = $dbh->prepare($ch);
$query->execute();

if($query->execute())
{
echo"<script>alert('Dose Réinitialisée avec succés');</script>";
echo "<script type='text/javascript'> document.location = 'manage-users.php'; </script>";

}
}
	?>