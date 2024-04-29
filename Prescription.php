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
<script language="javascript">
function Start(page) {
OpenWin = this.open(page, "CtrlWindow", "toolbar=yes,menubar=yes,location=yes,scrollbars=yes,resizable=yes");
}
// End -->
</SCRIPT>
 	</head>
	<body>
 
 <?php
//PHARAMCY INTERFACE

if(isset($_SESSION['pharmacy']) && isset($_SESSION['id'])){  ?>

<?php AutoLoadIncludes('temp__main_header_pharmcy'); ?>
<div id="page">
	 
	<?php
	$get_id=$_GET['id'];
	$id_pres=$_GET['id_pres'];
	if(isset($get_id) && $id_pres){
		
		 ?>
		
   <div class='prescription'>
    <div class='row'  >
     <div class='col-md-12'>
    <?php AutoLoadIncludes('DoctorInformation_header'); ?>
    </div>
    <div class='col-md-12' style='margin-top:1%; '>
    <center> 
     <table id='pres_tb_pat'  width='100%' >
     <?php
      $id_p_1=$_GET['id'];
	  if(isset($id_p_1) && !empty($id_p_1)){
		  if(isset($_POST['Checked'])){
			  $CheckedPersption=$Model_Pharamcy->CheckedPersption($id_pres);
			  if($CheckedPersption){echo"<div class='row main_row'>
			<div class='col-md-12 succssfully'>
			تم التأشير بنجاح
			</div></div>";}else{echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			هنالك خطأ.. حاول مرة اخرى
			</div></div>";}
			  }
		  $id_p_1=htmlspecialchars($id_p_1,ENT_QUOTES,"utf-8");
		  $getIndvPatient=$Model_Doctor->getIndvPatient($id_p_1);
		   if($getIndvPatient){$min=1; ?>
           <?php   foreach($getIndvPatient as $row_f_pa):  ?>
           <tr>
            <td class='pa_title' width='50%'>
          أسم المريض : <?= $row_f_pa['Name']; ?>
            </td>
            <td class='pa_title'>
           العمر : <?= $row_f_pa['Age']; ?> سنة
            </td>
            </tr>
            <tr>
            <td class='pa_title'>
             الجنس : 
         <?php if($row_f_pa['gender']=="1"){echo"ذكر ";}elseif($row_f_pa['gender']=="2"){echo" أنثى";}else{} ?>
          </td>
            <td class='pa_title'>
           التاريخ : <span style='direction:rtl; font-weight:400;'>  
			 <?php echo $date=date("Y/m/d H:i");  ?>
          </span>
            </td>
            </tr>
			   <?php endforeach; ?>
  			   <?php
		   }else{
 			   // اذا ماكو المريض
			   } }
     ?>
      </table>
     </center>
    </div>
    <div class='col-md-12 printandsave' style='padding:1%;'>
     <center>
      <div class='row row_s' style='width:100%;'>
       <div class='col-md-12' style="display:inline-flex; justify-content: center;">
        <form><button name="print" onClick="Start('<?php echo"Printprescription?id=$get_id&id_pres=$id_pres"; ?>')" type="button"  class='submit_r' style='width:100%;'>طباعة</button></form>
        <form action="" method="post" style="margin:0 10px;">
        
        <input type="submit" name="Checked" class='submit_r' style="background-color:rgba(102,204,102,1);" value="التأشير على صرف الوصفة">
        </form>
        </div>
       </div>
      </center>
     </div>
     <div class='col-md-12 prescrioptinon_col' style="text-align:left; direction:ltr; font-size:20px;">  Rx. :  </div>
     <div class='col-md-12' style='padding-top:2%;'>
      <table id='pres_tb_list' width='100%'  > 
      <?php
      $id_p=$_GET['id'];
      $id_pres=$_GET['id_pres'];
       if(isset($id_p) && !empty($id_p) && isset($id_pres) && !empty($id_pres)){
		   //actions
		  if(isset($_POST['insert'])){
	   $ammount = filter_input(INPUT_POST, 'ammount', FILTER_DEFAULT);
	   $times_t = filter_input(INPUT_POST, 'times_t', FILTER_DEFAULT);
	   $timing_t = filter_input(INPUT_POST, 'timing_t', FILTER_DEFAULT);
	   $notice = filter_input(INPUT_POST, 'notice', FILTER_DEFAULT);
	   $id_p = filter_input(INPUT_POST, 'id_p', FILTER_DEFAULT);
	   $id_preseption = filter_input(INPUT_POST, 'id_pres', FILTER_DEFAULT);
	   $name_ph = filter_input(INPUT_POST, 'name_ph', FILTER_DEFAULT);
	   $origin_ph = filter_input(INPUT_POST, 'origin_ph', FILTER_DEFAULT);
 
 	 if(empty($id_p) || empty($id_preseption) || empty($name_ph)){?>
         <div class='row main_row'>
	      <div class='col-md-12 failure'>
			ERROR: Please Fill The Information
		  </div>
         </div> 
		<?php
 		 }else{
			 $ammount= htmlspecialchars($ammount, ENT_QUOTES , "utf-8");
			 $times_t= htmlspecialchars($times_t, ENT_QUOTES , "utf-8");
			 $timing_t= htmlspecialchars($timing_t, ENT_QUOTES , "utf-8");
			 $notice= htmlspecialchars($notice, ENT_QUOTES , "utf-8");
			 $id_p= htmlspecialchars($id_p, ENT_QUOTES , "utf-8");
			 $id_preseption= htmlspecialchars($id_pres, ENT_QUOTES , "utf-8");
			 $name_ph= htmlspecialchars($name_ph, ENT_QUOTES , "utf-8");
			 $origin_ph= htmlspecialchars($origin_ph, ENT_QUOTES , "utf-8");
             $date=date("Y/m/d H:i");
			 $InsertDrug=$Model_Doctor->InsertPaDrug($ammount,$times_t,$timing_t,$notice,$id_p,$id_preseption,$name_ph,$origin_ph,$date);
			 if($InsertDrug){}else{ ?><script>alert("هنالك خطأ يرجى المحاولة لاحقاً");</script> <?php }
			 }
	}
	elseif(isset($_POST['Delete'])){
		 $id_del = filter_input(INPUT_POST, 'id_del', FILTER_DEFAULT);
		  if(empty($id_del)){?>
		  <div class='row main_row'>
	      <div class='col-md-12 failure text-center bg_red'>
			ERROR: Please Fill The Information
		  </div>
         </div> 
		<?php
 		 }else{
			 $id_del= htmlspecialchars($id_del, ENT_QUOTES , "utf-8"); 
			 $DeletePaDrug=$Model_Doctor->DeletePaDrug($id_del);
		 }}
 
		  $id_p=htmlspecialchars($id_p,ENT_QUOTES,"utf-8");
		  $id_pres=htmlspecialchars($id_pres,ENT_QUOTES,"utf-8");
		  $getPateintsDrug=$Model_Doctor->getPateintsDrug($id_p,$id_pres);
		   if($getPateintsDrug){$min=1; ?>
           <?php   foreach($getPateintsDrug as $drgpa): $min_p=$min++;  ?>
           <tr>
            <td class='pharam'>
            <?= $min_p; ?> - <font color='#3366CC'><?= $drgpa['name']; ?></font> - المنشأ(<?= $drgpa['origin']; ?>) - الكمية (<?= $drgpa['ammount']; ?>) -  x <?= $drgpa['times_t']; ?>  <?= $drgpa['timing_t']; ?> 
            <?php
            if(!empty($drgpa['notice'])){echo" - <font color='#F63'>ملاحظات:</font>  $drgpa[notice].";}else{echo".";} ?>
            
            </td> </tr>  
             <?php endforeach; ?>
          
           <?php }else{ ?><tr>
            <td class='pharam_emp'>
            لا توجد ادوية في هذه الوصفة</td></tr> <?php } ?>
            <?php } ?>
     </table>
    </div>
      
    <?php AutoLoadIncludes('DoctorInformation_footer'); ?>
    </div>
    </div>
 

    <?php  
	 } 
	 //part tow
	
		else{ $Model_Pharamcy->PersptionsTable();  }
	 ?>
	
	</div>
    <?php 
 	//END PHARAMCY INTERFACE
	
	 }
 	 //DOCTOR INTERFACE
else{   AutoLoadIncludes('temp__main_header'); ?>

<div id="page">
	 
	<?php
	$get_id=$_GET['id'];
	$id_pres=$_GET['id_pres'];
	if(isset($get_id) && $id_pres){
		
		 ?>
		
   <div class='prescription'>
    <div class='row'  >
     <div class='col-md-12'>
    <?php AutoLoadIncludes('DoctorInformation_header'); ?>
    </div>
    <div class='col-md-12' style='margin-top:1%; '>
    <center> 
     <table id='pres_tb_pat'  width='100%' >
     <?php
      $id_p_1=$_GET['id'];
	  if(isset($id_p_1) && !empty($id_p_1)){
		  $id_p_1=htmlspecialchars($id_p_1,ENT_QUOTES,"utf-8");
		  $getIndvPatient=$Model_Doctor->getIndvPatient($id_p_1);
		   if($getIndvPatient){$min=1; ?>
           <?php   foreach($getIndvPatient as $row_f_pa):  ?>
           <tr>
            <td class='pa_title' width='50%'>
          أسم المريض : <?= $row_f_pa['Name']; ?>
            </td>
            <td class='pa_title'>
           العمر : <?= $row_f_pa['Age']; ?> سنة
            </td>
            </tr>
            <tr>
            <td class='pa_title'>
             الجنس : 
         <?php if($row_f_pa['gender']=="1"){echo"ذكر ";}elseif($row_f_pa['gender']=="2"){echo" أنثى";}else{} ?>
          </td>
            <td class='pa_title'>
           التاريخ : <span style='direction:rtl; font-weight:400;'>  
			 <?php echo $date=date("Y/m/d H:i");  ?>
          </span>
            </td>
            </tr>
			   <?php endforeach; ?>
  			   <?php
		   }else{
 			   // اذا ماكو المريض
			   } }
     ?>
      </table>
     </center>
    </div>
    <div class='col-md-12 printandsave' style='padding:1%;'>
     <center>
      <div class='row row_s' style='width:30%;'>
       <div class='col-md-12'>
        <form><button name="print" onClick="Start('<?php echo"Printprescription?id=$get_id&id_pres=$id_pres"; ?>')" type="button" style='width:25%;' class='submit_r'>طباعة</button></form>
        </div>
       </div>
      </center>
     </div>
     <div class='col-md-12 prescrioptinon_col' style="text-align:left; direction:ltr; font-size:20px;">  Rx. :  </div>
     <div class='col-md-12' style='padding-top:2%;'>
      <table id='pres_tb_list' width='100%'  > 
      <?php
      $id_p=$_GET['id'];
      $id_pres=$_GET['id_pres'];
       if(isset($id_p) && !empty($id_p) && isset($id_pres) && !empty($id_pres)){
		   //actions
		  if(isset($_POST['insert'])){
	   $ammount = filter_input(INPUT_POST, 'ammount', FILTER_DEFAULT);
	   $times_t = filter_input(INPUT_POST, 'times_t', FILTER_DEFAULT);
	   $timing_t = filter_input(INPUT_POST, 'timing_t', FILTER_DEFAULT);
	   $notice = filter_input(INPUT_POST, 'notice', FILTER_DEFAULT);
	   $id_p = filter_input(INPUT_POST, 'id_p', FILTER_DEFAULT);
	   $id_preseption = filter_input(INPUT_POST, 'id_pres', FILTER_DEFAULT);
	   $name_ph = filter_input(INPUT_POST, 'name_ph', FILTER_DEFAULT);
	   $origin_ph = filter_input(INPUT_POST, 'origin_ph', FILTER_DEFAULT);
 
 	 if(empty($id_p) || empty($id_preseption) || empty($name_ph)){?>
         <div class='row main_row'>
	      <div class='col-md-12 failure'>
			ERROR: Please Fill The Information
		  </div>
         </div> 
		<?php
 		 }else{
			 $ammount= htmlspecialchars($ammount, ENT_QUOTES , "utf-8");
			 $times_t= htmlspecialchars($times_t, ENT_QUOTES , "utf-8");
			 $timing_t= htmlspecialchars($timing_t, ENT_QUOTES , "utf-8");
			 $notice= htmlspecialchars($notice, ENT_QUOTES , "utf-8");
			 $id_p= htmlspecialchars($id_p, ENT_QUOTES , "utf-8");
			 $id_preseption= htmlspecialchars($id_pres, ENT_QUOTES , "utf-8");
			 $name_ph= htmlspecialchars($name_ph, ENT_QUOTES , "utf-8");
			 $origin_ph= htmlspecialchars($origin_ph, ENT_QUOTES , "utf-8");
             $date=date("Y/m/d H:i");
			 $InsertDrug=$Model_Doctor->InsertPaDrug($ammount,$times_t,$timing_t,$notice,$id_p,$id_preseption,$name_ph,$origin_ph,$date);
			 if($InsertDrug){}else{ ?><script>alert("هنالك خطأ يرجى المحاولة لاحقاً");</script> <?php }
			 }
	}
	elseif(isset($_POST['Delete'])){
		 $id_del = filter_input(INPUT_POST, 'id_del', FILTER_DEFAULT);
		  if(empty($id_del)){?>
		  <div class='row main_row'>
	      <div class='col-md-12 failure text-center bg_red'>
			ERROR: Please Fill The Information
		  </div>
         </div> 
		<?php
 		 }else{
			 $id_del= htmlspecialchars($id_del, ENT_QUOTES , "utf-8"); 
			 $DeletePaDrug=$Model_Doctor->DeletePaDrug($id_del);
		 }}
 
		  $id_p=htmlspecialchars($id_p,ENT_QUOTES,"utf-8");
		  $id_pres=htmlspecialchars($id_pres,ENT_QUOTES,"utf-8");
		  $getPateintsDrug=$Model_Doctor->getPateintsDrug($id_p,$id_pres);
		   if($getPateintsDrug){$min=1; ?>
           <?php   foreach($getPateintsDrug as $drgpa): $min_p=$min++;  ?>
           <tr>
            <td class='pharam'>
            <?= $min_p; ?> - <font color='#3366CC'><?= $drgpa['name']; ?></font> - المنشأ(<?= $drgpa['origin']; ?>) - الكمية (<?= $drgpa['ammount']; ?>) -  x <?= $drgpa['times_t']; ?>  <?= $drgpa['timing_t']; ?> 
            <?php
            if(!empty($drgpa['notice'])){echo" - <font color='#F63'>ملاحظات:</font>  $drgpa[notice].";}else{echo".";} ?>
            
           <form action='' method='post' class='f_fel'>
            <input type='hidden' name='id_del' value='<?= $drgpa['id']; ?> '>
            <input type='submit' name='Delete' value='حذف' class='submit_link'>
            </form></td> </tr>  
             <?php endforeach; ?>
          
           <?php }else{ ?><tr>
            <td class='pharam_emp'>
            لا توجد ادوية في هذه الوصفة</td></tr> <?php } ?>
            <?php } ?>
     </table>
    </div>
     <div class='col-md-12 prescrioptinon_tb-inc'> 
     <?= $Model_Doctor->DrugTable($id_p,$id_pres); ?>
    </div>
    <?php AutoLoadIncludes('DoctorInformation_footer'); ?>
    </div>
    </div>
 

    <?php  
	 }elseif($_POST['Create']){
		 $id_ps = filter_input(INPUT_POST, 'id_ps', FILTER_DEFAULT);
		 if(empty($id_ps)){ ?>
         <div class='row main_row'>
	      <div class='col-md-12 failure'>
			رقم المريض غير صحيح
		  </div>
         </div> 
		<?php }else{
			 $id_ps= htmlspecialchars($id_ps, ENT_QUOTES , "utf-8");
			 $createNewPers=$Model_Doctor->createNewPers($id_ps);
 			 if($createNewPers){
 				 header("Location:Prescription?id=$id_ps&id_pres=$createNewPers");
				 exit();
			 }
 		 }  }
	 //part tow
	elseif(isset($get_id)){ ?>
	 <center>
             <div class='cr_div'><div class='row create' >
              <div class='col-md-12  create-col'>
                هل تريد حقًا إنشاء وصفة طبية جديدة لهذا المريض؟
              </div>
              </div>
              <div class='row create' >
               <div class='col-md-6  create-col-2'>
                <form action='Prescription' method='post'>
                 <input type='hidden' value='<?= $get_id; ?>' name='id_ps'>
                 <input type='submit' name='Create' class='submit_e' style='width:50%;' value='انشاء' ></form>
               </div>
               <div class='col-md-6  create-col-2'>
                <form action='Prescription' method='post'>
                 <input type='submit' class='submit_d' style='width:50%;' value='تراجع' ></form>
               </div>
              </div>
             </div>
            </center> 
	 <?php }
		else{ $Model_Doctor->PatientTable();  }
	 ?>
	
	</div> <?php 
 
	//END DOCTOR INTERFACE
	 } ?>
     

 
	
 
<?php AutoLoadIncludes('temp__footer'); ?>
   

 </body>
</html>