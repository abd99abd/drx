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
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
    <title>Dr.XXX | طباعة الوصفة </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" rel="icon">
    <link rel="icon" href="<?= base_url; ?>images/logo.jpg" type="image/x-icon"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url; ?>images/logo.jpg" />

 	<!-- Animate.css -->
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/style.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/stylesheet.css">
	<link rel="stylesheet" href="<?= base_url; ?>ManagementRx8Files/css/theme.blue.css">
 
	<script src="<?= base_url; ?>ManagementRx8Files/js/modernizr-2.6.2.min.js"></script>
       <SCRIPT LANGUAGE="JavaScript">
    if (window.print) {
    document.write('<form> '
    + '<input type=button name=print value="Print" '
    + 'onClick="javascript:window.print()"></form>');
    }
    </script>
 	</head>
	<body>
 
 
 
	<div id="page">
	 
	
		
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
           <td rowspan="2" style="text-align:center;">
              <center><div id="qrcode"></div></center>
            </td>
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
          <?php
		  $id_p=$_GET['id'];
          $id_pres=$_GET['id_pres'];
		  $qr_code=base_url."Printprescription?id=".$id_p."&id_pres=".$id_pres."";
		  ?>
          <input id="text" type="hidden" value="<?= $qr_code; ?>" style="width:80%" />
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
			   }  
     ?>
      </table>
     </center>
    </div>
      <div class='col-md-12 prescrioptinon_col' style="text-align:left; direction:ltr; font-size:20px;">  Rx. :  </div>
     <div class='col-md-12' style='padding-top:2%;'>
      <table id='pres_tb_list' width='100%'  > 
      <?php
      $id_p=$_GET['id'];
      $id_pres=$_GET['id_pres'];
       if(isset($id_p) && !empty($id_p) && isset($id_pres) && !empty($id_pres)){
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
	 ?>
	
	</div>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>
   
<script>
var qrcode = new QRCode("qrcode");

function makeCode () {		
	var elText = document.getElementById("text");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});
</script>
 </body>
</html>