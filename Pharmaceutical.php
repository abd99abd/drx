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
	 
	
	$edit=$_GET['edit'];
	$delete=$_GET['delete'];
	$p_id=$_GET['id'];
 
 	if(isset($p_id) && isset($edit)){
		$p_id= htmlspecialchars($p_id, ENT_QUOTES , "utf-8");
		
		
 			 if(isset($_POST['edit_ph'])){
				 $id_upd = filter_input(INPUT_POST, 'id_upd', FILTER_DEFAULT);
				 $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
				 $origin = filter_input(INPUT_POST, 'origin', FILTER_DEFAULT);
				 if(empty($id_upd) || empty($name) || empty($origin)){
				  echo"<div class='row main_row'>
					<div class='col-md-12 failure'>
					الرجاء ملئ كافة المعلومات المطلوبة
					</div></div>"; 
				}else{
				 $origin= htmlspecialchars($origin, ENT_QUOTES , "utf-8");
				 $name= htmlspecialchars($name, ENT_QUOTES , "utf-8");
 		 
				 $UpdateDrug=$Model_Pharamcy->UpdateDrug($id_upd,$name,$origin);
				 if($UpdateDrug==TRUE){
					 echo"<div class='row main_row'>
					<div class='col-md-12 succssfully'>
					تم تحديث بيانات العلاج
					</div></div>";
					 }else{
						 echo"<div class='row main_row'>
					<div class='col-md-12 failure'>
					هنالك خطأ.. حاول مرة اخرى
					</div></div>";
						 }
				}
			 }
			 
		$getIndvDrug=$Model_Pharamcy->getIndvDrug($p_id);
		if($getIndvDrug){
			  foreach($getIndvDrug as $drg): ?> 
              <center><div class='add_ph_div'> <div class='row add_ph' >
                <div class='col-md-12 add_title'>
                تحديث العلاج
                </div>
                </div>
                <form action='' method='post'>
                <div class='row add_ph' >
                
                <div class='col-md-6 add_ph_col'>
                 <input type='text' name='name' placeholder='أكتب اسم العلاج' value='<?= $drg['name']; ?>' class='text'>
                </div><div class='col-md-6 add_ph_col_2'>
                 اسم العلاج : 
                </div>
                </div>
                
                 <div class='row add_ph' >
                
                <div class='col-md-6 add_ph_col'>
                 <input type='text' name='origin' placeholder='أكتب منشأ العلاج' value='<?= $drg['origin']; ?>' class='text'>
                 <input type='hidden' value='<?= $drg['id']; ?>' name='id_upd'>
                </div><div class='col-md-6 add_ph_col_2'>
                 منشأ العلاج : 
                </div>
                </div>
                <div class='row add_ph' >
                <div class='col-md-12 add_text'>
            
                 <input type='submit' name='edit_ph' value='تحديث' class='submit' style='width:30%;'>
                </div>
                </div>
                </form>
                </div>
                </center>
 
				 <?php endforeach; }else{ ?> <div class='row pha_p' style='width:100%; direction:rtl;'>
            <div class='col-md-12 failure' >
            علاج غير موجود
            </div>
            </div>
			<?php }
				 }
	elseif(isset($p_id) && isset($delete)){
		
		$p_id= htmlspecialchars($p_id, ENT_QUOTES , "utf-8");

		$getIndvDrug=$Model_Pharamcy->getIndvDrug($p_id);
		if($getIndvDrug){
			  foreach($getIndvDrug as $drg): ?>
               <div class='row pha_p' style='width:100%; direction:ltr;'>
            <div class='col-md-12' style="margin-top:20px; direction:rtl;" >
           هل انت متأكد من حذف العلاج : <font color='#FF3333'><?= $drg['name']; ?> - <?= $drg['origin']; ?> </font><br><br>
            <form action='?action=delete' method='post'>
            <input type='hidden' name='id_d' value='<?= $drg['id']; ?>'>
            <input type='submit' name='delete-config' value='حذف' class='submit_d' style='width:25%;'>
             </form>
            </div>
            </div>  
            <?php
			endforeach;
			}else{ ?><div class='row pha_p' style='width:100%; direction:rtl;'>
            <div class='col-md-12 failure' >
            علاج غير موجود
            </div>
            </div> 
			<?php } }else{ ?>
             <center>
             <?php
			 if(isset($_POST['save_ph'])){
				 $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
				 $origin = filter_input(INPUT_POST, 'origin', FILTER_DEFAULT);
				 if(empty($name) || empty($origin)){
				  echo"<div class='row main_row'>
					<div class='col-md-12 failure'>
					الرجاء ملئ كافة المعلومات المطلوبة
					</div></div>"; 
				}else{
				 $origin= htmlspecialchars($origin, ENT_QUOTES , "utf-8");
				 $name= htmlspecialchars($name, ENT_QUOTES , "utf-8");
 		 
				 $insert_patient=$Model_Pharamcy->InsertDrug($name,$origin);
				 if($insert_patient==TRUE){
					 echo"<div class='row main_row'>
					<div class='col-md-12 succssfully'>
					تم ادخال بيانات العلاج
					</div></div>";
					 }else{
						 echo"<div class='row main_row'>
					<div class='col-md-12 failure'>
					هنالك خطأ.. حاول مرة اخرى
					</div></div>";
						 }
				}
			 }elseif(isset($_POST['delete-config'])){
				 $id_d = filter_input(INPUT_POST, 'id_d', FILTER_DEFAULT);
  				 if(empty($id_d)){
				  echo"<div class='row main_row'>
					<div class='col-md-12 failure'>
					الرجاء ملئ كافة المعلومات المطلوبة
					</div></div>"; 
				}else{
				 $id_d= htmlspecialchars($id_d, ENT_QUOTES , "utf-8");
  		 
				 $DeleteDrug=$Model_Pharamcy->DeleteDrug($id_d);
				 if($DeleteDrug==TRUE){
					 echo"<div class='row main_row'>
					<div class='col-md-12 succssfully'>
					تم حذف بيانات العلاج
					</div></div>";
					 }else{
						 echo"<div class='row main_row'>
					<div class='col-md-12 failure'>
					هنالك خطأ.. حاول مرة اخرى
					</div></div>";
						 }
				}
			 }
			 ?>
             <div class='add_ph_div' dir="rtl"> 
             <div class='row add_ph ' >
            <div class='col-md-12 add_title'>
            أضافة علاج
            </div>
            </div>
            <form action='' method='post'>
            <div class='row add_ph' >
            
            <div class='col-md-6 add_ph_col'>
             <input type='text' name='name' placeholder='أكتب اسم العلاج' class='text'>
            </div>
            <div class='col-md-6 add_ph_col_2'>
             اسم العلاج : 
            </div>
            </div>
            
             <div class='row add_ph' >
            
            <div class='col-md-6 add_ph_col'>
             <input type='text' name='origin' placeholder='أكتب منشأ العلاج' class='text'>
            </div>
            <div class='col-md-6 add_ph_col_2'>
             منشأ العلاج : 
            </div>
            </div>
            <div class='row add_ph' >
            <div class='col-md-12 add_text'>
        
             <input type='submit' name='save_ph' value='حفظ' class='submit' style='width:30%;'>
            </div>
            </div>
            </form>
            </div>
            </center>
            <?php }
				 $Model_Pharamcy->DrugTable();
	        ?>
</div>
 
<?php AutoLoadIncludes('temp__footer'); ?>
   

 </body>
</html>