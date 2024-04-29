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
    <script type="text/javascript" src="<?= base_url; ?>ManagementRx8Files/css/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Dr.xxx",
			staffid : "2344444"
		}
	});
</script>

 
 	</head>
	<body>
 
<?php AutoLoadIncludes('temp__main_header'); ?>
  <div id="page">
     <?php
	$id=$_GET['id'];
	$type=$_GET['type'];
	if(isset($id)){
 
 	$update_cc=$_POST['update_cc'];
	$update_Investigation=$_POST['update_Investigation'];
	$update_Diagnises=$_POST['update_Diagnises'];
	$update_Follow_Up=$_POST['update_Follow_Up'];
    $update_all=$_POST['update_all'];

	if(isset($update_cc)){
		$cc_t = filter_input(INPUT_POST, 'cc_t', FILTER_DEFAULT);
	    $ID_P=$_GET['id'];
 		if(empty($ID_P) || empty($cc_t)){
		  echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			الرجاء ملئ كافة المعلومات المطلوبة
			</div></div>"; 
 		}else{
		 $cc_t= htmlspecialchars($cc_t, ENT_QUOTES , "utf-8");
         $ID_P= htmlspecialchars($ID_P, ENT_QUOTES , "utf-8");
		 $ActionTrue=$Model_Doctor->UpdateInfoCC($ID_P,$cc_t);
		 if($ActionTrue==TRUE){
			 echo"<div class='row main_row'>
			<div class='col-md-12 succssfully'>
			تم ادخال بيانات المريض
			</div></div>";
			 }else{
				 echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			هنالك خطأ.. حاول مرة اخرى
			</div></div>";}
 		}
 		}elseif(isset($update_Investigation)){
		$Investigation_t = filter_input(INPUT_POST, 'Investigation_t', FILTER_DEFAULT);
	    $ID_P=$_GET['id'];
 		if(empty($ID_P) || empty($Investigation_t)){
		  echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			الرجاء ملئ كافة المعلومات المطلوبة
			</div></div>"; 
 		}else{
		 $Investigation_t= htmlspecialchars($Investigation_t, ENT_QUOTES , "utf-8");
         $ID_P= htmlspecialchars($ID_P, ENT_QUOTES , "utf-8");
		 $ActionTrue=$Model_Doctor->UpdateInfoInvestigation($ID_P,$Investigation_t);
		 if($ActionTrue==TRUE){
			 echo"<div class='row main_row'>
			<div class='col-md-12 succssfully'>
			تم ادخال بيانات المريض
			</div></div>";
			 }else{
				 echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			هنالك خطأ.. حاول مرة اخرى
			</div></div>";}
 		}
		  
		}elseif(isset($update_Diagnises)){
			
		$Diagnises_t = filter_input(INPUT_POST, 'Diagnises_t', FILTER_DEFAULT);
	    $ID_P=$_GET['id'];
 		if(empty($ID_P) || empty($Diagnises_t)){
		  echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			الرجاء ملئ كافة المعلومات المطلوبة
			</div></div>"; 
 		}else{
		 $Diagnises_t= htmlspecialchars($Diagnises_t, ENT_QUOTES , "utf-8");
         $ID_P= htmlspecialchars($ID_P, ENT_QUOTES , "utf-8");
		 $ActionTrue=$Model_Doctor->UpdateInfoDiagnises($ID_P,$Diagnises_t);
		 if($ActionTrue==TRUE){
			 echo"<div class='row main_row'>
			<div class='col-md-12 succssfully'>
			تم ادخال بيانات المريض
			</div></div>";
			 }else{
				 echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			هنالك خطأ.. حاول مرة اخرى
			</div></div>";}
 		} 
		 }elseif(isset($update_all)){
			 $cc_t = filter_input(INPUT_POST, 'cc_t', FILTER_DEFAULT);
			 $Diagnises_t = filter_input(INPUT_POST, 'Diagnises_t', FILTER_DEFAULT);
			 $Investigation_t = filter_input(INPUT_POST, 'Investigation_t', FILTER_DEFAULT);
              $ID_P=$_GET['id'];
			 
			 if(empty($ID_P)){
		  echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			الرجاء ملئ كافة المعلومات المطلوبة
			</div></div>"; 
 		}else{
		 $cc_t= htmlspecialchars($cc_t, ENT_QUOTES , "utf-8");
		 $Diagnises_t= htmlspecialchars($Diagnises_t, ENT_QUOTES , "utf-8");
		 $Investigation_t= htmlspecialchars($Investigation_t, ENT_QUOTES , "utf-8");
         $ID_P= htmlspecialchars($ID_P, ENT_QUOTES , "utf-8");
		 $ActionTrue=$Model_Doctor->UpdateInfoAll($ID_P,$cc_t,$Diagnises_t,$Investigation_t);
		 if($ActionTrue==TRUE){
			 echo"<div class='row main_row'>
			<div class='col-md-12 succssfully'>
			تم ادخال بيانات المريض
			</div></div>";
			 }else{
				 echo"<div class='row main_row'>
			<div class='col-md-12 failure'>
			هنالك خطأ.. حاول مرة اخرى
			</div></div>";}
 		} 
		 
		} 
		
		$PatentsInfo=$Model_Doctor->PatentsInfo($id);
		if($PatentsInfo){
 		 foreach($PatentsInfo as $row_info):
		  if(isset($id) && isset($type) && $type=="cc"){ ?>
			  <center >
                <div class="ins_info">
                <div class="row iformation">
                <div class="col-md-6 info_col" style=" border:0px;">
                Insert C.C to : <?php echo"$row_info[Name]"; ?> 
                </div> 
                <div class="col-md-3 info_col">
              ID: <?php echo"$row_info[ID_P]"; ?> 
                </div> 
                <div class="col-md-3 info_col">
                Age: <?php echo"$row_info[Age]"; ?>
                </div> 
                </div> 
                
                <form action="InformationInsert.php?type=cc&id=<?php echo $row_info['ID_P']; ?>" method="post" class="fome_a">
                 <div class="row iformation">
                <div class="col-md-12 inse_c" >
                
                <textarea name="cc_t"  class="text-area" placeholder="Typing C.C" ><?php echo $row_info['cc_t']; ?></textarea>
               </div></div>
                <div class="row iformation">
                <div class="col-md-12 inse_c" >
              <input type="submit" name="update_cc" value="ادخال" class="submit" style="width:20%;">
                </div></div>
                 </form>
                </div>
                </center>
		 <?php } elseif(isset($type) && $type=="Investigation"){ ?>
              <center >
            <div class="ins_info">
            <div class="row iformation">
            <div class="col-md-6 info_col" style=" border:0px;">
            Insert Investigation to : <?php echo"$row_info[Name]"; ?> 
            </div> 
            <div class="col-md-3 info_col">
          ID: <?php echo"$row_info[ID_P]"; ?> 
            </div> 
            <div class="col-md-3 info_col">
            Age: <?php echo"$row_info[Age]"; ?>
            </div> 
            </div> 
            <form action="InformationInsert.php?type=Investigation&id=<?php echo $row_info['ID_P']; ?>" method="post" class="fome_a">
             <div class="row iformation">
            <div class="col-md-12 inse_c" >
            
            <textarea name="Investigation_t"  class="text-area" placeholder="Typing Investigation" ><?php echo $row_info['investigation_t']; ?></textarea>
           </div></div>
            <div class="row iformation">
            <div class="col-md-12 inse_c" >
          <input type="submit" name="update_Investigation" value="ادخال" class="submit" style="width:20%;">
            </div></div>
             </form>
            </div>
            </center>
    <?php }elseif(isset($type) && $type=="Diagnises"){ ?>
              <center >
        <div class="ins_info">
        <div class="row iformation">
        <div class="col-md-6 info_col" style=" border:0px;">
        Insert Diagnises to : <?php echo"$row_info[Name]"; ?> 
        </div> 
        <div class="col-md-3 info_col">
      ID: <?php echo"$row_info[ID_P]"; ?> 
        </div> 
        <div class="col-md-3 info_col">
        Age: <?php echo"$row_info[Age]"; ?>
        </div> 
        </div> 
        <form action="InformationInsert.php?type=Diagnises&id=<?php echo $row_info['ID_P']; ?>" method="post" class="fome_a">
         <div class="row iformation">
        <div class="col-md-12 inse_c" >
        
        <textarea name="Diagnises_t"  class="text-area" placeholder="Typing Diagnises" ><?php echo $row_info['diagnises_t']; ?></textarea>
       </div></div>
        <div class="row iformation">
        <div class="col-md-12 inse_c" >
      <input type="submit" name="update_Diagnises" value="ادخال" class="submit" style="width:20%;">
        </div></div>
         </form>
        </div>
        </center>
    <?php }elseif(isset($type) && $type=="all"){ ?>
              <center >
                <div class="ins_info">
                <div class="row iformation">
                <div class="col-md-6 info_col" style=" border:0px;">
                اسم المريض : <?php echo"$row_info[Name]"; ?> 
                </div> 
                <div class="col-md-3 info_col">
              الرقم التعريفي: <?php echo"$row_info[ID_P]"; ?> 
                </div> 
                <div class="col-md-3 info_col">
                العمر: <?php echo"$row_info[Age]"; ?>
                </div> 
                </div> 
                <form action="InformationInsert.php?type=all&id=<?php echo $row_info['ID_P']; ?>" method="post" class="fome_a">
                 <div class="row iformation">
                <div class="col-md-12 info_col-1" >
                C.C
                </div></div>
                 <div class="row iformation">
                <div class="col-md-12 inse_c" style="border-bottom:1px solid rgba(33,33,33,0.3);" >
                
                <textarea name="cc_t"  class="text-area" placeholder="Typing C.C" ><?php echo $row_info['cc_t']; ?></textarea>
               </div></div>
               <div class="row iformation">
                <div class="col-md-12 info_col-1" >
                Investigation
                </div></div>
               <div class="row iformation">
                <div class="col-md-12 inse_c" style="border-bottom:1px solid rgba(33,33,33,0.3);" >
                
                <textarea name="Investigation_t"  class="text-area" placeholder="Typing Investigation" ><?php echo $row_info['investigation_t']; ?></textarea>
               </div></div>
               <div class="row iformation">
                <div class="col-md-12 info_col-1" >
               Diagnises
                </div></div>
               <div class="row iformation">
                <div class="col-md-12 inse_c" style="border-bottom:1px solid rgba(33,33,33,0.3);" >
                
                <textarea name="Diagnises_t"  class="text-area" placeholder="Typing Diagnises" ><?php echo $row_info['diagnises_t']; ?></textarea>
               </div></div>
                
                <div class="row iformation">
                <div class="col-md-12 inse_c" >
              <input type="submit" name="update_all" value="ادخال" class="submit" style="width:20%;">
                </div></div>
                 </form>
                   
                </div>
    </center>
    <?php }else{ $Model_Doctor->PatientTable();  }
 		 
		 endforeach;	
 		}else{echo"لا يوجد مرضى";}
 	 }else{ $Model_Doctor->PatientTable();  }
	?>
</div>
 
<?php AutoLoadIncludes('temp__footer'); ?>
   

 </body>
</html>