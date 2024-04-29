<?php
ob_start();
session_start();
if(!isset($_SESSION['doctor'])){
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
 
<?php AutoLoadIncludes('temp__main_header'); ?>
 <div id="page">
 	<center>
    <div class="action_p">
	<?php
	
	
 	if(isset($_POST['Update'])){

        $patient_name = filter_input(INPUT_POST, 'patient_name', FILTER_DEFAULT);
		$age_name = filter_input(INPUT_POST, 'age_name', FILTER_DEFAULT);
		$mobile_name = filter_input(INPUT_POST, 'mobile_name', FILTER_DEFAULT);
		$gender = filter_input(INPUT_POST, 'gender', FILTER_DEFAULT);
		$id_p_e = filter_input(INPUT_POST, 'id_p_e', FILTER_DEFAULT);
		
       if(empty($id_p_e) || empty($patient_name) || empty($age_name) || empty($mobile_name) || empty($gender)){
		  echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			الرجاء ملئ كافة المعلومات المطلوبة
			</div></div>"; 
 		}else{
		 $id_p_e= htmlspecialchars($id_p_e, ENT_QUOTES , "utf-8");
		 $patient_name= htmlspecialchars($patient_name, ENT_QUOTES , "utf-8");
		 $age_name= htmlspecialchars($age_name, ENT_QUOTES , "utf-8");
		 $mobile_name= htmlspecialchars($mobile_name, ENT_QUOTES , "utf-8");
		 $gender= htmlspecialchars($gender, ENT_QUOTES , "utf-8");
  
		 $UpdatePatient=$Model_Doctor->UpdatePatient($id_p_e,$patient_name,$age_name,$mobile_name,$gender,$datee);
		 if($UpdatePatient==TRUE){
			 echo"<div class='row main_row'>
			<div class='col-md-12 succssfully'>
			تم تحديث بيانات المريض
			</div></div>";
			 }else{
				 echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			هنالك خطأ.. حاول مرة اخرى
			</div></div>";
				 }
		}
 		$getLastPatient=$Model_Doctor->getIndvPatient($id_p_e);
				if($getLastPatient):?>
           <table id='tb_pa'>
			<tr>
                <td class='p_td' width= 10%>الايدي</td>
                <td class='p_td' width= 16%>الاسم</td>
                <td class='p_td' width= 12%>العمر</td>
                <td class='p_td' width=12% >رقم الهاتف</td>
                <td class='p_td' width= 10%>C.C</td>
                <td class='p_td' width=10% >Investigation</td>
                <td class='p_td' width=10% >Diagnises</td>
                <td class='p_td' width=10% >Follow Up</td>
                 <td class='p_td' width=10% >جميع الحقول</td>
			</tr>
                <?php foreach($getLastPatient as $row_id): ?>
 			<tr>
                <td class='p_td_1'><?= $row_id['ID_P']; ?></td>
                <td class='p_td_1'><?= $row_id['Name']; ?></td>
                <td class='p_td_1'><?= $row_id['Age']; ?></td>
                <td class='p_td_1'><?= $row_id['Mobile']; ?></td>
                <td class='p_td_1'><a href='InformationInsert?type=cc&id=<?= $row_id['ID_P']; ?>' class='link' >ادخال</a></td>
                <td class='p_td_1'><a href='InformationInsert?type=Investigation&id=<?= $row_id['ID_P']; ?>' class='link' >ادخال</a></td>
                <td class='p_td_1'><a href='InformationInsert?type=Diagnises&id=<?= $row_id['ID_P']; ?>' class='link' >ادخال</a></td>
                <td class='p_td_1'> <a href='Follow_Up?id=<?= $row_id['ID_P']; ?>' class='link' >الدخول</a></td>
                <td class='p_td_1'> <a href='InformationInsert?type=all&id=<?= $row_id['ID_P']; ?>' class='link' >ادخال</a></td>
			</tr>
			
                <?php endforeach; ?>
                </table>
                <?php 
 				endif; }else{}
				?>
    </div></center>
    <?php
	$id_p=$_GET['id'];
	if(isset($id_p) && !empty($id_p)){
		$id_p= htmlspecialchars($id_p, ENT_QUOTES , "utf-8");
 		$getIndvPatient=$Model_Doctor->getIndvPatient($id_p);
		  if($getIndvPatient): ?>
           <?php   foreach($getIndvPatient as $row_p_ed): ?>
           <center><div class="add_p">
           <form name="patient_form" action=""   method="POST" >
                <div class="row main_row direc">
              <div class="col-md-8 main_col_1 ">
                <input type="text" name="patient_name"  id="patient_name" class="text" value="<?php echo $row_p_ed['Name']; ?>" required  size="100" >
                <input type="hidden" name="id_p_e" value="<?php echo $row_p_ed['ID_P']; ?>">
                </div>
                <div class="col-md-4 main_col">
                اسم المريض
                </div>
                  <div class="col-md-8 main_col_1">
            <input type="text" name="age_name" id="age_name" class="text" required value="<?php echo $row_p_ed['Age']; ?>"   size="100" >    </div>
                 <div class="col-md-4 main_col">
                العمر
                </div>
                
                 <div class="col-md-8 main_col_1">
            <input type="text" name="mobile_name"  id="mobile_name"  class="text" value="<?php echo $row_p_ed['Mobile']; ?>"  size="100" >    </div>
                <div class="col-md-4 main_col">
                رقم الهاتف
                </div>
                
                 <div class="col-md-8 main_col_1">
                 <select id="select" class="text" name="gender">
				<?php if($row_p_ed['gender']=="1"){echo"<option value='1'>ذكر</option><option value='2'>انثى</option>";}
                elseif($row_p_ed['gender']=="2"){echo"<option value='2'>انثى</option><option value='1'>ذكر</option>";} ?>
                 </select>
          
               </div>
               <div class="col-md-4 main_col">
                الجنس
                </div>
                
                
                 <div class="col-md-12 main_col_2" style="margin-top:4%;">
            <input id="store_p" type="submit" name="Update" value="حفظ البيانات" class="submit" style="width:30%;"><input id="clr_info" type="reset" value="مسح المدخلات" class="submit_r" style="width:30%;">      </div>
                </div>
                </form>
 
            </div>
        </center>
		   
				
				<?php endforeach; ?>
				<?php  endif;  ?>
                
                <?php }else{ $Model_Doctor->PatientTable();  } ?>
  	
	</div>
  
<?php AutoLoadIncludes('temp__footer'); ?>
   

 </body>
</html>