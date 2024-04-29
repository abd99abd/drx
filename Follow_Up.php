<?php
ob_start();
session_start();
if(!isset($_SESSION['doctor'])  && !isset($_SESSION['pharmacy'])){
	header("Location:index");
	exit();
	}
include_once'includes/autoloadincludes.php';
include_once'classes/autoloadclasses.php';
include_once'Controller/autoloadmodels.php';
include_once'includes/settings.inc.php';
AutoLoadIncludes('defines');
AutoLoadClasses('CI_Connection');
AutoLoadModels('Model_Doctor');
$Model_Doctor= new Model_Doctor();
AutoLoadModels('Model_Pharamcy');
$Model_Pharamcy= new Model_Pharamcy();
 
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
    <title>Dr.XXX |
    <?php
	if(isset($_SESSION['doctor'])){  echo"واجهة الطبيب"; }elseif(isset($_SESSION['pharmacy'])){  echo"واجهة الصيدلاني";}
	?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" rel="icon">
    <link rel="icon" href="<?= base_url; ?>images/logo.jpg" type="image/x-icon"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" />

 	<!-- Animate.css -->
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/animate.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/icomoon.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/style.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/stylesheet.css">
	<script src="<?= base_url; ?>ManagementRx8Files/js/modernizr-2.6.2.min.js"></script>
    <script src="<?= base_url; ?>ManagementRx8Files/js/jquery-latest.min.js"></script>
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/theme.blue.css">
	<script src="<?= base_url; ?>ManagementRx8Files/js/jquery.tablesorter.js"></script>
	<script src="<?= base_url; ?>ManagementRx8Files/js/widget-storage.js"></script>
	<script src="<?= base_url; ?>ManagementRx8Files/js/widget-filter.js"></script>
	<script src="<?= base_url; ?>ManagementRx8Files/js/widget-pager.js"></script>
    <script src="<?= base_url; ?>ManagementRx8Files/js/tablesorter-js1.js"></script>
 
 	</head>
	<body>
 
 <?php
//PHARAMCY INTERFACE

if(isset($_SESSION['pharmacy']) && isset($_SESSION['id'])){  ?>

<?php AutoLoadIncludes('temp__main_header_pharmcy');
 	//END PHARAMCY INTERFACE
	 }
 	 //DOCTOR INTERFACE
else{   AutoLoadIncludes('temp__main_header');
 
	//END DOCTOR INTERFACE
	 } ?>
 
 
	<div id="page">
 	<?php
 	$get=$_GET['id'];
	if(isset($get) && !empty($get)){
		echo"<center><div class='pres'>";
		$get= htmlspecialchars($get, ENT_QUOTES , "utf-8");
 		 $getPersPatient=$Model_Doctor->getPersPatient($get);
		  if($getPersPatient){$max=3; $min=0; ?>
          <div class='row pres_r'>
          <?php  foreach($getPersPatient as $pres):  $min++; ?>
           <div class='col-md-3 pres_col' style="margin-top:20px;">
            <table id='pres_tb' cellpadding='3'>
            <tr><td class='pres_td' colspan='2'><img src='images/pres.png' width='100%' height='150'></td></tr>
            <tr><td class='pres_td' width='80%'>رقم الوصفة : </td><td class='num'><?= $pres['id_Pre']; ?></td></tr>
            <tr><td class='pres_td'  colspan='2'  style=' border:0px; padding-top:30px;'>التاريخ: <font color='#66F' size='-1'><?= $pres['date']; ?><font></td></tr>
            <tr><td class='pres_td'  colspan='2' style=' border:0px; padding-top:30px;'><a href='Prescription?id=<?= $pres['id_p']; ?>&id_pres=<?= $pres['id_Pre']; ?>' class='submit_d'  >اذهب</a></td></tr>
            <tr><td class='pres_td'  colspan='2' style='height:40px; border:0px;'></td></tr>
            </table>
            </div>
           <?php   endforeach; ?>
           </div>
           <?php }else{ ?>
           <div class='row pres_r'>
            <div class='col-md-12 no_data'>
                   لا توجد وصفات لهذا المريض
                    </div>
                    </div>
                    <?php   }
					
					echo"</div></center>";
					  }else{
		           $Model_Pharamcy->PersptionsTable();
		             }
	                ?>
</div>
 
<?php AutoLoadIncludes('temp__footer'); ?>
   

 </body>
</html>